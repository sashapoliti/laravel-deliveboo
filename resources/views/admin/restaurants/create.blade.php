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
        
        <h2 class="text-center tet-uppercase my-4">Inserisci un nuovo ristorante</h2>
        <form class="row g-3" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required maxlength="255" minlength="3"
                    value="{{ old('name') }}">
                <div id="nameHelp" class="form-text">Inserire minimo 3 caratteri e massimo 255</div> 

            </div>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="col-md-6">
                <label for="vat_number" class="form-label">Vat number</label>
                <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number"
                    maxlength="11" minlength="11" required
                    value="{{ old('vat_number') }}">
            </div>
            @error('vat_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="col-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                    value="{{ old('address') }}" maxlength="255" minlength="3" required>
            </div>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

           
            

            <div class="form-group">
                <p>Select  Type:</p>
                @foreach ($types as $type)
                    <div>
                        <input class="form-check-input" type="checkbox" value="{{$type->id}}"  name="types[]"
                        {{in_array($type->id, old('types', [])) ? 'checked' : ''}}>
                        <label class="form-check-label" for="">
                            {{$type->name}}
                        </label>
                    </div>
                @endforeach
                @error('types')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea maxlength="255" minlength="3" class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                >{{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            
           <div class="mb-3 col-6 my-3 mt-3">
                <label for="image" class="form-label">
                    <h4>
                        Restaurant image
                    </h4>
                </label>
                <input type="file" accept="image/*" class="form-control  
                @error('image') is-invalid @enderror" id="upload_image"
                name="image" value="{{ old('image') }}" maxlength="2048">
                @error('image')
                    <div class ="invalid-feedback">{{$errors->first('image')}}</div>
                @enderror 
                <h4 class="mt-3">Restaurant image</h4>
                @if(old('image'))
                    <div class="container-img">
                        <img src="{{asset('storage/' . old('image'))}}" alt="{{old('name')}}" id="uploadPreview" class="shadow rounded-4 m-4">
                    </div>
                @else 
                    <div class="container-img">
                        <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg" alt="" id="uploadPreview" class="shadow rounded-4 m-4">
                    </div>
                @endif
            </div>

            <div class="mb-3 col-6  my-3 mt-3">
                <label for="logo" class="form-label">
                    <h4>
                        Logo
                    </h4>
                </label>
                <input type="file" accept="image/*" class="form-control 
                @error('logo') is-invalid @enderror" id="upload_logo"
                name="logo" value="{{ old('logo') }}" maxlength="2048">
                @error('logo')
                    <div class ="invalid-feedback">{{$errors->first('logo')}}</div>
                @enderror 
                <h4 class="mt-3">Your logo</h4>
                @if(old('logo'))
                    <div class="container-img">
                        <img src="{{asset('storage/' . old('logo'))}}" alt="{{old('logo')}}" id="uploadPreviewLogo" class="shadow rounded-4 m-4" >
                    </div>
                @else 
                    <div class="container-img">
                        <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg" alt="" id="uploadPreviewLogo" class="shadow rounded-4 m-4" >
                    </div>
                @endif
            </div>
            
            <div class="col-12">
                <button type="submit" class="btn btn-primary mb-5">Crea</button>
            </div>
        </form>
        <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    @endsection
