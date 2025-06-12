<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'user_id' => 1,
            'total_amount' => 500.00,
            'status' => 'pending',
        ]);
        Order::create([
            'user_id' => 2,
            'total_amount' => 750.50,
            'status' => 'completed',
        ]);
        Order::create([
            'user_id' => 3,
            'total_amount' => 300.75,
            'status' => 'pending',
        ]);
        Order::create([
            'user_id' => 4,
            'total_amount' => 1000.00,
            'status' => 'completed',
        ]);
        Order::create([
            'user_id' => 5,
            'total_amount' => 450.25,
            'status' => 'cancelled',
        ]);
    }
}