<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

public function show($id)
{
    $blog = Blog::findOrFail($id);

    return view('blogs.show', compact('blog'));

}

// Show the form for editing the specified blog
public function edit($id)
{
    // Retrieve the blog post along with its user relationship
    $blog = Blog::with('user')->findOrFail($id);

    // Check if the authenticated user is the author of the blog post
    if ($blog->user_id !== auth()->id()) {
        // Redirect to the blog index with an error message if unauthorized
        return redirect()->route('home')->with('error', 'Unauthorized access.');
    }

    // Pass the blog data to the edit view
    return view('blogs.edit', compact('blog'));
}


//update fucntion for blog
public function update(Request $request, Blog $blog)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'category' => 'required|string|max:255',
    ]);

    // Update blog data
    $blog->title = $request->input('title');
    $blog->content = $request->input('content');
    $blog->category = $request->input('category');

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($blog->image) {
            Storage::delete($blog->image);
        }

        $imagePath = $request->file('image')->store('images', 'public');
        $blog->image = $imagePath;
    }

    $blog->save();

    return redirect()->route('home')->with('success', 'Blog post updated successfully!');
}


public function destroy($id)
{
    // Find the blog by its ID
    $blog = Blog::findOrFail($id);

    // Check if the authenticated user is the author of the blog
    if ($blog->user_id !== auth()->id()) {
        // If not, return a JSON response indicating an unauthorized access
        return response()->json(['message' => 'Unauthorized access.'], 403);
    }

    // Delete the blog
    $blog->delete();

    // Return a JSON response indicating successful deletion
    return response()->json(['message' => 'Blog deleted successfully.']);
}



}
