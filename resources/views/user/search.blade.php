@extends('layouts.app')
@section('title', 'Jelajahi Restoran | MejaKu')

@section('navbar')
@include('components.navbar')
@endsection

@section('content')
<section class="min-h-screen bg-[#FDEEDC] px-6 lg:px-20 py-16">

    {{-- Judul Halaman --}}
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Jelajahi Restoran</h1>
        <p class="text-gray-700 text-sm lg:text-base max-w-2xl mx-auto">
            Temukan restoran, kafe, dan tempat makan terbaik di sekitarmu
        </p>
    </div>

    {{-- Filter Lokasi --}}
    <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-14 max-w-2xl mx-auto">
        <form action="#" method="GET"
            class="flex flex-col sm:flex-row items-stretch gap-4 w-full sm:w-auto">

            {{-- Input Pencarian --}}
            <div class="relative w-full sm:w-80">
                <input type="text" placeholder="Cari berdasarkan nama atau lokasi..."
                    class="w-full px-4 py-2 pr-10 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-600 focus:outline-none">

                {{-- Ikon Search --}}
                <button type="button"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Dropdown Wilayah --}}
            <div x-data="{ open: false }" class="relative w-full sm:w-48">
                <button type="button" @click="open = !open"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-full border border-gray-300 bg-white focus:ring-2 focus:ring-red-600 text-gray-700 hover:border-red-600 transition">
                    <span>Pilih Wilayah</span>
                    <svg class="w-4 h-4 ml-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Dropdown List --}}
                <div x-show="open" @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-[#FDEEDC] hover:text-red-600 transition">Jambi</a>
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-[#FDEEDC] hover:text-red-600 transition">Kota Jambi</a>
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-[#FDEEDC] hover:text-red-600 transition">Sipin</a>
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-[#FDEEDC] hover:text-red-600 transition">Telanai</a>
                </div>
            </div>
        </form>
    </div>

    {{-- Grid Daftar Restoran --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 max-w-7xl mx-auto">
        {{-- Dummy Data --}}
        @for ($i = 1; $i <= 8; $i++)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:scale-[1.02] transition">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80"
                alt="Restoran {{ $i }}"
                class="w-full h-44 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-gray-900 text-lg">Restoran {{ $i }}</h3>
                <p class="text-sm text-gray-500">Jambi</p>

                <div class="flex items-center mt-2 text-yellow-500">
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                    </svg>
                    <span class="ml-1 text-sm text-gray-700">4.5</span>
                </div>

                <div class="mt-4">
                    <a href="{{ route('detail') }}"
                        class="block text-center py-2 rounded-full bg-red-600 text-white font-medium text-sm hover:bg-red-700 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
    </div>
    @endfor
    </div>
</section>

{{-- Alpine.js --}}
<script src="//unpkg.com/alpinejs" defer></script>
@endsection