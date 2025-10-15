@extends('layouts.app')
@section('title', 'Kelola Menu | MejaKu')

@section('content')
<div x-data="{ category: 'makanan' }" class="min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-8">

    {{-- Header --}}
    <header class="flex items-center gap-3">
        <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Kelola Menu</h1>
    </header>

    {{-- Search & Tabs --}}
    <div class="space-y-5">
        {{-- Search Bar --}}
        <div class="relative">
            <input type="text" placeholder="Cari Disini..."
                class="w-full rounded-full border border-gray-200 bg-white pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm placeholder-gray-400" />
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3.5 top-2.5 text-gray-400"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        {{-- Tabs Kategori --}}
        <div class="flex items-center gap-3">
            <button @click="category = 'makanan'"
                :class="category === 'makanan' ? 'bg-red-700 text-white' : 'bg-white border border-gray-300 text-gray-800'"
                class="px-4 py-2 rounded-full text-sm font-medium transition">
                Makanan
            </button>
            <button @click="category = 'minuman'"
                :class="category === 'minuman' ? 'bg-red-700 text-white' : 'bg-white border border-gray-300 text-gray-800'"
                class="px-4 py-2 rounded-full text-sm font-medium transition">
                Minuman
            </button>
            <button
                class="ml-auto p-2.5 rounded-full bg-red-700 hover:bg-red-800 text-white shadow-sm transition"
                title="Tambah Kategori">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Grid Menu --}}
    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" x-show="category === 'makanan'" x-transition>
        @foreach ([
            ['img' => 'https://images.unsplash.com/photo-1601924582971-d9da5f4c67af?w=800&q=80', 'name' => 'Pizza', 'price' => 'Rp 25.000'],
            ['img' => 'https://images.unsplash.com/photo-1632207194852-8e8bb8a24d43?w=800&q=80', 'name' => 'Tahu', 'price' => 'Rp 25.000'],
            ['img' => 'https://images.unsplash.com/photo-1632207194852-8e8bb8a24d43?w=800&q=80', 'name' => 'Bakso Goreng', 'price' => 'Rp 25.000'],
        ] as $menu)
        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="relative">
                <img src="{{ $menu['img'] }}" alt="{{ $menu['name'] }}" class="w-full h-32 object-cover">
                <button
                    class="absolute top-2 right-2 bg-red-700 text-white p-1.5 rounded-md shadow-sm hover:bg-red-800 transition"
                    title="Edit Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5h2m2 0h2M5 5h2m-2 4h14m-14 4h14m-14 4h14" />
                    </svg>
                </button>
            </div>
            <div class="p-3 text-center">
                <h3 class="text-sm font-semibold text-gray-800">{{ $menu['name'] }}</h3>
                <p class="text-xs text-gray-500">{{ $menu['price'] }}</p>
            </div>
        </div>
        @endforeach
    </section>

    {{-- Grid Minuman --}}
    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" x-show="category === 'minuman'" x-transition>
        @foreach ([
            ['img' => 'https://images.unsplash.com/photo-1588361861040-7e0b9c9b1b57?w=800&q=80', 'name' => 'Es Teh Manis', 'price' => 'Rp 10.000'],
            ['img' => 'https://images.unsplash.com/photo-1613470209380-1e7b12a23d25?w=800&q=80', 'name' => 'Kopi Susu', 'price' => 'Rp 15.000'],
        ] as $menu)
        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="relative">
                <img src="{{ $menu['img'] }}" alt="{{ $menu['name'] }}" class="w-full h-32 object-cover">
                <button
                    class="absolute top-2 right-2 bg-red-700 text-white p-1.5 rounded-md shadow-sm hover:bg-red-800 transition"
                    title="Edit Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5h2m2 0h2M5 5h2m-2 4h14m-14 4h14m-14 4h14" />
                    </svg>
                </button>
            </div>
            <div class="p-3 text-center">
                <h3 class="text-sm font-semibold text-gray-800">{{ $menu['name'] }}</h3>
                <p class="text-xs text-gray-500">{{ $menu['price'] }}</p>
            </div>
        </div>
        @endforeach
    </section>

    {{-- Tombol Tambah --}}
    <div class="pt-4">
        <button
            class="w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-3 rounded-full transition-all duration-200 shadow-sm hover:shadow-md">
            Tambah Menu
        </button>
    </div>

</div>
@endsection
