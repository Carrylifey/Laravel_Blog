@extends('layouts.app')

@section('content')

<!-- form to create blog -->
<div class="max-w-2xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-bold mb-4">Create a New Blog Post</h1>

    <form id="createBlogForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" name="content" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="4" required></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <input type="text" id="category" name="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save
            </button>
        </div>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        $('#createBlogForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Show success message using Toastr
                    toastr.success('Blog post created successfully!');
                    //reset the form
                    $('#createBlogForm')[0].reset();
                    // Redirect to home after 1 second
                    setTimeout(function() {
                        window.location.href = '/home';
                    }, 1000); // 1.2-second delay before redirecting
                    
                },
                error: function (xhr) {
                    // Show error message using Toastr
                    toastr.error('An error occurred: ' + xhr.responseText);
                }
            });
        });
    });
</script>

@endsection