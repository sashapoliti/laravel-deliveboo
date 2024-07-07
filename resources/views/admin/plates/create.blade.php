@extends('layouts.admin')

@section('content')
<section class="container m-auto">

    <div class="d-flex align-items-center mt-3">
        <a href="{{ route('admin.plates.index') }}" class="my-2">
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
        </a>
        <h1 class="mx-2 mt-1">Crea</h1>
    </div>

    <h2 class="text-center tet-uppercase">Inserisci un nuovo piatto</h2>
    <form class="row g-3 mt-3" action="{{ route('admin.plates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-6">
            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                maxlength="255" minlength="3" required value="{{ old('name') }}">
            <div id="nameHelp" class="form-text">Inserire minimo 3 caratteri e massimo 255</div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-6">
            <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                value="{{ old('price') }}" step="0.01" maxlength="6" minlength="0.01" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" maxlength="255" minlength="3">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <div>
                <h5>Seleziona se il prodotto è visibile o meno</h5>

                <div class="my-2">
                    <input type="radio" name="visibility" id="visibility" value="1" checked class="mx-2">
                    <label for="visibility">Visibile</label>
                </div>
                <div class="my-2">
                    <input type="radio" name="visibility" id="visibility" value="0" class="mx-2">
                    <label for="visibility">Non visibile</label>
                </div>
            </div>
        </div>


        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" accept="image/*" class="form-control 
                @error('image') is-invalid @enderror" id="upload_image" name="image" value="{{ old('image') }}"
                maxlength="2048">
            @error('image')
                <div class="text-danger">{{$errors->first('image')}}</div>
            @enderror
            <h4 class="mt-3">La tua immagine</h4>
            @if(old('image'))
                <div class="container-img">
                    <img src="{{asset('storage/' . old('image'))}}" alt="{{old('name')}}" id="uploadPreview"
                        class="shadow rounded-4 m-4">
                </div>
            @else 
                <div class="container-img">
                    <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg" alt=""
                        id="uploadPreview" class="shadow rounded-4 m-4">
                </div>
            @endif
        </div>
        <div>
            <em>I campi con <span class="text-danger">*</span> sono obbligatori</em>
        </div>

        <div class="col-12 mb-5">
            <button type="submit" class="btn btn-primary">Crea</button>
        </div>

    </form>
    @endsection