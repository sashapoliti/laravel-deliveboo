@extends('layouts.admin')

@section('content')

<div class="container">

  <table class="tb-glass">
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
  </table>

</div>


  @endsection
