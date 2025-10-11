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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6">
            <div class="text-center">
                <img 
                    src="{{ asset('images/headerlogin.png') }}" 
                    alt="MejaKu" 
                    class="rounded-lg mb-2 w-24 sm:w-28 mx-auto object-contain"
                >
                <h1 class="text-2xl sm:text-3xl font-extrabold text-red-700">MejaKu</h1>
                <p class="text-lg text-black font-semibold">Selamat Datang</p>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
