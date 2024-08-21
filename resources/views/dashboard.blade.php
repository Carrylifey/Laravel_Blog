<x-app-layout>
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
                            <a  class="text-green-500 hover:text-green-700 cursor-pointer" title="View Blog">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    $(document).ready(function() {
        // Handle the click event for delete links
        $(document).on('click', '.delete-blog', function(e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to delete this blog?')) {
                return;
            }

            let blogId = $(this).data('id');
            let url = "{{ route('blogs.destroy', ':id') }}".replace(':id', blogId);
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    toastr.success('Blog deleted successfully');
                    // Remove the blog card from the DOM
                    $('#blog-card-' + blogId).remove();
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while deleting the blog');
                }
            });
        });
    });
</script>
</x-app-layout>
