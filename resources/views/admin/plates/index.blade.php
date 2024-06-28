@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            @foreach ($plates as $plate)
            <div class="col-12 col-md-6 col-lg-3 my-3">
               
                    <div class="card">
                        <img src="{{ $plate->image }}" class="card-img-top" alt="Immagine di {{ $plate->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $plate->name }}</h5>
                            <p class="card-text">{{ $plate->description }}</p>
                            <p class="card-text">{{ $plate->price }} €</p>
                            <div class="card-text">
                                @if ($plate->visibility == 1)
                                <span>Il prodotto è visibile</span>
                                @else
                                    <span>Il prodotto non è visibile</span>
                                @endif
                              </div>
                            <a href="{{ route('admin.plates.show' , $plate->slug) }}" class="btn btn-primary">Show</a>
                        </div>
                    </div>
              
            </div>
            @endforeach
        </div>
    @endsection
