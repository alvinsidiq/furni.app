<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        return view('features.index', compact('features'));
    }

    public function create()
    {
        return view('features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        Feature::create($request->all());

        return redirect()->route('features.index')->with('success', 'Feature added successfully.');
    }

    public function show(Feature $feature)
    {
        return view('features.show', compact('feature'));
    }

    public function edit(Feature $feature)
    {
        return view('features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        $feature->update($request->all());

        return redirect()->route('features.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('features.index')->with('success', 'Feature deleted successfully.');
    }
}