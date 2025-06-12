<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Furnitures;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all(); // Ambil semua layanan
        $furnitures = Furnitures::take(3)->get(); // Ambil 3 furniture
        $testimonials = Testimonial::all(); // Ambil semua testimonial

        return view('services', compact('services', 'furnitures', 'testimonials'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:255', // hanya nama file svg (contoh: truck.svg)
        ]);

        Service::create($request->only(['title', 'description', 'icon']));

        return redirect()->route('services.index')->with('success', 'Service added successfully.');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:255',
        ]);

        $service->update($request->only(['title', 'description', 'icon']));

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
