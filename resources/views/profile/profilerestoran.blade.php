@extends('layouts.app')
@section('title', 'Profil Restoran | MejaKu')

@section('content')
<div x-data="{ activeTab: 'tentang' }" class="max-w-2xl mx-auto space-y-6">

    {{-- Header --}}
    <header class="flex items-center gap-3">
        <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Tambah Promo</h1>
    </header>

    <!-- Tabs Navigation -->
    <div class="border-b border-gray-300">
        <nav class="flex space-x-8">
            <button @click="activeTab = 'tentang'" 
                    :class="{'border-red-600 text-[#9D3935]': activeTab === 'tentang', 'text-gray-500 hover:text-gray-700': activeTab !== 'tentang'}"
                    class="py-3 px-1 border-b-2 font-medium text-sm focus:outline-none">
                Tentang
            </button>
            <button @click="activeTab = 'menu'" 
                    :class="{'border-red-600 text-[#9D3935]': activeTab === 'menu', 'text-gray-500 hover:text-gray-700': activeTab !== 'menu'}"
                    class="py-3 px-1 border-b-2 font-medium text-sm focus:outline-none">
                Menu Unggulan
            </button>
            <button @click="activeTab = 'ulasan'" 
                    :class="{'border-red-600 text-[#9D3935]': activeTab === 'ulasan', 'text-gray-500 hover:text-gray-700': activeTab !== 'ulasan'}"
                    class="py-3 px-1 border-b-2 font-medium text-sm focus:outline-none">
                Ulasan
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div x-show="activeTab === 'tentang'" class="space-y-6">

        <!-- Photo Section -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Photo</label>
            <p class="text-sm text-gray-600">Tambahkan foto interior restoran Anda.</p>
            
            <!-- Main Photo -->
            <div class="relative rounded-lg overflow-hidden bg-red-400 h-48 flex items-center justify-center">
                <span class="text-white text-xl font-bold">Interior Restoran</span>
                <div class="absolute top-2 right-2 bg-white rounded-full p-1 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </div>
            </div>

            <!-- Photo Gallery -->
            <div class="flex space-x-2 mt-4">
                <div class="w-20 h-20 bg-red-400 rounded-lg flex items-center justify-center text-white font-medium">
                    Foto 1
                </div>
                <div class="w-20 h-20 bg-red-400 rounded-lg flex items-center justify-center text-white font-medium">
                    Foto 2
                </div>
                <div class="w-20 h-20 bg-red-400 rounded-lg flex items-center justify-center text-white font-medium">
                    Foto 3
                </div>
                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Nama Restoran Section -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-[#9D3935]">Nama Restoran</label>
            <div class="flex items-center justify-between p-3 border border-gray-300 rounded-lg">
                <span class="text-gray-900">Cafe Lorem</span>
                <button class="text-[#9D3935] hover:text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-5L20.586 19H19.072a2 2 0 00-2 2V20a2 2 0 002 2h1.072a2 2 0 002-2v-1.072a2 2 0 00-2-2H19.072M19.072 19H19.072" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Jam Buka Section -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-[#9D3935]">Jam Buka</label>
            <div class="flex items-center justify-between p-3 border border-gray-300 rounded-lg">
                <span class="text-gray-900">08:00 - 22:00</span>
                <button class="text-[#9D3935] hover:text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-5L20.586 19H19.072a2 2 0 00-2 2V20a2 2 0 002 2h1.072a2 2 0 002-2v-1.072a2 2 0 00-2-2H19.072M19.072 19H19.072" />
                    </svg>
                </button>
            </div>
        </div>

    </div>

    <!-- Menu Unggulan Tab Content -->
    <div x-show="activeTab === 'menu'" class="space-y-6 hidden">
        <div class="text-center py-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 1m3-1v12" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 6l-3 1m0 0l3 1m-3-1v12" />
            </svg>
            <p class="text-gray-600">Belum ada menu unggulan yang ditambahkan.</p>
            <button class="mt-4 px-4 py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700 transition-colors">
                Tambah Menu Unggulan
            </button>
        </div>
    </div>

    <!-- Ulasan Tab Content -->
    <div x-show="activeTab === 'ulasan'" class="space-y-6 hidden">
        <div class="text-center py-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V5.1A2.1 2.1 0 0112.982 3H19a2 2 0 012 2v12a2 2 0 01-2 2h-7a2 2 0 01-2-2v-7.882a2 2 0 01.68-1.495L12 6.82z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-6z" />
            </svg>
            <p class="text-gray-600">Belum ada ulasan dari pelanggan.</p>
        </div>
    </div>
</div>

@endsection