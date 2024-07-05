<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = config('Order_db.orders');
        foreach ($orders as $order) {            
            $new_order = new Order();
            $new_order->restaurant_id = $order['restaurant_id'];
            $new_order->customer_name = $order['customer_name'];
            $new_order->customer_surname = $order['customer_surname'];
            $new_order->customer_email = $order['customer_email'];
            $new_order->customer_phone = $order['customer_phone'];
            $new_order->customer_address = $order['customer_address'];
            $new_order->total_price = $order['total_price'];
            $new_order->save();
        }
    }
}
