@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="my-3">Ordini</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Ristorante</th>
                <th scope="col">nome</th>
                <th scope="col">cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Cellulare</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Totale</th>	
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->restaurant->name }}</t>
                        <td>{{ $order->customer_name}}</td>
                        <td>{{ $order->customer_surname }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->total_price }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    


    </div>
   
@endsection