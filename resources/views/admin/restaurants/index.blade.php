@extends('layouts.admin')

@section('title', $restaurants[0]->name)

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header"
                style="background-image: url({{ $restaurants[0]->image ? asset('storage/' . $restaurants[0]->image) : 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg' }})">
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center my-3">
                    <div class="logo">
                        <img src="{{ $restaurants[0]->logo ? asset('storage/' . $restaurants[0]->logo) : 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg' }}"
                            alt="{{ $restaurants[0]->name }}">
                    </div>
                    <h2 class="mx-3">{{ $restaurants[0]->name }}</h2>
                    @if ($restaurants[0]->types !== null)
                        @foreach ($restaurants[0]->types as $type)
                            <span class="badge bg-primary mx-1">{{ $type->name }}</span>
                        @endforeach
                    @endif
                </div>
                <div>
                    <h5>Description</h5>
                    <p class="mb-2">{{ $restaurants[0]->description }}</p>
                    <h5>Address</h5>
                    <p class="mb-2">{{ $restaurants[0]->address }}</p>
                    <h5>VAT number</h5>
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
            height: 300px;
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
                    width: 100%;
                    height: 100%;
                }
            }
        }
    }
</style>
