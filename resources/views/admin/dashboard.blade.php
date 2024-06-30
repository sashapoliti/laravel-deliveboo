@extends('layouts.admin')

@section('content')

<div class="container">

  {{-- <table class="tb-glass">
    <thead>
        <tr>
          <th scope="col" class="d-none d-lg-table-cell">Id</th>
          <th scope="col" class="d-none d-lg-table-cell">Id-user</th>
          <th scope="col">address</th>
          <th scope="col" class="d-none d-xl-table-cell">vat number</th>
          <th scope="col">name</th>
          <th scope="col">image</th>
          <th scope="col">description</th>
          <th scope="col">logo</th>
          <th scope="col">slug</th>
          <th scope="col">piatto</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($restaurants as $restaurant)
        <tr>
            <td class="d-none d-lg-table-cell">{{$restaurant->id}}</td>
            <td>{{$restaurant->user->name}}</td>
            <td>{{$restaurant->address}}</td>
            <td class="d-none d-xl-table-cell">{{$restaurant->vat_number}}</td>
            <td>{{$restaurant->name}}</td>
            <td>{{$restaurant->image}}</td>
            <td>{{$restaurant->description}}</td>
            <td>{{$restaurant->logo}}</td>
            <td>{{$restaurant->slug}}</td>
            <td>{{$restaurant->plates[0]->name}}</td>
        </tr>
        @endforeach
      </tbody>
  </table> --}}

  <div class="row mt-5">
    <div class="col-12 col-md-6 col-lg-3">
      <div class="card">
        <div class="card-title">
          <h2 class="m-3">Total orders</h2>
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
          <h1 class="card-title">10</h1>
          <div class="mx-2">
            <i class="fa-solid fa-utensils" style="font-size: 40px ; color: rgb(0, 0, 0, 0.5)"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card">
        <div class="card-title">
          <h2 class="m-3">Guadagni</h2>
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
          <h1 class="card-title">10 €</h1>
          <div class="mx-2 d-flex mb-3">
            <i class="fa-solid fa-hand-holding-dollar" style="font-size: 50px ; color: rgb(0, 0, 0, 0.5)"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card">
        <div class="card-title">
          <h2 class="m-3">Attività</h2>
        </div>
        <div class="card-body d-flex justify-content-between align-items-center ">
          <h4 class="card-title d-flex flex-wrap">{{$restaurants[0]->name}}</h4>
          <div class="mx-2">
            <i class="fa-solid fa-shop" style="font-size: 40px ; color: rgb(0, 0, 0, 0.5)"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5 ">
    <div style="width: 900px"><canvas id="guadagni"></canvas></div>
  </div>

</div>


  @endsection












