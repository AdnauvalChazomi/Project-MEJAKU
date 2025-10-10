@extends('layouts.app')
@section('title', 'MejaKu - Detail Pesanan')

@section('navbar')
<!-- Header -->
<header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
    <button onclick="window.history.back()" class="hover:text-red-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <h1 class="text-lg font-bold text-red-600 tracking-tight">Detail Pesanan</h1>
    <div class="w-6"></div>
</header>
@endsection

@section('content')
<div x-data="{ openSidebar: false }" class="mx-auto min-h-screen relative">

    <!-- Content -->
    <main class="p-4 space-y-5 max-w-lg mx-auto bg-white md:rounded-lg md:mt-2 mb-10 md:p-10">
        <!-- Informasi Pemesan -->
        <section class="bg-white border rounded-lg p-4 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-700 mb-2">Informasi Pemesan</h2>
            <div class="text-sm text-gray-600 space-y-1">
                <p><span class="font-medium">Nama:</span> Budi Budiman</p>
                <p><span class="font-medium">Nomor Pemesanan:</span> #ZX3ER5GGS</p>
                <p><span class="font-medium">Waktu Pemesanan:</span> 08 Okt 2025, 11:30</p>
                <p><span class="font-medium">Nomor Meja:</span> 12</p>
            </div>
        </section>

        <!-- Daftar Pesanan -->
        <section class="bg-white border rounded-lg p-4 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Daftar Menu Dipesan</h2>

            <div class="divide-y">
                <!-- Item 1 -->
                <div class="flex justify-between items-center py-2">
                    <div class="flex items-center gap-3">
                        <img src="https://api.omela.com/storage/content-editor-images/1pH0nroeojxC0IRR9NkEaY0YCzz0vPnMzD3Mbegx.jpg"
                            alt="Pizza" class="w-12 h-12 rounded-lg object-cover">
                        <div>
                            <p class="text-sm font-medium text-gray-800">Pizza</p>
                            <p class="text-xs text-gray-500">2x Rp25.000</p>
                        </div>
                    </div>
                    <p class="text-sm font-semibold text-gray-800">Rp50.000</p>
                </div>

                <!-- Item 2 -->
                <div class="flex justify-between items-center py-2">
                    <div class="flex items-center gap-3">
                        <img src="https://api.omela.com/storage/content-editor-images/1pH0nroeojxC0IRR9NkEaY0YCzz0vPnMzD3Mbegx.jpg"
                            alt="Cappuccino" class="w-12 h-12 rounded-lg object-cover">
                        <div>
                            <p class="text-sm font-medium text-gray-800">Cappuccino</p>
                            <p class="text-xs text-gray-500">1x Rp18.000</p>
                        </div>
                    </div>
                    <p class="text-sm font-semibold text-gray-800">Rp18.000</p>
                </div>
            </div>

            <div class="border-t mt-3 pt-3">
                <div class="flex justify-between text-sm font-medium text-gray-700">
                    <p>Subtotal</p>
                    <p>Rp68.000</p>
                </div>
                <div class="flex justify-between text-sm text-gray-500">
                    <p>Pajak (10%)</p>
                    <p>Rp6.800</p>
                </div>
                <div class="flex justify-between text-base font-semibold text-gray-800 mt-2">
                    <p>Total</p>
                    <p>Rp74.800</p>
                </div>
            </div>
        </section>

        <!-- Catatan -->
        <h2 class="text-sm font-semibold text-gray-700 mb-2">Catatan untuk Dapur</h2>
        <textarea placeholder="Contoh: tanpa pedas, saus terpisah..."
            class="w-full text-sm border rounded-lg p-2 focus:ring-2 focus:ring-red-200 focus:outline-none resize-none"></textarea>

        <!-- Tombol Konfirmasi -->
        <button
            @click="window.location.href='{{ route('payment') }}'"
            class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold 
                    hover:bg-red-700 active:scale-95 focus:outline-none 
                    focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out 
                    shadow-md hover:shadow-lg">
            Konfirmasi Pesanan
        </button>
    </main>
</div>
@endsection