@extends('layouts.admin')

@section('content')
    <section>
        <h2 class="text-center tet-uppercase">Inserisci un nuovo piatto</h2>
        <form class="row g-3" action="{{ route('admin.plates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="col-md-6">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-12">
                <label for="visibility" class="form-label">Visibilitá</label>
                <input type="checkbox" name="visibility" id="visibility">

            </div>
            <div class="col-12">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price') }}" step="0.01" placeholder="0.01">

            </div>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{ old('image') }}">

            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <div class="col-12">
                <button type="submit" class="btn bg-bordeaux">Crea</button>
            </div>
        </form>

    @endsection
