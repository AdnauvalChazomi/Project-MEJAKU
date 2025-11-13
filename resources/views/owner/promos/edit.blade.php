@extends('layouts.app')
@section('title', 'Edit Promo | MejaKu')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 py-8">

    {{-- Header --}}
    <header class="flex items-center gap-3 mb-6">
        <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Edit Promo</h1>
    </header>

    {{-- Form Edit Promo --}}
    <form action="{{ route('owner.promos.update', $promo->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nama Promo --}}
        <div>
            <label for="nama_promo" class="block text-sm font-medium text-gray-700">Nama Promo</label>
            <input type="text" name="nama_promo" id="nama_promo"
                value="{{ old('nama_promo', $promo->nama_promo) }}"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Contoh: Diskon Akhir Pekan">
            @error('nama_promo')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kode Promo --}}
        <div>
            <label for="kode" class="block text-sm font-medium text-gray-700">Kode Promo</label>
            <input type="text" name="kode" id="kode"
                value="{{ old('kode', $promo->kode) }}"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Contoh: WEEKEND50">
            @error('kode')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tipe Diskon --}}
        <div>
            <label for="tipe_diskon" class="block text-sm font-medium text-gray-700">Tipe Diskon</label>
            <select name="tipe_diskon" id="tipe_diskon"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <option value="">Pilih tipe diskon</option>
                <option value="persentase" {{ old('tipe_diskon', $promo->tipe_diskon) == 'persentase' ? 'selected' : '' }}>Persen (%)</option>
                <option value="nominal" {{ old('tipe_diskon', $promo->tipe_diskon) == 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
            </select>
            @error('tipe_diskon')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nilai_diskon" class="block text-sm font-medium text-gray-700">Nilai Diskon</label>
            <input type="number" name="nilai_diskon" id="nilai_diskon" step="0.01"
                value="{{ old('nilai_diskon', $promo->nilai_diskon) }}"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Contoh: 10 untuk 10% atau 50000 untuk Rp50.000">
            @error('nilai_diskon')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Periode Berlaku</label>
            <div class="flex gap-2">
                <input type="date" name="tanggal_mulai"
                    value="{{ old('tanggal_mulai', $promo->tanggal_mulai) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <span class="self-center text-gray-500">-</span>
                <input type="date" name="tanggal_selesai"
                    value="{{ old('tanggal_selesai', $promo->tanggal_selesai) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            @error('tanggal_mulai')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
            @error('tanggal_selesai')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Batas Penggunaan --}}
        <div>
            <label for="batas_penggunaan" class="block text-sm font-medium text-gray-700">Batas Penggunaan (opsional)</label>
            <input type="number" name="batas_penggunaan" id="batas_penggunaan"
                value="{{ old('batas_penggunaan', $promo->batas_penggunaan) }}"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Contoh: 100 untuk 100 kali penggunaan">
            @error('batas_penggunaan')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Aktif --}}
        <div class="flex items-center gap-3">
            <input type="checkbox" name="aktif" id="aktif" value="1"
                {{ old('aktif', $promo->aktif) ? 'checked' : '' }}
                class="h-5 w-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
            <label for="aktif" class="text-sm font-medium text-gray-700">Promo aktif</label>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3 pt-4">
            <a href="{{ route('owner.promos.index') }}"
                class="flex-1 py-3 border-2 border-red-600 text-red-600 rounded-lg font-medium hover:bg-red-50 transition-colors text-center">
                Batal
            </a>
            <button type="submit"
                class="flex-1 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
