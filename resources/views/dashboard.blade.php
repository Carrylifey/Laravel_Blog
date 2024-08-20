<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">All Blogs</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($blogs as $blog)
                <div class="relative flex max-w-[24rem] flex-col overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-full h-auto rounded-t-xl">
                        @else
                            <div class="w-full h-48 flex items-center justify-center bg-gray-200 rounded-t-xl">
                                <p class="text-gray-600">No image found</p>
                            </div>
                        @endif
                    <div class="p-6">
                        <h4 class="block font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            {{ $blog->title }}
                        </h4>
                        <p class="block mt-3 font-sans text-xl antialiased font-normal leading-relaxed text-gray-700">
                            {{ $blog->content }}
                        </p>
                        <p class="block mt-3 font-sans text-sm antialiased font-normal leading-relaxed text-gray-500">
                            Created by: {{ $blog->user->name }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between p-6">
                        <!-- Action icons -->
                        <div class="flex space-x-4">
                            <a  class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                            <a  class="text-green-500 hover:text-green-700">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                            <form  method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>
                            </form>
                        </div>
                        <p class="block font-sans text-base antialiased font-normal leading-relaxed text-inherit">
                            {{ $blog->created_at->format('F j, Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Floating add button -->
        <a href="{{ route('blogs.create') }}" class="fixed bottom-4 right-4 bg-gradient-to-r from-yellow-500 to-red-500 text-white p-3 rounded-full shadow-lg">
            Add
        </a>
    </div>
</x-app-layout>
