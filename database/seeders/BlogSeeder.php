<?php

namespace Database\Seeders;
use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'title' => 'First Blog Post',
            'content' => 'This is the first blog content.',
            'author' => 'John Doe',
            'published_at' => now(),
            'image' => 'images/sample.jpg',
        ]);
    }
}
