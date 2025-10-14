<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDEEDC] text-gray-800 min-h-screen flex flex-col">

    <header class="bg-white shadow-sm fixed top-0 left-0 right-0 z-40">
        <x-navbar />
    </header>

    <main class="flex-1 mt-16">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-auto">
        <x-footer />
    </footer>

    @stack('scripts')
</body>

</html>
