@extends('layouts.admin')

@section('content')
<div class="container m-auto">
    <div class="d-flex align-items-center mt-3">
        <a href="{{ route('admin.plates.index') }}" class="btn btn-primary "><i><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="mx-3">Edit</h1>
    </div>

    <form action="{{route('admin.plates.update' , $plate->id)}}" method="POST" enctype="multipart/form-data">
        @csrf  
        @method('PUT')  
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $plate->name) }}" >
            @error('name')
                <div class ="alert alert-danger">{{$errors->first('name')}}</div>
            @enderror  
            <div id="nameHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div> 
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">
                {{ old('description', $plate->description) }}"
            </textarea>
            @error('description')
                <div class ="alert alert-danger">{{$errors->first('description')}}</div>
            @enderror 
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                name="price" value="{{ old('price', $plate->price) }}">
            @error('price')
                <div class ="alert alert-danger">{{$errors->first('price')}}</div>
            @enderror 
        </div>
        <div class="mb-3">
            <div>Disponibile?</div>
            <label class="form-label">
                <input type="radio" name="visibility" value="1" @if($plate->visibility) checked @endif> Yes
            </label>
            <label class="form-label">
                <input type="radio" name="visibility" value="0" @if(!$plate->visibility) checked @endif> No
            </label>
        </div>

        
        <div class="mb-3">
            <label for="image" class="form-label">image</label>
            <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" 
            id="image"
                name="image">
                @error('image')
                    <div class ="invalid-feedback">{{$errors->first('image')}}</div>
                @enderror 
                @if($plate->image)
                <img class="shadow rounded-3 mt-3" width="150" src="{{asset('storage/' . $plate->image)}}" alt="{{$plate->name}}" id="uploadPreview">
                @else
                <img class="shadow rounded-3 mt-3" width="150" src="{{ old('image', $plate->image) }}" alt="{{$plate->name}}" id="uploadPreview">
                @endif
        </div>
                
        <div class="mb-3">
            <button type="submit" class="btn btn-primary text-white">Modifica</button>
            <button type="reset"  class="btn btn-danger mx-4">Svuota campi</button>
        </div>
    </form>   
</div>
@endsection