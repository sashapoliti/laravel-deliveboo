<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderPlate;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Estrai tutti i dati dalla richiesta
        $data = $request->all();

        // Crea un nuovo ordine
        $order = new Order();
        $order->restaurant_id = $data['restaurant_id'];
        $order->customer_name = $data['customer_name'];
        $order->customer_surname = $data['customer_surname'];
        $order->customer_email = $data['customer_email'];
        $order->customer_phone = $data['customer_phone'];
        $order->customer_address = $data['customer_address'];
        $order->total_price = $data['total_price'];
        $order->save();

        // Itera attraverso i piatti nel carrello e crea le voci di OrderPlate
        foreach ($data['cart'] as $item) {
            $orderPlate = new OrderPlate();
            $orderPlate->order_id = $order->id;
            $orderPlate->plate_id = $item['product']['id'];
            $orderPlate->quantity = $item['quantity'];
            $orderPlate->price = $item['quantity'] * $item['product']['price'];
            $orderPlate->save();
        }

        // Ritorna una risposta JSON con i dati dell'ordine
        return response()->json([
            'status' => 'success',
            'message' => 'Ordine creato con successo',
            'results' => $order
        ], 200);
    }
}

