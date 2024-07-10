@extends('layouts.admin')

@section('title', $restaurants[0]->name)

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header"
                style="background-image: url({{ $restaurants[0]->image ? asset('storage/' . $restaurants[0]->image) : '/img/placeholder.svg' }})">
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center my-3">
                    <div class="logo">
                        <img src="{{ $restaurants[0]->logo ? asset('storage/' . $restaurants[0]->logo) : '/img/placeholder.svg' }}"
                            alt="{{ $restaurants[0]->name }}">
                    </div>
                    <h2 class="mx-3">{{ $restaurants[0]->name }}</h2>
                    @if ($restaurants[0]->types !== null)
                        @foreach ($restaurants[0]->types as $type)
                            <span class="badge mx-1">{{ $type->name }}</span>
                        @endforeach
                    @endif
                </div>
                <div>
                    <h5>Descrizione</h5>
                    <p class="mb-2">{{ $restaurants[0]->description }}</p>
                    <h5>Indirizzo</h5>
                    <p class="mb-2">{{ $restaurants[0]->address }}</p>
                    <h5>Partita IVA</h5>
                    <p>{{ $restaurants[0]->vat_number }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>
    .card {
        background-color: transparent !important;
        box-shadow: none !important;

        .card-header {
            height: 400px;
            background-size: cover;
            background-position: center;
        }

        .card-body {
            .logo {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                overflow: hidden;
                img {
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }
            }
            .badge {
                background-color: #ffb061;
            }
        }
    }
</style>
