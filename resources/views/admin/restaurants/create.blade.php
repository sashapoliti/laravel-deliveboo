@extends('layouts.admin')

@section('content')
    <section class="container m-auto">
        
        <div class="d-flex align-items-center mt-3">
            <a href="{{ route('admin.dashboard') }}" class="my-2">
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
            <h1 class="mx-2 mt-1">Create</h1>
        </div>
        
        <h2 class="text-center tet-uppercase">Inserisci un nuovo ristorante</h2>
        <form class="row g-3" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                    value="{{ old('address') }}">
            </div>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="col-md-6">
                <label for="vat_number" class="form-label">Vat number</label>
                <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number"
                    value="{{ old('vat_number') }}">
            </div>
            @error('vat_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

           <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" accept="image/*" class="form-control 
                @error('image') is-invalid @enderror" id="upload_image"
                name="image" value="{{ old('image') }}" maxlength="255">
                @error('image')
                    <div class ="alert alert-danger">{{$errors->first('image')}}</div>
                @enderror 
                <h4 class="mt-3">Your image</h4>
                @if(old('image'))
                    <img src="{{asset('storage/' . old('image'))}}" alt="{{old('name')}}" id="uploadPreview" class="shadow rounded-4 m-4">
                @else 
                    <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg" alt="" id="uploadPreview" class="shadow rounded-4 m-4">
                @endif
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" accept="image/*" class="form-control 
                @error('logo') is-invalid @enderror" id="upload_logo"
                name="logo" value="{{ old('logo') }}" maxlength="255">
                @error('logo')
                    <div class ="alert alert-danger">{{$errors->first('logo')}}</div>
                @enderror 
                <h4 class="mt-3">Your logo</h4>
                @if(old('logo'))
                    <img src="{{asset('storage/' . old('logo'))}}" alt="{{old('logo')}}" id="uploadPreviewLogo" class="shadow rounded-4 m-4">
                @else 
                    <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg" alt="" id="uploadPreviewLogo" class="shadow rounded-4 m-4">
                @endif
            </div>
            
            <div class="col-12">
                <button type="submit" class="btn bg-bordeaux">Crea</button>
            </div>
        </form>
        <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    @endsection
