<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Image processing</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('tailwind.css') }}">
    </head>
    <body class="antialiased">
        <form action="/image/upload" method="POST" enctype="multipart/form-data" class="flex flex-col items-center space-y-4">
            @csrf
            <div class="relative">
                <input type="file" name="image" class="w-full py-2 px-4 bg-gray-100 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                <span class="absolute top-0 right-0 mr-4 mt-2">
                    <i class="fas fa-upload"></i>
                </span>
            </div>
            <button type="submit" class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-transparent">
                Upload Image
            </button>
        </form>

        @if (isset($imageUrl))
            <img src="{{ $imageUrl }}" alt="">
        @endif
    </body>
</html>
