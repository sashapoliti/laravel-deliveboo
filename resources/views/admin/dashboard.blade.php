@extends('layouts.admin')

@section('content')
    <div class="container">
        @if($restaurants->count() < 1)
      <div class="my-5 d-flex justify-content-center align-items-center">
        <h1>Create a new restaurant</h1>
        <div class="mx-3 bg-secondary rounded-circle d-flex align-items-center justify-content-center" id="plus">
            <a href="{{ route('admin.restaurants.create') }}"><i class="fa-solid fa-plus text-white"></i></a>
        </div>
      </div>
      @endif

      @if ($restaurants->count() > 0)
      <div class="container">
          <div class="row mt-5">
              <div class="col-12 col-md-6 col-lg-3">
                  <div class="card " style="height: 200px">
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
                  <div class="card" style="height: 200px">
                      <div class="card-title">
                          <h2 class="m-3">Guadagni</h2>
                      </div>
                      <div class="card-body d-flex justify-content-between align-items-center">
                          <h1 class="card-title">10 €</h1>
                          <div class="mx-2 d-flex mb-3">
                              <i class="fa-solid fa-hand-holding-dollar"
                                  style="font-size: 50px ; color: rgb(0, 0, 0, 0.5)"></i>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                  <div class="card " style="height: 200px; margin-right: -15px">
                      <div class="card-title">
                          <h2 class="m-3">Attività</h2>
                      </div>
                      <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                          @if (count($restaurants) > 0)
                              <h4 class="card-title">{{ $restaurants[0]->name }}</h4>
                          @else
                              <h4 class="card-title">0</h4>
                          @endif
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
      @endif
  </div>
@endsection
