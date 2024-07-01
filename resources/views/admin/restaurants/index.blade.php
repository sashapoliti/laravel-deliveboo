@extends('layouts.admin')

@section('content')

<div class="container">


  @foreach ($restaurants as $restaurant)
    <div class="card mt-5"> 
      <div class="card-header d-flex align-items-center" style="height: 500px; background-image: url({{asset('storage/'. $restaurant->image)}})">
        
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center my-4">
          <div class="overflow-hidden">
            {{-- .'post_images/'.'carbonara.jpeg' --}}
            <img src="{{asset('storage/'. $restaurant->logo)}}" alt="{{ $restaurant->name }}" class="rounded-circle" style="width: 100px">
          </div>
          <h2 class="m-3">{{$restaurant->name}}</h2>
        </div>
        <div class="mx-5 my-5">
          <h5>Description</h5>
          <p class="card-text mx-5 my-2">{{$restaurant->description}}</p>
          <h5>Address</h5>
          <p class="card-text mx-5 my-2">{{$restaurant->address}}</p>
          <h5>VAT number</h5>
          <p class="card-text mx-5 my-2">{{$restaurant->vat_number}}</p>
          <h5>Type</h5>
          <p class="card-text mx-5 my-2">{{$restaurant->type->name}}</p>
        </div>
      </div>
    </div>
  @endforeach
</div>

@endsection
