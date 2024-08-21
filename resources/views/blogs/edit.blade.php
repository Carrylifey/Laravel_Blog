@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-bold mb-4">Edit Blog Post</h1>

    <form id="editBlogForm" action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" name="content" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="4" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" class="mt-2 w-32 h-32 object-cover">
            @endif
        </div>

        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <input type="text" id="category" name="category" value="{{ old('category', $blog->category) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
