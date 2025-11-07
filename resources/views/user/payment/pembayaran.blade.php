@extends('layouts.app')
@section('title', 'MejaKu - Pembayaran')

@section('navbar')
<!-- Header -->
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


<!-- Content -->
<main class="p-4 max-w-lg mx-auto space-y-5 min-h-screen">

    <!-- Ringkasan Pesanan -->
    <section class="bg-white border rounded-lg p-4 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-700 mb-3">Ringkasan Pesanan</h2>
        <div class="text-sm text-gray-600 space-y-1">
            <p><span class="font-medium">Nama:</span> Budi Budiman</p>
            <p><span class="font-medium">Nomor Pemesanan:</span> #ZX3ER5GGS</p>
            <p><span class="font-medium">Waktu Pemesanan:</span> 08 Okt 2025, 11:30</p>
            <p><span class="font-medium">Nomor Meja:</span> 12</p>
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
                <p>Total Bayar</p>
                <p>Rp74.800</p>
            </div>
        </div>
    </section>

    <!-- Pilihan Metode Pembayaran -->
    <section x-data="{ method: '', openWallet: false, openBank: false, selectedWallet: '', selectedBank: '' }" class="bg-white border rounded-lg p-4 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-700 mb-3">Pilih Metode Pembayaran</h2>

        <div class="space-y-3">
            <!-- QRIS -->
            <div class="border rounded-lg">
                <label
                    @click="method = 'qris'; openWallet = false; openBank = false"
                    class="flex items-center justify-between p-3 cursor-pointer hover:bg-gray-50 transition"
                    :class="method === 'qris' ? 'bg-red-50 border-red-400' : ''">

                    <div class="flex items-center gap-3">
                        <!-- Icon -->
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-br from-rose-100 to-rose-50 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-rose-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h7v7H3V3zm11 0h7v7h-7V3zm-11 11h7v7H3v-7zm11 3h3v4h-4v-3h1v-1z" />
                            </svg>
                        </div>

                        <!-- Label -->
                        <div>
                            <p class="font-medium text-sm text-gray-800">QRIS</p>
                            <p class="text-xs text-gray-500">Bayar menggunakan QR Code</p>
                        </div>
                    </div>

                    <input type="radio" x-model="$parent.method" value="qris" class="text-red-600 focus:ring-red-500">
                </label>
            </div>



            <!-- E-Wallet -->
            <div class="border rounded-lg">
                <label
                    @click="openWallet = !openWallet"
                    @click="openWallet = !openWallet; method = 'ewallet'"
                    class="flex items-center justify-between p-3 cursor-pointer hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-br from-amber-100 to-amber-50 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-amber-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 7h16a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V9a2 2 0 012-2zm0 0V5a2 2 0 012-2h8" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-sm text-gray-800">E-Wallet</p>
                            <p class="text-xs text-gray-500">
                                <span x-text="selectedWallet || 'Pilih E-Wallet'"></span>
                            </p>
                        </div>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        :class="openWallet ? 'rotate-180 text-gray-600' : 'rotate-0 text-gray-400'"
                        class="w-5 h-5 transition-transform duration-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>

                <!-- Dropdown E-Wallet -->
                <div
                    x-show="openWallet"
                    x-transition
                    class="border-t bg-gray-50 divide-y rounded-b-lg">

                    <template x-for="wallet in ['GoPay', 'OVO', 'Dana', 'ShopeePay']" :key="wallet">
                        <label
                            @click="selectedWallet = wallet; openWallet = true; method = 'ewallet'"
                            class="flex items-center justify-between px-4 py-3 cursor-pointer hover:bg-white transition text-sm text-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-sm">
                                    <img x-bind:src="{
                                    'GoPay': 'https://image.typedream.com/cdn-cgi/image/width=1920,format=auto,fit=scale-down,quality=100/https://api.typedream.com/v0/document/public/63415083-1cfa-45b6-a801-eaea508fe972/2oYgiVPUa27XyepRpUf6O2SEcnG_cover_294.jpg',
                                    'OVO': 'https://statik.tempo.co/data/2018/07/05/id_716914/716914_720.jpg',
                                    'Dana': 'https://career.amikom.ac.id/images/company/cover/1637497527.jpeg',
                                    'ShopeePay': 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYbvDZ8ZqhvJNYauPANxRiK7f7pTfOFiMbiQ&s'
                                }[wallet]" class="w-6 h-6 object-contain" alt="">
                                </div>
                                <span x-text="wallet"></span>
                            </div>
                            <input type="radio" x-model="$parent.method" value="ewallet" class="text-red-600 focus:ring-red-500">
                        </label>
                    </template>
                </div>
            </div>

            <!-- Transfer Bank -->
            <div class="border rounded-lg">
                <label
                    @click="openBank = !openBank"
                    class="flex items-center justify-between p-3 cursor-pointer hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-100 to-blue-50 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10l9-7 9 7v10a1 1 0 01-1 1H4a1 1 0 01-1-1V10zm4 11V9h10v12" />
                            </svg>
                        </div>

                        <div>
                            <p class="font-medium text-sm text-gray-800">Transfer Bank</p>
                            <p class="text-xs text-gray-500">
                                <span x-text="selectedBank || 'Pilih Bank Tujuan'"></span>
                            </p>
                        </div>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        :class="openBank ? 'rotate-180 text-gray-600' : 'rotate-0 text-gray-400'"
                        class="w-5 h-5 transition-transform duration-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>

                <!-- Dropdown Bank -->
                <div
                    x-show="openBank"
                    x-transition
                    class="border-t bg-gray-50 divide-y rounded-b-lg">

                    <template x-for="bank in ['BCA', 'Mandiri', 'BNI', 'BRI']" :key="bank">
                        <label
                            @click="selectedBank = bank; openBank = true; method = 'bank'"
                            class="flex items-center justify-between px-4 py-3 cursor-pointer hover:bg-white transition text-sm text-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-sm">
                                    <img x-bind:src="{
                                    'BCA': 'https://storage.googleapis.com/storage-ajaib-prd-platform-wp-artifact/2019/12/Logo-BCA.jpg',
                                    'Mandiri': 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzqyd3OsoeckWT0v_bJNZDQnSeHc_CnoSVNw&s',
                                    'BNI': 'https://i.pinimg.com/474x/08/3e/1b/083e1bd16f0badfcfce58fae5fa2d523.jpg',
                                    'BRI': 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUA2kqUQIf_RTz3evvjkgAjnKC_piTxR0RUg&s'
                                }[bank]" class="w-8 h-4 object-contain" alt="">
                                </div>
                                <span x-text="bank"></span>
                            </div>
                            <input type="radio" x-model="$parent.method" value="bank" class="text-red-600 focus:ring-red-500">
                        </label>
                    </template>
                </div>
            </div>
        </div>

        <!-- Tombol Pembayaran -->
            <button
                @click="
            if (method === 'qris') {
                window.location.href='{{ route('payment.qris') }}';
            } else if (method === 'ewallet') {
                window.location.href='{{ route('payment.wallet') }}';
            } else if (method === 'bank') {
                window.location.href='{{ route('payment.bank') }}';
            } else {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
            }
        "
                class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold 
               hover:bg-red-700 active:scale-95 focus:outline-none 
               focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out 
               shadow-md hover:shadow-lg my-6"
               x-data
            x-init="$watch('method', value => console.log('Metode dipilih:', value))">
                Bayar Sekarang
            </button>
    </section>


</main>
@endsection