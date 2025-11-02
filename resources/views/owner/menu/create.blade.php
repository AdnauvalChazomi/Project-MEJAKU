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
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Tambah Menu</h1>
    </header>

    {{-- Main Content --}}
    <div class="max-w-2xl mx-auto space-y-6">
        <!-- Photo Upload Section -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Photo</label>
            <p class="text-sm text-gray-600">Tambahkan foto menu Anda.</p>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 bg-gray-50 flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-gray-500 text-sm">Klik untuk upload foto</span>
                </div>
            </div>
        </div>

        <!-- Kategori Section -->
        <div class="space-y-2">
            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select id="category" x-model="category" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="dessert">Dessert</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <!-- Nama Menu Section -->
        <div class="space-y-2">
            <label for="menu-name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
            <input type="text" id="menu-name" placeholder="Tulis nama menu di restoran Anda..." 
                   class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
        </div>

        <!-- Harga Section -->
        <div class="space-y-2">
            <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                <input type="text" id="price" placeholder="Cth. 20.000" 
                       class="w-full pl-10 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 pt-4">
            <a href="{{ url()->previous() }}" class="flex-1 py-3 border-2 border-red-600 text-red-600 rounded-lg font-medium hover:bg-red-50 transition-colors text-center">
                Batal
            </a>
            <button @click="showSuccessPopup = true" class="flex-1 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                Simpan
            </button>
        </div>
    </div>

    {{-- Success Popup --}}
    <div x-show="showSuccessPopup" @click.away="showSuccessPopup = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-2xl animate-fade-in">
            <div class="text-center">
                <h2 class="text-xl font-bold text-red-600 mb-4">Berhasil!</h2>
                <div class="mb-4">
                    <img src="https://placehold.co/200x150/e57373/ffffff?text=Menu+Illustration" alt="Menu Illustration" class="mx-auto rounded-lg">
                </div>
                <p class="text-gray-600 mb-6">Menu 'Nasi Goreng Spesial' telah berhasil ditambahkan.</p>
                <button @click="showSuccessPopup = false" class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                    Ok
                </button>
            </div>
        </div>
    </div>

    {{-- CSS Animation --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</div>
@endsection