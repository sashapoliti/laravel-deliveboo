@extends('layouts.admin')

@section('title', 'Ordini')

@section('content')
    <div class="container my-5">
        @if ($orders->count() == 0)
            <h1 class="my-3">Non ci sono ancora Ordini</h1>
        @else
            <h1 class="my-3">Ordini ({{ $orders->count() }})</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Cellulare</th>
                        <th scope="col">Totale</th>
                        <th scope="col">Data & ora</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->customer_phone }}</td>
                            <td>{{ $order->total_price }} €</td>
                            <td>{{ $order->created_at->format('H:i') }} {{ $order->created_at->format('d/m/Y') }}</td>
                            <td><a href="{{ route('admin.orders.show', $order->id) }}">Dettagli</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
