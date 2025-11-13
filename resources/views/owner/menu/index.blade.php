@extends('layouts.app')
@section('title', 'Kelola Menu | MejaKu')

@php
$owner = $user->owner;
@endphp

@section('content')
<div x-data="{ category: 'makanan' }" class="relative max-w-lg mx-auto min-h-screen px-10 py-8">
    <button onclick="window.history.back()" class="flex items-center gap-3 py-2 hover:bg-gray-100 rounded-full transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900 my-3">Kelola Menu</h1>
    </button>

    {{-- Input Pencarian --}}
    <div class="space-y-5">
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
        <div class="flex  justify-between  items-center">
            <button @click="category = 'makanan'"
                :class="category === 'makanan' ? 'bg-red-700 text-white' : 'bg-white border border-gray-300 text-gray-800'"
                class="px-5 py-2 rounded-full text-sm font-medium transition mb-3">
                Makanan
            </button>
            <button @click="category = 'minuman'"
                :class="category === 'minuman' ? 'bg-red-700 text-white' : 'bg-white border border-gray-300 text-gray-800'"
                class="px-4 py-2 rounded-full text-sm font-medium transition mb-3">
                Minuman
            </button>
            <button @click="category = 'dessert'"
                :class="category === 'dessert' ? 'bg-red-700 text-white' : 'bg-white border border-gray-300 text-gray-800'"
                class="px-4 py-2 rounded-full text-sm font-medium transition mb-3">
                Dessert
            </button>
            <button @click="category = 'lainnya'"
                :class="category === 'lainnya' ? 'bg-red-700 text-white' : 'bg-white border border-gray-300 text-gray-800'"
                class="px-4 py-2 rounded-full text-sm font-medium transition mb-3">
                Lainnya
            </button>
        </div>
    </div>

    {{-- Grid Menu Berdasarkan Kategori --}}
    @foreach (['makanan', 'minuman', 'dessert', 'lainnya'] as $kategori)
    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-4"
        x-show="category === '{{ $kategori }}'" x-transition>
        @php
        $filteredMenus = $menus->where('kategori', $kategori);
        @endphp

        @forelse ($filteredMenus as $menu)
        <div
            class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="relative">
                <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama }}"
                    class="w-full h-32 object-cover">
                <a href="{{ route('menu.edit', ['id' => $menu->id]) }}"
                    class="absolute top-2 right-2 bg-red-700 text-white p-1.5 rounded-md shadow-sm hover:bg-red-800 transition"
                    title="Edit Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2.121 2.121 0 113 3L12 14H9v-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 19H5a2 2 0 01-2-2V7a2 2 0 012-2h7" />
                    </svg>
                </a>
            </div>
            <div class="p-3 text-center">
                <h3 class="text-sm font-semibold text-gray-800">{{ $menu->nama }}</h3>
                <p class="text-xs text-gray-500">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
            </div>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500 text-sm py-4">
            Belum ada menu {{ $kategori }}.
        </p>
        @endforelse
    </section>
    @endforeach

    {{-- Tombol Tambah Menu --}}
    <div class="pt-4">
        <a href="{{ route('menu.create', ['id' => $owner->id]) }}"
            class="block w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-3 rounded-full transition-all duration-200 shadow-sm hover:shadow-md text-center">
            Tambah Menu
        </a>
    </div>
</div>
@endsection