<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    public function run()
    {
        Feature::create([
            'title' => 'Quality Materials',
            'description' => 'We use only the best materials.',
            'icon' => 'fa-star',
        ]);
        Feature::create([
            'title' => 'Fast Delivery',
            'description' => 'Get your order delivered quickly.',
            'icon' => 'fa-truck',
        ]);
        Feature::create([
            'title' => 'Affordable Prices',
            'description' => 'Competitive prices for everyone.',
            'icon' => 'fa-dollar',
        ]);
        Feature::create([
            'title' => 'Custom Designs',
            'description' => 'Tailored designs to your needs.',
            'icon' => 'fa-paint-brush',
        ]);
        Feature::create([
            'title' => 'Customer Support',
            'description' => '24/7 support for our customers.',
            'icon' => 'fa-headset',
        ]);
    }
}