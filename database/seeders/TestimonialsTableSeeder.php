<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    public function run()
    {
        Testimonial::create([
            'name' => 'Maria Jones',
            'position' => 'CEO, XYZ Inc.',
            'quote' => 'Great service and amazing furniture!',
            'image' => 'images/person-1.jpg',
        ]);
        Testimonial::create([
            'name' => 'Robert Fox',
            'position' => 'Designer',
            'quote' => 'Highly recommend their custom designs.',
            'image' => 'images/person-2.jpg',
        ]);
        Testimonial::create([
            'name' => 'Emily Davis',
            'position' => 'Homeowner',
            'quote' => 'Fast delivery and excellent quality.',
            'image' => 'images/person-3.jpg',
        ]);
        Testimonial::create([
            'name' => 'Michael Lee',
            'position' => 'Architect',
            'quote' => 'Perfect for modern interior design.',
            'image' => 'images/person-4.jpg',
        ]);
        Testimonial::create([
            'name' => 'Sarah Green',
            'position' => 'Interior Designer',
            'quote' => 'Outstanding customer support.',
            'image' => 'images/person-5.jpg',
        ]);
    }
}