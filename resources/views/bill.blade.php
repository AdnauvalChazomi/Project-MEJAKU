<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Pesanan | MejaKu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* Definisi warna tema utama MejaKu */
        .color-mejaku-main {
            color: #A63232;
        }

        .bg-mejaku-main {
            background-color: #A63232;
        }

        .bg-mejaku-dark {
            background-color: #8B2B2B;
        }
    </style>
</head>

<body class="bg-white">

    <div class="min-h-screen bg-white flex flex-col">

        <header class="flex items-center px-4 py-4 bg-white shadow-sm border-b sticky top-0 z-10">
            <a href="#" class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-semibold text-gray-900">Pesanan</h1>
        </header>

        <main class="max-w-lg mx-auto w-full p-4 flex-1">

            <section class="mb-8 border-b pb-6">
                <h2 class="text-sm text-gray-500 font-medium mb-1">Detail Reservasi</h2>
                <p class="text-sm font-medium text-gray-500">Total</p>
                <p class="text-3xl font-bold text-gray-900 mb-4 color-mejaku-main">Rp 50.000</p>
                
                <p class="text-sm font-medium text-gray-500 mb-2">Nomor Virtual Akun</p>
                <p class="text-2xl font-bold text-gray-900 tracking-wide mb-4">12345678909876</p>
            </section>

            <section class="mb-8 border-b pb-6">
                <h2 class="text-lg font-bold text-gray-900 mb-3">Tata Cara</h2>
                
                <ol class="list-decimal list-inside ml-5 space-y-2 text-gray-700 text-base mb-6">
                    <li>1. Masuk ke menu Transfer pada myBCA.</li>
                    <li>2. Pilih Virtual Account > Transfer to new beneficiary.</li>
                    <li>3. Masukkan Kode Pembayaran 12345678909876.</li>
                    <li>4. Masukkan PIN Anda, lalu pilih Kirim.</li>
                    <li>5. Status transaksi akan dikirim melalui SMS dan dapat digunakan sebagai bukti pembayaran.</li>
                </ol>
            </section>
            
            <section class="mb-16">
                <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg border">
                    <i class="fas fa-clock text-3xl text-gray-600"></i>
                    <div>
                        <p class="text-lg font-semibold text-gray-700">Selesaikan pembayaranmu sebelum</p>
                        <p class="text-xl font-bold color-mejaku-main">29 Juli 2025</p>
                        <p class="text-xl font-bold color-mejaku-main">23.59 WIB</p>
                    </div>
                </div>
            </section>

        </main>
        
        <div class="w-full max-w-lg mx-auto p-4 bg-white border-t shadow-lg">
            <button
                class="w-full py-3 text-white font-semibold rounded-lg shadow bg-mejaku-main hover:bg-mejaku-dark transition">
                Periksa Status Pembayaran
            </button>
        </div>

    </div>
</body>

</html>