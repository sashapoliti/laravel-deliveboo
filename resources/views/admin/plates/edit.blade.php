@extends('layouts.admin')
@section('content')
<div class="container m-auto">
    <div class="d-flex align-items-center mt-3">
        <a href="{{ route('admin.plates.index') }}" class="my-2">
            <button class="back-button">
                <div class="back-button-box">
                  <span class="back-button-elem">
                    <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
                      ></path>
                    </svg>
                  </span>
                  <span class="back-button-elem ">
                    <svg viewBox="0 0 46 40">
                      <path
                        d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
                      ></path>
                    </svg>
                  </span>
                </div>
            </button>
        </a>
        <h1 class="mx-2 mt-1">Edit</h1>
    </div>
    <form action="{{route('admin.plates.update', $plate->slug)}}" method="POST" enctype="multipart/form-data">
        @csrf  
        @method('PUT')  
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $plate->name) }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror  
            <div id="nameHelp" class="form-text">Inserire minimo 3 caratteri e massimo 200</div> 
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $plate->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror 
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                name="price" value="{{ old('price', $plate->price) }}">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror 
        </div>
        <div class="mb-3">
            <div>Disponibile?</div>
            <label class="form-label">
                <input type="radio" name="visibility" value="1" {{ old('visibility', $plate->visibility) == 1 ? 'checked' : '' }}> Yes
            </label>
            <label class="form-label">
                <input type="radio" name="visibility" value="0" {{ old('visibility', $plate->visibility) == 0 ? 'checked' : '' }}> No
            </label>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" accept="image/*" 
            class="form-control @error('image') is-invalid @enderror" id="upload_image"
            name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror 
            <h4 class="mt-3">Your image</h4>
            @if($plate->image)
                <img class="shadow rounded-3 mt-3" width="150" src="{{ asset('storage/' . $plate->image) }}" alt="{{ $plate->name }}" id="uploadPreview">
            @else
                <img class="shadow rounded-3 mt-3" width="150" src="{{ old('image', $plate->image) }}" alt="{{ $plate->name }}" id="uploadPreview">
            @endif
        </div>



        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary text-white">Modifica</button>
            <button type="reset"  class="btn btn-danger mx-4">Svuota campi</button>
        </div>
    </form>   
</div>
@endsection
