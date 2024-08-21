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
