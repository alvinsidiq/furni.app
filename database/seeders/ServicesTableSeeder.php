<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'title' => 'Interior Design',
            'description' => 'Complete interior design solutions.',
        ]);
        Service::create([
            'title' => 'Furniture Assembly',
            'description' => 'Professional furniture assembly services.',
        ]);
        Service::create([
            'title' => 'Custom Furniture',
            'description' => 'Custom-made furniture to your specifications.',
        ]);
        Service::create([
            'title' => 'Home Renovation',
            'description' => 'Full home renovation services.',
        ]);
        Service::create([
            'title' => 'Consultation',
            'description' => 'Expert consultation for your home.',
        ]);
    }
}