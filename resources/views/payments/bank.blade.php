@extends('layouts.app')
@section('title', 'MejaKu - Pembayaran Transfer Bank')

@section('navbar')
<header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
    <button onclick="window.history.back()" class="hover:text-red-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <h1 class="text-lg font-bold text-red-600 tracking-tight">Pembayaran</h1>
    <div class="w-6"></div>
</header>
@endsection

@section('content')
<main class="p-4 max-w-lg mx-auto space-y-5 min-h-screen lg:mb-10">

    <section class="bg-white border rounded-lg p-6 shadow-sm space-y-4">

        <!-- Countdown & Info -->
        <section x-data="{ time: 86399, interval: null }"
            x-init="interval = setInterval(() => { if (time > 0) time-- }, 1000)"
            class="bg-white border rounded-lg p-4 shadow-sm text-sm">
            <div class="flex justify-between items-center mb-1">
                <p class="text-gray-600">Bayar Dalam</p>
                <p class="text-red-600 font-semibold"
                    x-text="`${Math.floor(time/3600)} jam ${Math.floor((time%3600)/60)} menit ${String(time%60).padStart(2,'0')} detik`"></p>
            </div>
            <div class="text-xs text-gray-500">Jatuh tempo 11 Oktober 2025, 01:07</div>
        </section>

        <!-- Bank Info -->
        <section x-data="{ copied: false }" class="bg-white border rounded-lg p-4 shadow-sm space-y-3">
            <div class="flex items-center gap-3">
                <img src="https://storage.googleapis.com/storage-ajaib-prd-platform-wp-artifact/2019/12/Logo-BCA.jpg"
                    alt="Bank BCA" class="w-10 h-10 object-contain rounded">
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Bank BCA</p>
                    <p class="text-xs text-gray-500">No. Rek / Virtual Account</p>
                </div>
            </div>

            <div class="flex justify-between items-center border-t pt-2">
                <p class="text-xl tracking-wide font-semibold text-red-600">126 0853 6690 7885</p>
                <button
                    @click="navigator.clipboard.writeText('126085366907885'); copied = true; setTimeout(() => copied = false, 2000)"
                    class="text-red-500 text-sm hover:text-red-600 font-medium">
                    <span x-text="copied ? 'Disalin!' : 'Salin'"></span>
                </button>
            </div>
        </section>

        <!-- Total Pembayaran -->
        <section class="bg-white border rounded-lg p-4 shadow-sm flex justify-between items-center">
            <p class="text-gray-600 font-medium text-sm">Total Pembayaran</p>
            <p class="text-red-600 font-bold text-base">Rp78.639</p>
        </section>

        <!-- Petunjuk Pembayaran -->
        <section x-data="{ openSection: null }" class="bg-white border rounded-lg p-2 shadow-sm divide-y text-sm text-gray-700">

            <!-- mBanking -->
            <div class="py-2">
                <button
                    @click="openSection === 'mbank' ? openSection = null : openSection = 'mbank'"
                    class="w-full flex justify-between items-center text-left px-2 py-2 hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800">Petunjuk Transfer mBanking</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        :class="openSection === 'mbank' ? 'rotate-180 text-gray-500' : 'rotate-0 text-gray-400'"
                        class="w-5 h-5 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openSection === 'mbank'" x-transition
                    class="px-4 pb-3 mt-1 text-xs text-gray-600 space-y-1 border-t pt-2">
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Pilih <strong>m-Transfer &gt; BCA Virtual Account</strong>.</li>
                        <li>Masukkan nomor VA <span class="text-red-600 font-semibold">126 0853 6690 7885</span> dan pilih <strong>Send</strong>.</li>
                        <li>Pastikan Merchant: <strong>MejaKu</strong> dan nominal benar, lalu pilih <strong>Ya</strong>.</li>
                        <li>Masukkan PIN m-BCA dan pilih <strong>OK</strong>.</li>
                        <li>Jika muncul notifikasi <em>“Transaksi Gagal”</em>, coba melalui KlikBCA (iBanking) atau ATM.</li>
                    </ol>
                </div>
            </div>

            <!-- iBanking -->
            <div class="py-2">
                <button
                    @click="openSection === 'ibank' ? openSection = null : openSection = 'ibank'"
                    class="w-full flex justify-between items-center text-left px-2 py-2 hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800">Petunjuk Transfer iBanking</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        :class="openSection === 'ibank' ? 'rotate-180 text-gray-500' : 'rotate-0 text-gray-400'"
                        class="w-5 h-5 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openSection === 'ibank'" x-transition
                    class="px-4 pb-3 mt-1 text-xs text-gray-600 space-y-1 border-t pt-2">
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Pilih <strong>Transfer Dana &gt; ke BCA Virtual Account</strong>.</li>
                        <li>Masukkan nomor VA <span class="text-red-600 font-semibold">126085366907885</span> lalu klik <strong>Lanjutkan</strong>.</li>
                        <li>Pastikan Merchant: <strong>MejaKu</strong> dan nominal sesuai tagihan, lalu klik <strong>Ya</strong>.</li>
                        <li>Masukkan respon KeyBCA, lalu klik <strong>Kirim</strong>.</li>
                    </ol>
                </div>
            </div>

            <!-- ATM -->
            <div class="py-2">
                <button
                    @click="openSection === 'atm' ? openSection = null : openSection = 'atm'"
                    class="w-full flex justify-between items-center text-left px-2 py-2 hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800">Petunjuk Transfer ATM</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        :class="openSection === 'atm' ? 'rotate-180 text-gray-500' : 'rotate-0 text-gray-400'"
                        class="w-5 h-5 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openSection === 'atm'" x-transition
                    class="px-4 pb-3 mt-1 text-xs text-gray-600 space-y-1 border-t pt-2">
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Pilih <strong>Transaksi Lainnya &gt; Transfer &gt; ke Rek. BCA Virtual Account</strong>.</li>
                        <li>Masukkan nomor VA <span class="text-red-600 font-semibold">126085366907885</span> dan pilih <strong>Benar</strong>.</li>
                        <li>Periksa nama Merchant: <strong>MejaKu</strong> dan total pembayaran, jika benar pilih <strong>Ya</strong>.</li>
                    </ol>
                </div>
            </div>
        </section>


        <!-- Button -->
        <a href="{{ route('status') }}"
            class="block w-full text-center bg-red-600 text-white py-3 rounded-lg font-semibold 
                  hover:bg-red-700 active:scale-95 focus:outline-none 
                  focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out 
                  shadow-md hover:shadow-lg">
            OK
        </a>
    </section>
</main>
@endsection