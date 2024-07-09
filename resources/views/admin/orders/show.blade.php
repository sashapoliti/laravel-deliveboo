@extends('layouts.admin')

@section('title', 'Ordine ' . $order->id)

@section('content')
    <div class="container mt-5">
        <h1 class="my-3">Cliente</h1>
        <ul>
            <li><strong>Nome</strong>: {{ $order->customer_name }}</li>
            <li><strong>Cognome</strong>: {{ $order->customer_surname }}</li>
            <li><strong>Email</strong>: {{ $order->customer_email }}</li>
            <li><strong>Cellulare</strong>: {{ $order->customer_phone }}</li>
            <li><strong>Indirizzo</strong>: {{ $order->customer_address }}</li>
            <li><strong>Totale</strong>: {{ $order->total_price }} €</li>
            <li><strong>Data ordine</strong>: {{ $order->created_at->format('H:i') }} {{ $order->created_at->format('d/m/Y') }}</li>
        </ul>

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