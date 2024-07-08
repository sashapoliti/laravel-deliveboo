@extends('layouts.admin')

@section('title', 'Ordine ' . $order->id)

@section('content')
    <div class="container mt-5">
        <h1 class="my-3">Ordine</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Cellulare</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Totale</th>
                <th scope="col">Data & ora</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->customer_name}}</td>
                    <td>{{ $order->customer_surname }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ $order->customer_address }}</td>
                    <td>{{ $order->total_price }} €</td>
                    <td>{{ $order->created_at->format('H:i') }} {{ $order->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ route('admin.orders.index') }}">Indietro</a></td>
                </tr>
            </tbody>
        </table>

        <h2 class="my-3">Dettagli ordine</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Quantita</th>
                <th scope="col">Prezzo</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($order->plates as $plate)
                    <tr>
                        <td>{{ $plate->name }}</td>
                        <td>{{ $plate->pivot->quantity }}</td>
                        <td>{{ $plate->pivot->price }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>   
@endsection