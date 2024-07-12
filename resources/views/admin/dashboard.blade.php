@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    @php
        $totalOrders = count($orders);
        $totalEarnings = $orders->sum('total_price');
    @endphp



    <div class="container">

        <div class="row mt-5">
            <div class="col-11 col-md-6 col-lg-4">
                <div class="card dash-card">
                    <div class="card-title">
                        <h2 class="m-3">Ordini</h2>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h1 class="card-title">{{ $totalOrders }} </h1>
                        <div class="mx-2">
                            <i class="fa-solid fa-utensils" style="font-size: 40px ; color: rgb(0, 0, 0, 0.5)"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-11 col-md-6 col-lg-4">
                <div class="card dash-card">
                    <div class="card-title">
                        <h2 class="m-3">Guadagni</h2>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h1 class="card-title">{{ $totalEarnings }},00 €</h1>
                        <div class="mx-2 d-flex mb-3">
                            <i class="fa-solid fa-hand-holding-dollar"
                                style="font-size: 50px ; color: rgb(0, 0, 0, 0.5)"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-11 col-md-6 col-lg-4">
                <div class="card dash-card">
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
            <div class="mt-5 d-flex flex-wrap">
                <div class="graph p-2" style="width: 50%; min-width: 300px">
                    <h2 class="ms-3">Guadagni mensili</h2>
                    <div class="mt-3">
                        <div style="width: 100%"><canvas id="guadagni"></canvas></div>
                    </div>
                </div>

                <div class="graph p-2" style="width: 50%; min-width: 300px">
                    <h2 class="ms-3">Ordini mensili</h2>
                    <div class="mt-3">
                        <div style="width: 100%"><canvas id="ordersChart"></canvas></div>
                    </div>
                </div>
            </div>  
        </div>


    </div>
    <script>
        const monthlyData = @json($monthlyData);
        const startMonth = @json($startMonth);
        const orderCounts = @json($orderCounts);
    </script>

@endsection

<style lang="scss" scoped>
@media screen and (max-width: 1300px) {
   .graph {
       width: 100% !important;
       min-width: 0 !important;
   } 
}
</style>