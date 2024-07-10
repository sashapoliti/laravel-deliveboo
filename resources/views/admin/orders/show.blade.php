@extends('layouts.admin')

@section('title', 'Ordine ' . $order->id)

@section('content')
    
    <div class="container mt-5 m-auto">
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.orders.index') }}">
                <button class="back-button ">
                    <div class="back-button-box">
                        <span class="back-button-elem">
                            <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                                </path>
                            </svg>
                        </span>
                        <span class="back-button-elem ">
                            <svg viewBox="0 0 46 40">
                                <path
                                    d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </button>
            </a>
        </div>
        <div>
            <h1 class="my-3 ">Informazioni cliente</h1>
            <ul>
                <li><strong>Nome</strong>: {{ $order->customer_name }}</li>
                <li><strong>Cognome</strong>: {{ $order->customer_surname }}</li>
                <li><strong>Email</strong>: {{ $order->customer_email }}</li>
                <li><strong>Cellulare</strong>: {{ $order->customer_phone }}</li>
                <li><strong>Indirizzo</strong>: {{ $order->customer_address }}</li>
                <li><strong>Totale</strong>: {{ $order->total_price }} €</li>
                <li><strong>Data ordine</strong>: {{ $order->created_at->format('H:i') }}
                    {{ $order->created_at->format('d/m/Y') }}</li>
            </ul>
        </div>
       
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
