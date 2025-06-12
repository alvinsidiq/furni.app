<?php

namespace App\Http\Controllers;

use App\Models\Furnitures;
use Illuminate\Http\Request;

class FurnituresController extends Controller
{
    public function index()
    {
        $furnitures = Furnitures::all();
        return view('furnitures.index', compact('furnitures'));
    }

    public function create()
    {
        return view('furnitures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'image|nullable|max:2048',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
        ]);

        $furniturres = new Furnitures();
        $furniturres->name = $request->name;
        $furniturres->price = $request->price;
        $furniturres->description = $request->description;
        $furniturres->stock = $request->stock;

        if ($request->hasFile('image')) {
            $furniturres->image = $request->file('image')->store('images', 'public');
        }

        $furniturres->save();

        return redirect()->route('furnitures.index')->with('success', 'Furnitures added successfully.');
    }

    public function show(Furnitures $furniturres)
    {
        return view('furniturres.show', compact('furniturres'));
    }

    public function edit(Furnitures $furniturres)
    {
        return view('furniturres.edit', compact('furniturres'));
    }

    public function update(Request $request, Furnitures $furniturres)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'image|nullable|max:2048',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
        ]);

        $furniturres->name = $request->name;
        $furniturres->price = $request->price;
        $furniturres->description = $request->description;
        $furniturres->stock = $request->stock;

        if ($request->hasFile('image')) {
            $furniturres->image = $request->file('image')->store('images', 'public');
        }

        $furniturres->save();

        return redirect()->route('furnitures.index')->with('success', 'Furnitures updated successfully.');
    }

    public function destroy(Furnitures $furnitures)
    {
        $furnitures->delete();
        return redirect()->route('furnitures.index')->with('success', 'Furnitures deleted successfully.');
    }
}