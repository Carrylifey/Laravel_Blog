@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4"> 

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($blogs as $blog)
                <div id="blog-card-{{ $blog->id }}" class="relative flex flex-col overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-md" style="height: 450px; width: 100%;">
                    <div class="relative w-full h-48 overflow-hidden text-gray-700 bg-transparent rounded-t-xl">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <p class="text-gray-600">No image found</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex-grow">
                        <h4 class="block font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            {{ $blog->title }}
                        </h4>
                        <p class="block mt-3 font-sans text-md antialiased font-normal leading-relaxed text-gray-700">
                            {{ Str::limit($blog->content, 100, '...') }}
                        </p>
                    </div>
                    <!-- Created by, Date, and Action buttons aligned -->
                    <div class="flex items-center justify-between p-6">
                        <div class="flex flex-col">
                            <p class="block font-sans text-sm antialiased font-normal leading-relaxed text-gray-500">
                                Created by: {{ $blog->user->name }}
                            </p>
                            <p class="block font-sans text-base antialiased font-normal leading-relaxed text-inherit">
                                {{ $blog->created_at->format('F j, Y') }}
                            </p>
                        </div>
                        <!-- Action icons -->
                        <div class="flex space-x-4">
                            <a  class="text-blue-500 hover:text-blue-700 cursor-pointer" title="Edit Blog">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="text-green-500 hover:text-green-700 cursor-pointer" title="View Blog">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                            @auth
                            @if($blog->user_id === auth()->id())
                               <!-- Update the button to use AJAX for deletion -->
<a href="#" class="text-red-500 hover:text-red-700 cursor-pointer delete-blog" data-id="{{ $blog->id }}" title="Delete Blog">
    <i class="fas fa-trash fa-lg"></i>
</a>

                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
     <!-- Modal -->
<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full transform scale-90 transition-transform duration-300">
        <h3 class="text-xl font-semibold mb-6">Confirm Deletion</h3>
        <p class="mb-6 text-lg">Are you sure you want to delete this blog?</p>
        <div class="flex justify-end space-x-4">
            <button id="confirmDelete" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600 transition-colors duration-300 text-lg">Delete</button>
            <button id="cancelDelete" class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400 transition-colors duration-300 text-lg">Cancel</button>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    $(document).ready(function() {
        let currentBlogId;

        // Show modal on delete button click
        $(document).on('click', '.delete-blog', function(e) {
            e.preventDefault();
            currentBlogId = $(this).data('id');
            $('#deleteModal').removeClass('opacity-0 pointer-events-none');
            $('#deleteModal').addClass('opacity-100');
        });

        // Cancel delete
        $('#cancelDelete').on('click', function() {
            $('#deleteModal').removeClass('opacity-100');
            $('#deleteModal').addClass('opacity-0 pointer-events-none');
        });

        // Confirm delete
        $('#confirmDelete').on('click', function() {
            let url = "{{ route('blogs.destroy', ':id') }}".replace(':id', currentBlogId);
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    toastr.success('Blog deleted successfully');
                    $('#blog-card-' + currentBlogId).remove();
                    $('#deleteModal').removeClass('opacity-100');
                    $('#deleteModal').addClass('opacity-0 pointer-events-none');
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while deleting the blog');
                    $('#deleteModal').removeClass('opacity-100');
                    $('#deleteModal').addClass('opacity-0 pointer-events-none');
                }
            });
        });
    });
    </script>
@endsection
