@extends('layouts.app')
@section('title', 'Tambah Menu | MejaKu')

@section('content')
<div x-data="{ showSuccessPopup: false }" class="min-h-screen bg-gray-50 px-10 py-8 space-y-8 max-w-lg mx-auto">
    <button onclick="window.history.back()" class="flex items-center gap-3 py-2 hover:bg-gray-100 rounded-full transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Tambah Menu</h1>
    </button>

    {{-- Form --}}
    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-2xl mx-auto space-y-6">
        @csrf

        {{-- Foto --}}
        <div class="space-y-2">
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Menu</label>
            <input type="file" name="foto" id="foto"
                class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('foto')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="space-y-2">
            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="kategori" id="kategori"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @foreach ($kategoriOptions as $kategori)
                <option value="{{ $kategori }}" {{ old('kategori') === $kategori ? 'selected' : '' }}>
                    {{ ucfirst($kategori) }}
                </option>
                @endforeach
            </select>
            @error('kategori')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nama Menu --}}
        <div class="space-y-2">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Menu</label>
            <input type="text" name="nama" id="nama" placeholder="Tulis nama menu..."
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
            @error('nama')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="space-y-2">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Tulis deskripsi singkat..."
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>
            @error('deskripsi')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Harga --}}
        <div class="space-y-2">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                <input type="number" name="harga" id="harga" placeholder="Contoh: 20000"
                    class="w-full pl-10 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            @error('harga')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3 pt-4">
            <a href="{{ route('menu.index', ['id' => $user->owner->id]) }}"
                class="flex-1 py-3 border-2 border-red-600 text-[#9D3935] rounded-lg font-medium hover:bg-red-50 transition-colors text-center">
                Batal
            </a>
            <button type="submit"
                class="flex-1 py-3 bg-[#9D3935] text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                Simpan
            </button>
        </div>
    </form>

    {{-- Success Message --}}
    @if (session('success'))
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-2xl animate-fade-in">
            <div class="text-center">
                <h2 class="text-xl font-bold text-[#9D3935] mb-4">Berhasil!</h2>
                <p class="text-gray-600 mb-6">{{ session('success') }}</p>
                <a href="{{ route('menu.index', ['id' => $user->owner->id]) }}"
                    class="w-full inline-block py-3 bg-[#9D3935] text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                    Kembali ke Daftar Menu
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- CSS Animation --}}
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</div>
@endsection