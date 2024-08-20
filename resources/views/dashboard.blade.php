<x-app-layout>
@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg">
        <p>{{ session('success') }}</p>
    </div>
@endif

</x-app-layout>
