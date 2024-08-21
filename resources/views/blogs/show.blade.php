@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-3 h-full w-full ">
        <a href="{{ route('home') }}" class="text-grey-500 hover:text-green-700 mb-4 inline-block">
            <i class="fas fa-arrow-left fa-lg"></i> Back
        </a>
        <div class="bg-lime-200 p-8 rounded-lg shadow-lg max-w-4xl mx-auto h-full">
            <h1 class="text-3xl font-semibold mb-4">{{ $blog->title }}</h1>
            <div class="mb-6">
                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-full h-auto rounded-lg">
                @else
                    <div class="w-full h-64 flex items-center justify-center bg-gray-200 rounded-lg">
                        <p class="text-gray-600">No image found</p>
                    </div>
                @endif
            </div>
            <p class="text-lg mb-4">{{ $blog->content }}</p>
            <p class="text-sm text-gray-500">Created by: {{ $blog->user->name }}</p>
            <p class="text-sm text-gray-500">Created on: {{ $blog->created_at->format('F j, Y') }}</p>
            <div class="mt-4">
                <a href="{{ route('home') }}" class="ext-grey-500 hover:text-green-700">Back to Home</a>
            </div>
        </div>
    </div>
@endsection
