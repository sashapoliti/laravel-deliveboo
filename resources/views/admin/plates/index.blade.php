@extends('layouts.admin')

@section('title', 'Piatti')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">
        @if ($plates->count() == 0)
            <div class="d-flex justify-content-center mt-5">
                <img src="/img/no-plate.png" alt="nessun piatto">
            </div>
        @else
            {{-- <div class=" d-flex justify-content-center align-items-center">
                <h1>Create a new plate</h1>
                <div class="mx-3 bg-secondary rounded-circle d-flex align-items-center justify-content-center" id="plus">
                    <a href="{{ route('admin.plates.create') }}"><i class="fa-solid fa-plus text-white"></i></a>
                </div>
            </div> --}}
            <div class="my-5">
                <h1 class="my-3">Piatti ({{ $plates->count() }})</h1>
                <table class="table text-center align-middle">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Immagine</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col"  class="d-none d-md-table-cell">Visibilità</th>	
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plates as $plate)
                            <tr class="table-image">
                                <td><img src="{{ $plate->image ? asset('storage/' . $plate->image) : '/img/placeholder.svg' }}"
                                        alt=""></td>
                                <td><em>{{ $plate->name }}</em></td>
                                <td>€ {{ $plate->price }} </td>
                                <td class="d-none d-md-table-cell">{{ $plate->visibility == 1 ? 'Visibile' : 'Non visibile' }}</td>
                                <td class="d-flex justify-content-center">

                                    <a href="{{ route('admin.plates.edit', $plate->slug) }}">
                                        <button class="editBtn" title="Modifica">
                                            <svg height="1em" viewBox="0 0 512 512">
                                                <path
                                                    d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                                                </path>
                                            </svg>
                                        </button>
                                    </a>


                                    <form action="{{ route('admin.plates.destroy', $plate->slug) }}" method="POST"
                                        class="d-inline-block ms-3">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bin-button delete-button" type="submit" title="Cancella"
                                            data-item-title="{{ $plate->name }}">
                                            <svg class="bin-top" viewBox="0 0 39 7" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <line y1="5" x2="39" y2="5" stroke="white"
                                                    stroke-width="4"></line>
                                                <line x1="12" y1="1.5" x2="26.0357" y2="1.5"
                                                    stroke="white" stroke-width="3"></line>
                                            </svg>
                                            <svg class="bin-bottom" viewBox="0 0 33 39" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <mask id="path-1-inside-1_8_19" fill="white">
                                                    <path
                                                        d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                                    </path>
                                                </mask>
                                                <path
                                                    d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"
                                                    fill="white" mask="url(#path-1-inside-1_8_19)"></path>
                                                <path d="M12 6L12 29" stroke="white" stroke-width="4"></path>
                                                <path d="M21 6V29" stroke="white" stroke-width="4"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @endif
    </div>
    <a href="{{ route('admin.plates.create') }}" class="float-button">
        <i class="fa-solid fa-plus"></i>
    </a>
    @include('partials.modal-delete')
@endsection

<style lang="scss" scoped>
    .float-button {
        display: flex;
        position: fixed;
        bottom: 40px;
        right: 40px;
        justify-content: center;
        align-items: center;
        background-color: #307750;
        color: #F4F3EF;
        border-style: none;
        border-radius: 50%;
        overflow: hidden;
        z-index: 1;
        transition: all 250ms;
        cursor: pointer;
        width: 70px;
        height: 70px;
        font-size: 1.7rem;

        &::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 0;
            border-radius: 0.5em;
            background-color: #469b61;
            z-index: -1;
            transition: all 350ms;
        }

        &:hover::before {
            width: 100%;
        }
    }
</style>
