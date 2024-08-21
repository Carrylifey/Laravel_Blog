<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- toaster css -->
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        
        <style>
            /* Custom styles for the floating button */
            .floating-button {
                position: fixed;
                bottom: 16px;
                right: 16px;
                background: linear-gradient(560deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 45%, rgba(252,176,69,1) 100%);
                color: white;
                border-radius: 50%;
                width: 56px;
                height: 56px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                cursor: pointer;
                font-size: 24px;
                text-align: center;
            }
            
        </style>
    </head>
    <body class="font-sans antialiased">
        
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @yield('content')

            <!-- Floating Add Button -->
            @if(auth()->check() && Route::currentRouteName() === 'home')
    <div class="floating-button text-black" onclick="window.location.href='{{ route('blogs.create')}}'">
        +
    </div>
@endif
        </div>
    </body>
</html>
