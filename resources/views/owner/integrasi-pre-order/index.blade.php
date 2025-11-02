@extends('layouts.app')
@section('title', 'Integrasi Pre-Order | MejaKu')

@section('content')
<div x-data="{ active: false, menuType: 'semua', day: 'Pilih Hari', time: 'Pilih Jam' }"
    class="relative max-w-lg mx-auto min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-6">

    {{-- Header --}}
    <header class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 my-3">Integrasi Pre-Order</h1>
            <span class="ml-2 text-xs bg-red-600 text-white px-2 py-0.5 rounded-full font-semibold">PRO</span>
        </div>
    </header>

    {{-- === Aktifkan Pre-Order === --}}
    <section class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-gray-800 text-sm">Aktifkan Pre-Order</h2>
            <label for="preorder-toggle" class="relative inline-flex items-center cursor-pointer">
    <input type="checkbox" id="preorder-toggle" class="sr-only peer" x-model="active">
    <div class="relative w-11 h-6 bg-gray-300 rounded-full transition
                peer-focus:outline-none peer-checked:bg-red-700
                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all
                peer-checked:after:translate-x-full">
    </div>
</label>
        </div>

        {{-- Pilihan Menu --}}
        <div class="flex gap-3">
            <button :disabled="!active"
                @click="menuType = 'semua'"
                :class="active && menuType === 'semua'
                    ? 'bg-yellow-400 text-white'
                    : active ? 'bg-white border border-gray-300 text-gray-700' : 'bg-gray-100 text-gray-400 cursor-not-allowed'"
                class="flex-1 text-sm font-semibold py-2 rounded-lg transition">
                Semua Menu
            </button>
            <button :disabled="!active"
                @click="menuType = 'tertentu'"
                :class="active && menuType === 'tertentu'
                    ? 'bg-yellow-400 text-white'
                    : active ? 'bg-white border border-gray-300 text-gray-700' : 'bg-gray-100 text-gray-400 cursor-not-allowed'"
                class="flex-1 text-sm font-semibold py-2 rounded-lg transition">
                Menu Tertentu
            </button>
        </div>

        {{-- Atur Waktu --}}
        <div>
            <h2 class="font-semibold text-gray-800 text-sm mb-2">Atur Waktu Pre-Order</h2>
            <div class="grid grid-cols-2 gap-3">
                <div class="relative">
                    <select x-model="day"
                        :disabled="!active"
                        :class="active
                            ? 'bg-white border border-gray-300 text-gray-700'
                            : 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed'"
                        class="w-full text-sm font-medium px-3 py-2 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500">
                        <option>Pilih Hari</option>
                        <option>Setiap Hari</option>
                        <option>Senin - Jumat</option>
                        <option>Akhir Pekan</option>
                    </select>
                </div>

                <div class="relative">
                    <select x-model="time"
                        :disabled="!active"
                        :class="active
                            ? 'bg-white border border-gray-300 text-gray-700'
                            : 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed'"
                        class="w-full text-sm font-medium px-3 py-2 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500">
                        <option>Pilih Jam</option>
                        <option>08:00 - 20:00</option>
                        <option>09:00 - 18:00</option>
                        <option>10:00 - 22:00</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection