<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Halaman publik untuk menampilkan semua blog dan testimonial
    public function index()
    {
        $blogs = Blog::orderBy('published_at', 'desc')->get(); // Urutkan berdasarkan tanggal terbaru
        $testimonials = Testimonial::all(); // Ambil semua testimonial
        return view('blog', compact('blogs', 'testimonials'));
    }

    // Menampilkan form tambah blog (admin)
    public function create()
    {
        return view('blogs.create');
    }

    // Simpan blog baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'image' => 'image|nullable|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->author = $request->author;
        $blog->published_at = $request->published_at;

        if ($request->hasFile('image')) {
            $blog->image = $request->file('image')->store('images', 'public');
        }

        $blog->save();

        return redirect()->route('blog')->with('success', 'Blog added successfully.');
    }

    // Menampilkan detail satu blog (admin atau publik)
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    // Menampilkan form edit blog (admin)
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    // Update blog (admin)
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'image' => 'image|nullable|max:2048',
        ]);

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->author = $request->author;
        $blog->published_at = $request->published_at;

        if ($request->hasFile('image')) {
            $blog->image = $request->file('image')->store('images', 'public');
        }

        $blog->save();

        return redirect()->route('blog')->with('success', 'Blog updated successfully.');
    }

    // Hapus blog (admin)
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog')->with('success', 'Blog deleted successfully.');
    }
}
