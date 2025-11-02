<x-guest-layout>
    <form method="POST" action="{{ route('register.owner') }}">
    @csrf
    
    <div class="max-w-2xl mx-auto space-y-6 py-8">

    <!-- Header -->
    <div class="text-center space-y-2">
        <h1 class="text-2xl font-bold text-red-600">MejaKu Partner</h1>
    </div>

    <!-- Payment Details -->
    <div class="space-y-6">
        <h2 class="text-lg font-semibold text-gray-900">Detail Pembayaran Mitra</h2>
        
        <!-- Total Amount -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Total</label>
            <div class="text-2xl font-bold text-gray-900">Rp 260.000</div>
        </div>

        <!-- Virtual Account Number -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Nomor Virtual Akun</label>
            <div class="text-xl font-mono bg-gray-50 p-3 rounded-lg">12345678909876</div>
        </div>

        <!-- Payment Instructions -->
        <div class="space-y-2">
            <h3 class="font-medium text-gray-900">Tata Cara</h3>
            <ol class="list-decimal list-inside space-y-1 text-gray-700">
                <li>Masuk ke menu Transfer pada myBCA.</li>
                <li>Pilih Virtual Account > Transfer to new beneficiary.</li>
                <li>Masukkan Kode Pembayaran 12345678909876.</li>
                <li>Masukkan PIN Anda, lalu pilih Kirim.</li>
                <li>Status transaksi akan dikirim melalui SMS dan dapat digunakan sebagai bukti pembayaran.</li>
            </ol>
        </div>

        <!-- Deadline -->
        <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="text-sm text-gray-600">Selesaikan pembayaranmu sebelum</p>
                <p class="text-xl font-bold text-gray-900">28 Juli 2025 23.59 WIB</p>
            </div>
        </div>
    </div>

    <!-- Check Payment Status Button -->
    <div class="pt-8">
        <button class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Periksa Status Pembayaran
        </button>
    </div>
</div>
</x-guest-layout>