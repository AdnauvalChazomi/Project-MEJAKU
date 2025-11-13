@extends('layouts.app')
@section('title', 'MejaKu - Pembayaran E-Wallet')

@section('navbar')
<!-- Header -->
<header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
    <button onclick="window.history.back()" class="hover:text-[#9D3935] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <h1 class="text-lg font-bold text-[#9D3935] tracking-tight">E-Wallet</h1>
    <div class="w-6"></div>
</header>
@endsection

@section('content')
<main class="p-4 max-w-lg mx-auto space-y-5 min-h-screen lg:mb-10">

    <!-- E-Wallet Payment -->
    <section x-data="{ selectedWallet: 'GoPay', copied: false }" class="bg-white border rounded-lg p-6 shadow-sm space-y-5 text-center">
        <h2 class="text-base font-semibold text-gray-800">Pembayaran via E-Wallet</h2>
        <p class="text-xs text-gray-500">Transfer ke akun MejaKu melalui E-Wallet pilihanmu</p>

        <!-- Wallet Logo -->
        <div class="flex justify-center">
            <template x-if="selectedWallet === 'GoPay'">
                <img src="https://image.typedream.com/cdn-cgi/image/width=300,format=auto,fit=scale-down/https://api.typedream.com/v0/document/public/63415083-1cfa-45b6-a801-eaea508fe972/2oYgiVPUa27XyepRpUf6O2SEcnG_cover_294.jpg"
                    class="w-24 h-24 object-contain" alt="GoPay">
            </template>
            <template x-if="selectedWallet === 'OVO'">
                <img src="https://statik.tempo.co/data/2018/07/05/id_716914/716914_720.jpg"
                    class="w-24 h-24 object-contain rounded-lg" alt="OVO">
            </template>
            <template x-if="selectedWallet === 'Dana'">
                <img src="https://career.amikom.ac.id/images/company/cover/1637497527.jpeg"
                    class="w-24 h-24 object-contain rounded-lg" alt="Dana">
            </template>
            <template x-if="selectedWallet === 'ShopeePay'">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYbvDZ8ZqhvJNYauPANxRiK7f7pTfOFiMbiQ&s"
                    class="w-24 h-24 object-contain rounded-lg" alt="ShopeePay">
            </template>
        </div>

        <!-- Total Payment -->
        <div class="bg-red-50 border border-red-200 rounded-lg py-2 mt-2">
            <p class="text-sm text-gray-700">Nominal Pembayaran</p>
            <p class="text-xl font-semibold text-[#9D3935]">Rp74.800</p>
        </div>

        <p>Pembayaran akan dialihkan ke halaman resmi <span class="font-semibold text-[#9D3935]">Payment Gateway</span>.</p>

        <!-- Konfirmasi -->
    <p class="text-center text-xs text-gray-400 my-2">
       Dengan melanjutkan, kamu setuju dengan <a href="#" class="text-red-500 hover:underline">syarat & ketentuan pembayaran</a>.
   </p>
        <a href="payment_getway" target="_blank"
            class="block w-full text-center bg-[#9D3935] text-white py-3 rounded-lg font-semibold 
                   hover:bg-red-700 active:scale-95 focus:outline-none 
                   focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out 
                   shadow-md hover:shadow-lg">
            Lanjutkan Pembayaran
        </a>
    </section>
</main>
@endsection