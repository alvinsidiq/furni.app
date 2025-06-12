<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhyChooseUs;

class WhyChooseUsSeeder extends Seeder
{
    public function run()
    {
        WhyChooseUs::create([
            'title' => 'Fast & Free Shipping',
            'icon' => 'truck.svg',
            'description' => 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.',
        ]);
        WhyChooseUs::create([
            'title' => 'Easy to Shop',
            'icon' => 'bag.svg',
            'description' => 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.',
        ]);
        WhyChooseUs::create([
            'title' => '24/7 Support',
            'icon' => 'support.svg',
            'description' => 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.',
        ]);
        WhyChooseUs::create([
            'title' => 'Hassle Free Returns',
            'icon' => 'return.svg',
            'description' => 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.',
        ]);
    }
}