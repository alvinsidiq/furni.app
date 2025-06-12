<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run()
    {
        Team::create([
            'name' => 'Lawson Arnold',
            'position' => 'CEO, Founder, Atty.',
            'image' => 'person_1.jpg',
            'description' => 'Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
        ]);
        Team::create([
            'name' => 'Jeremy Walker',
            'position' => 'CEO, Founder, Atty.',
            'image' => 'person_2.jpg',
            'description' => 'Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
        ]);
        Team::create([
            'name' => 'Patrik White',
            'position' => 'CEO, Founder, Atty.',
            'image' => 'person_3.jpg',
            'description' => 'Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
        ]);
        Team::create([
            'name' => 'Kathryn Ryan',
            'position' => 'CEO, Founder, Atty.',
            'image' => 'person_4.jpg',
            'description' => 'Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
        ]);
    }
}