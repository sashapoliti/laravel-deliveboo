@extends('layouts.admin')

@section('title', 'Modifica ' . $plate->name)

@section('content')
<div class="container mt-5 m-auto">
    <div class="d-flex align-items-center">
        {{-- <a href="{{ route('admin.plates.index') }}" class="my-2">
            <button class="back-button">
                <div class="back-button-box">
                    <span class="back-button-elem">
                        <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                            </path>
                        </svg>
                    </span>
                    <span class="back-button-elem ">
                        <svg viewBox="0 0 46 40">
                            <path
                                d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                            </path>
                        </svg>
                    </span>
                </div>
            </button>
        </a> --}}
        <h1 {{-- class="mx-2 mt-1" --}}>Modifica {{$plate->name}}</h1>
    </div>
    <form class="row g-3 mt-3" action="{{route('admin.plates.update', $plate->slug)}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')         <div class="mb-3 col-6">
            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                maxlength="255" minlength="3" required value="{{ old('name', $plate->name) }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div id="nameHelp" class="form-text">Inserire minimo 3 caratteri e massimo 255</div>
        </div>

        <div class="mb-3 col-6">
            <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" maxlength="5" min="0.01" step="0.01" required name="price" value="{{ old('price', $plate->price) }}">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" maxlength="255"
                minlength="3">{{ old('description', $plate->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <div>
                <input type="hidden" name="visibility" value="0">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="visibility" id="visibility" value="1" {{ (old('visibility') ? 'checked' : '') || $plate->visibility ? 'checked' : '' }}>
                    <label class="form-check-label" for="visibility">
                        Visibile
                    </label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror"
                id="upload_image" name="image" maxlength="2048">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <h4 class="mt-3">La tua immagine</h4>
            @if($plate->image)
                <img class="shadow rounded-3 mt-3" width="300" src="{{ asset('storage/' . $plate->image) }}"
                    alt="{{ $plate->name }}" id="uploadPreview">
            @else
                <img class="shadow rounded-3 mt-3" width="300" src="{{ old('image', $plate->image) }}"
                    alt="{{ $plate->name }}" id="uploadPreview">
            @endif
        </div>
        <div>
            <em>I campi con <span class="text-danger">*</span> sono obbligatori</em>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary text-white">Modifica</button>
        </div>
    </form>
</div>
@endsection