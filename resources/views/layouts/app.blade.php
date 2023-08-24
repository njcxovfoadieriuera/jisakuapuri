<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/css/Grades.css'])
        @vite(['resources/js/hamburger2.js'])
        @vite(['resources/js/Grades.js'])
        @vite(['resources/js/chat.js'])
        @vite(['resources/js/csv.js'])
        @vite(['resources/js/map.js'])
        {{-- @vite(['resources/js/favorite.js'])
        @vite(['resources/js/folder.js'])         --}}
      
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-1">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            @include('side')

        </div>
        {{-- <script src="/js/genres.js"></script> --}}
        <script src="{{ asset('js/count.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>{{-- リッチテキスト --}}

        {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
    </body>
</html>
