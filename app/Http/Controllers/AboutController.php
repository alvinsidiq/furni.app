<?php

namespace App\Http\Controllers;

use App\Models\WhyChooseUs;
use App\Models\Team;
use App\Models\Testimonial;

class AboutController extends Controller
{
    public function index()
    {
        $whyChooseUs = WhyChooseUs::all();
        $teams = Team::all();
        $testimonials = Testimonial::all();

        return view('about', compact('whyChooseUs', 'teams', 'testimonials'));
    }
}