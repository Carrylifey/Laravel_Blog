<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create()
{
    return view('blogs.create');
}
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'category' => 'required|string|max:255',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    Blog::create([
        'title' => $request->title,
        'content' => $request->content,
        'image' => $imagePath,
        'category' => $request->category,
        'user_id' => auth()->id(),
    ]);

    // return redirect()->route('blogs.index');
    return redirect()->route('home');
}
public function index()
{
    $blogs = Blog::all();
    return view('dashboard', compact('blogs'));
}

}
