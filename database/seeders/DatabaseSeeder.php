<?php

namespace Database\Seeders;

use App\Models\Furnitures;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
           
            WhyChooseUsSeeder::class,
            TeamSeeder::class,
             FurnituresTableSeeder::class,
            // FeaturesTableSeeder::class,
            // ServicesTableSeeder::class,
            // TestimonialsTableSeeder::class,
            // BlogsTableSeeder::class,
        ]);
    }
}