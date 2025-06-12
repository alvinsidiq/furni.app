<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote' => 'required|string',
            'image' => 'image|nullable|max:2048',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->quote = $request->quote;

        if ($request->hasFile('image')) {
            $testimonial->image = $request->file('image')->store('images', 'public');
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote' => 'required|string',
            'image' => 'image|nullable|max:2048',
        ]);

        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->quote = $request->quote;

        if ($request->hasFile('image')) {
            $testimonial->image = $request->file('image')->store('images', 'public');
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}