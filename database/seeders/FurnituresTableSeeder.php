<?php

namespace Database\Seeders;

use App\Models\Furnitures;
use Illuminate\Database\Seeder;

class FurnituresTableSeeder extends Seeder
{
    public function run()
    {
        $images = [
            'images/product-1.png',
            'images/product-2.png',
            'images/product-3.png',
        ];

        $products = [
            [
                'name' => 'Minimalist Sofa',
                'price' => 599.99,
                'description' => 'A modern, space-saving sofa for small apartments.',
                'stock' => 5,
            ],
            [
                'name' => 'Wooden Coffee Table',
                'price' => 199.99,
                'description' => 'Elegant coffee table made from solid oak.',
                'stock' => 10,
            ],
            [
                'name' => 'Bookshelf Organizer',
                'price' => 129.50,
                'description' => 'Multi-tier bookshelf to keep things tidy.',
                'stock' => 8,
            ],
            [
                'name' => 'Lounge Chair',
                'price' => 349.00,
                'description' => 'Comfortable lounge chair for relaxation.',
                'stock' => 6,
            ],
            [
                'name' => 'Office Desk',
                'price' => 420.00,
                'description' => 'Spacious desk ideal for home offices.',
                'stock' => 3,
            ],
            [
                'name' => 'Nightstand Drawer',
                'price' => 85.25,
                'description' => 'Compact drawer perfect for bedside essentials.',
                'stock' => 9,
            ],
            [
                'name' => 'Wardrobe Closet',
                'price' => 720.40,
                'description' => 'Large wardrobe with sliding doors and mirror.',
                'stock' => 2,
            ],
            [
                'name' => 'Kitchen Stool Set',
                'price' => 149.95,
                'description' => 'Set of 2 sturdy kitchen stools with back support.',
                'stock' => 12,
            ],
        ];

        foreach ($products as $index => $product) {
            Furnitures::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'stock' => $product['stock'],
                'image' => $images[$index % count($images)],
            ]);
        }
    }
}
