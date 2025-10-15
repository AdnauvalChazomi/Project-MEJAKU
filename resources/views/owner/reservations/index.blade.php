@extends('layouts.app')
@section('title', 'Manajemen Reservasi | MejaKu')

@section('content')
<div x-data="{ activeTab: 'penuh' }" class="min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-10">

    {{-- Header --}}
    <header class="flex items-center gap-3">
        <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Manajemen Reservasi</h1>
    </header>

    {{-- Filter Status Meja --}}
    <section>
        <h2 class="text-sm font-semibold text-gray-700 mb-3">Meja</h2>
        <div class="grid grid-cols-3 gap-3">
            <button @click="activeTab = 'penuh'"
                :class="activeTab === 'penuh' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                <p>Penuh</p>
                <p class="text-lg font-bold">10</p>
            </button>

            <button @click="activeTab = 'tersedia'"
                :class="activeTab === 'tersedia' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                <p>Tersedia</p>
                <p class="text-lg font-bold">8</p>
            </button>

            <button @click="activeTab = 'direservasi'"
                :class="activeTab === 'direservasi' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                <p>Direservasi</p>
                <p class="text-lg font-bold">8</p>
            </button>
        </div>
    </section>

    {{-- Konten Dinamis --}}
    <section>
        {{-- === TAB: PENUH === --}}
        <div x-show="activeTab === 'penuh'" x-transition>
            <h2 class="text-sm font-semibold text-gray-700 mb-3 mt-6">Meja</h2>
            <div class="space-y-4">
                @foreach (range(1, 2) as $i)
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between mb-2">
                        <div>
                            <p class="text-xs font-semibold text-red-600 uppercase">Grup • 5 Tamu</p>
                            <h3 class="text-sm font-bold text-gray-800">Budi Budiman</h3>
                            <p class="text-xs text-gray-500">1x Pizza<br>1x Es Kopi Susu</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Nomor Meja</p>
                            <p class="text-base font-semibold text-gray-900">2</p>
                            <p class="text-sm font-semibold text-red-600 mt-1">Rp 50.000</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-600 mt-2">
                        <p>Senin, 11 Januari 2025</p>
                        <p class="font-semibold text-gray-900">15:30</p>
                    </div>

                    <div class="flex gap-2 mt-3">
                        <span
                            class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">Penuh</span>
                        <button
                            class="flex-1 border border-gray-200 rounded-lg text-sm py-2 hover:bg-gray-100 transition font-medium">Ubah
                            Pesanan</button>
                        <button
                            class="flex-1 border border-gray-200 rounded-lg text-sm py-2 hover:bg-gray-100 transition font-medium">Sudah
                            Kosong</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- === TAB: TERSEDIA === --}}
        <div x-show="activeTab === 'tersedia'" x-transition>
            <h2 class="text-sm font-semibold text-gray-700 mb-3 mt-6">Meja</h2>
            <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                @foreach (range(1, 16) as $num)
                <button
                    class="bg-white border border-gray-200 rounded-xl text-gray-800 font-semibold text-sm py-5 shadow-sm hover:bg-[#FDEEDC] hover:shadow-md transition">
                    {{ $num }}
                </button>
                @endforeach
            </div>
        </div>

        {{-- === TAB: DIRESERVASI === --}}
        <div x-show="activeTab === 'direservasi'" x-transition>
            <h2 class="text-sm font-semibold text-gray-700 mb-3 mt-6">Meja</h2>
            <div class="space-y-4">
                @foreach (range(1, 2) as $i)
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between mb-2">
                        <div>
                            <p class="text-xs font-semibold text-red-600 uppercase">Grup</p>
                            <h3 class="text-sm font-bold text-gray-800">Budi Budiman</h3>
                            <p class="text-xs text-gray-500">1x Pizza<br>1x Es Kopi Susu</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Nomor Meja</p>
                            <p class="text-base font-semibold text-gray-900">2</p>
                            <p class="text-sm font-semibold text-red-600 mt-1">Rp 50.000</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-600 mt-2">
                        <p>Senin, 11 Januari 2025</p>
                        <p class="font-semibold text-gray-900">15:30</p>
                    </div>

                    <div class="flex gap-2 mt-3">
                        <span
                            class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Cancel</span>
                        <span
                            class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Sudah Datang</span>
                    </div>

                    <div class="flex gap-2 mt-3">
                        <button
                            class="flex-1 border border-gray-200 rounded-lg text-sm py-2 hover:bg-gray-100 transition font-medium">Hubungi
                            Customer</button>
                        <button
                            class="flex-1 border border-gray-200 rounded-lg text-sm py-2 hover:bg-gray-100 transition font-medium">Belum
                            Datang</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection