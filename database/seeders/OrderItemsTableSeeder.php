<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{
    public function run()
    {
        OrderItem::create([
            'order_id' => 1,
            'furniture_id' => 1,
            'quantity' => 2,
            'price' => 250.00,
        ]);
        OrderItem::create([
            'order_id' => 2,
            'furniture_id' => 2,
            'quantity' => 1,
            'price' => 750.50,
        ]);
        OrderItem::create([
            'order_id' => 3,
            'furniture_id' => 3,
            'quantity' => 3,
            'price' => 100.25,
        ]);
        OrderItem::create([
            'order_id' => 4,
            'furniture_id' => 4,
            'quantity' => 1,
            'price' => 1000.00,
        ]);
        OrderItem::create([
            'order_id' => 5,
            'furniture_id' => 5,
            'quantity' => 2,
            'price' => 225.13,
        ]);
    }
}