@extends('layouts.admin')
@section('content')
    <div class="card my-3">
        <img src="{{ $plate->image }}"
            class="card-img-top" alt="{{ $plate->name }}">
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
            <a href="{{ route('admin.plates.edit', $plate->slug) }}" class="btn btn-primary mt-3">Edit</a>
        </div>
    </div>
@endsection
