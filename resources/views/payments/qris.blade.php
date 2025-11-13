@extends('layouts.app')
@section('title', 'MejaKu - Pembayaran QRIS')

@section('navbar')
<!-- Header -->
<header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
    <button onclick="window.history.back()" class="hover:text-[#9D3935] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <h1 class="text-lg font-bold text-[#9D3935] tracking-tight">QRIS</h1>
    <div class="w-6"></div>
</header>
@endsection

@section('content')
<main class="p-4 max-w-lg mx-auto space-y-5 min-h-screen lg:mb-10">
    <!-- QRIS Section -->
    <section class="bg-white border rounded-lg p-6 shadow-sm text-center space-y-4">
        <h2 class="text-base font-semibold text-gray-800">Pindai QR Code di bawah ini</h2>
        <p class="text-xs text-gray-500">Gunakan aplikasi pembayaran favoritmu (GoPay, OVO, DANA, ShopeePay, dll)</p>
        <div class="flex justify-center">
            <div class="border-4 border-gray-200 p-2 rounded-xl">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=MejaKu-#ZX3ER5GGS"
                    alt="QRIS Code" class="w-44 h-44 object-contain rounded-lg">
            </div>
        </div>
        <div class="text-center">
            <p class="text-xs text-gray-500 mt-2">Nominal pembayaran:</p>
            <p class="text-lg font-bold text-gray-800">Rp74.800</p>
        </div>
        <!-- Countdown Timer -->
        <div x-data="{ time: 900, interval: null }" x-init="interval = setInterval(() => { if (time > 0) time-- }, 1000)" class="mt-3">
            <p class="text-sm text-gray-600">Sisa waktu pembayaran:</p>
            <p class="text-lg font-semibold text-[#9D3935]"
                x-text="`${Math.floor(time/60)}:${String(time%60).padStart(2,'0')}`"></p>
        </div>

        <!-- Button -->
        <a href="{{ route('status') }}"
            class="block w-full text-center bg-[#9D3935] text-white py-3 rounded-lg font-semibold 
                  hover:bg-red-700 active:scale-95 focus:outline-none 
                  focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out 
                  shadow-md hover:shadow-lg">
            OK
        </a>
    </section>


</main>
@endsection