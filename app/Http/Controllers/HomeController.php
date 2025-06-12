<?php

namespace App\Http\Controllers;

use App\Models\Furnitures;
use App\Models\Testimonial;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $furnitures = Furnitures::take(3)->get(); // Ambil 3 furnitur untuk Product Section
        $popularFurnitures = Furnitures::take(3)->get(); // Ambil 3 furnitur populer
        $testimonials = Testimonial::all();
        $recentBlogs = Blog::orderBy('published_at', 'desc')->take(3)->get(); // Ambil 3 blog terbaru
        return view('home', compact('furnitures', 'popularFurnitures', 'testimonials', 'recentBlogs'));
    }
}