@extends('layouts.admin')

@section('content')
@if(session('message'))
<div class="alert alert-success mt-3">
    {{ session('message') }}
</div>
@endif

    <div class="container">
        <div class="my-5 d-flex justify-content-center align-items-center">
            <h1>Create a new plate</h1>
            <div class="mx-3 bg-secondary rounded-circle d-flex align-items-center justify-content-center" id="plus">
                <a href="{{ route('admin.plates.create') }}"><i class="fa-solid fa-plus text-white"></i></a>
            </div>
        </div>
        <div class="row">
            @foreach ($plates as $plate)
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $plate->image) }}" class="card-img-top"
                            alt="Immagine di {{ $plate->name }}">
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
                            <div class="d-flex mt-2">
                                <a href="{{ route('admin.plates.show', $plate->slug) }}" class="mt-2">
                                    <button class="cta">
                                        <span class="hover-underline-animation">  
                                            Show
                                        </span>
                                        <svg
                                            id="arrow-horizontal"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="30"
                                            height="10"
                                            viewBox="0 0 46 16"
                                        >
                                            <path
                                            id="Path_10"
                                            data-name="Path 10"
                                            d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                            transform="translate(30)"
                                            ></path>
                                        </svg>
                                    </button>
                                </a>
                               
                                  
                                <form action="{{ route('admin.plates.destroy', $plate->slug) }}" method="POST"
                                    class="d-inline-block mx-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button  button-delete" title="Elimina"
                                        data-item-title="{{ $plate->name }}">
                                        Delete
                                        <svg class="svg-delete" viewBox="0 0 448 512">
                                            <path
                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @include('partials.modal-delete')
@endsection
