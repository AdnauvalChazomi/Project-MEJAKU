<x-guest-layout>
    <form method="POST" action="{{ route('register.owner') }}">
        @csrf

    <div x-data="{ currentStep: 1, restaurantName: '', restaurantAddress: '', description: '' }" class="max-w-2xl mx-auto space-y-6 py-8">

    <!-- Header -->
    <div class="text-center space-y-2">
        <h1 class="text-2xl font-bold text-red-600">MejaKu Partner</h1>
        <h2 class="text-xl font-semibold text-gray-900">Selesaikan Pendaftaran Anda</h2>
        <p class="text-gray-600">Jangkau lebih banyak pelanggan dan kelola reservasi dengan mudah.</p>
    </div>

    <!-- Progress Steps -->
    <div class="flex items-center justify-between mb-8">
        <!-- Step 1 -->
        <div class="flex flex-col items-center">
            <div :class="{'bg-red-600 text-white': currentStep >= 1, 'bg-gray-300 text-gray-700': currentStep < 1}" 
                 class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">
                <template x-if="currentStep > 1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </template>
                <template x-if="currentStep === 1">
                    1
                </template>
            </div>
            <span :class="{'text-red-600 font-medium': currentStep >= 1, 'text-gray-500': currentStep < 1}" 
                  class="mt-2 text-xs">Informasi Restoran</span>
        </div>
        
        <!-- Connector -->
        <div class="flex-1 border-t-2 border-dashed" :class="{'border-red-600': currentStep > 1, 'border-gray-300': currentStep <= 1}"></div>
        
        <!-- Step 2 -->
        <div class="flex flex-col items-center">
            <div :class="{'bg-red-600 text-white': currentStep >= 2, 'bg-gray-300 text-gray-700': currentStep < 2}" 
                 class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">
                <template x-if="currentStep > 2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </template>
                <template x-if="currentStep === 2">
                    2
                </template>
            </div>
            <span :class="{'text-red-600 font-medium': currentStep >= 2, 'text-gray-500': currentStep < 2}" 
                  class="mt-2 text-xs">Kemitraan</span>
        </div>
        
        <!-- Connector -->
        <div class="flex-1 border-t-2 border-dashed" :class="{'border-red-600': currentStep > 2, 'border-gray-300': currentStep <= 2}"></div>
        
        <!-- Step 3 -->
        <div class="flex flex-col items-center">
            <div :class="{'bg-red-600 text-white': currentStep >= 3, 'bg-gray-300 text-gray-700': currentStep < 3}" 
                 class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">
                <template x-if="currentStep === 3">
                    3
                </template>
            </div>
            <span :class="{'text-red-600 font-medium': currentStep >= 3, 'text-gray-500': currentStep < 3}" 
                  class="mt-2 text-xs">Pembayaran Mitra</span>
        </div>
    </div>

    <!-- Step 1: Informasi Restoran -->
    <div x-show="currentStep === 1" class="space-y-6 transition-all duration-300">
        <div class="flex justify-center">
            <div class="relative">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h3m-6 0a1 1 0 001-1v-4a1 1 0 00-1-1h-2a1 1 0 00-1 1v4a1 1 0 001 1m3-8a1 1 0 001-1v-4a1 1 0 00-1-1h-2a1 1 0 00-1 1v4a1 1 0 001 1z" />
                    </svg>
                </div>
                <button class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Nama Restoran -->
        <div class="space-y-2">
            <label for="restaurant-name" class="block text-sm font-medium text-gray-700">Nama Restoran</label>
            <input id="restaurant-name" x-model="restaurantName" type="text" required 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                   placeholder="Masukkan nama restoran">
        </div>

        <!-- Alamat Lengkap Restoran -->
        <div class="space-y-2">
            <label for="restaurant-address" class="block text-sm font-medium text-gray-700">Alamat Lengkap Restoran</label>
            <textarea id="restaurant-address" x-model="restaurantAddress" required 
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                      placeholder="Masukkan alamat lengkap restoran" rows="3"></textarea>
        </div>

        <!-- Deskripsi -->
        <div class="space-y-2">
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea id="description" x-model="description" required 
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                      placeholder="Masukkan deskripsi restoran" rows="4"></textarea>
        </div>

        <!-- Next Button -->
        <button @click="currentStep = 2" 
                class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Lanjut
        </button>
    </div>

    <!-- Step 2: Kemitraan -->
    <div x-show="currentStep === 2" class="space-y-6 transition-all duration-300">
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="bg-red-100 text-red-700 rounded-full px-4 py-1 text-sm font-medium inline-block mb-4">
                Biaya Aktivasi Akun
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-2">
                Rp 250.000<span class="text-lg font-normal text-gray-600"> Sekali bayar</span>
            </div>
            
            <div class="mt-6">
                <h3 class="font-medium text-gray-900 mb-3">Fitur Paket Dasar yang Anda Dapatkan Selamanya:</h3>
                <div class="space-y-3">
                    <!-- Feature 1 -->
                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <strong class="text-gray-900">Manajemen Reservasi:</strong> 
                            <span class="text-gray-600">untuk mengelola semua pemesanan tempat.</span>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <strong class="text-gray-900">Kelola Menu:</strong> 
                            <span class="text-gray-600">untuk menambah dan mengatur menu restoran Anda.</span>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <strong class="text-gray-900">Kelola Pesanan:</strong> 
                            <span class="text-gray-600">untuk melihat pesanan yang masuk.</span>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <strong class="text-gray-900">Kelola Promo:</strong> 
                            <span class="text-gray-600">untuk membuat promo dan diskon dasar.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Button -->
        <button @click="currentStep = 3" 
                class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Lanjut
        </button>
    </div>

    <!-- Step 3: Pembayaran Mitra -->
    <div x-show="currentStep === 3" class="space-y-6 transition-all duration-300">
        <div class="text-center">
            <p class="text-gray-600">Langkah terakhir untuk mengaktifkan akun <span x-text="restaurantName || 'Cafe Lorem'"></span> Anda.</p>
        </div>

        <!-- Paket Information -->
        <div class="space-y-2">
            <h3 class="font-medium text-gray-900">Paket</h3>
            <p class="text-gray-600">Biaya Aktivasi Akun</p>
        </div>

        <!-- Payment Method -->
        <div class="space-y-2">
            <h3 class="font-medium text-gray-900">Metode Pembayaran</h3>
            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <option value="">Pilih Metode pembayaran</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet</option>
                <option value="credit">Kartu Kredit</option>
            </select>
        </div>

        <!-- Order Summary -->
        <div class="space-y-2">
            <h3 class="font-medium text-gray-900">Ringkasan Pesanan</h3>
            
            <div class="border-t border-gray-200 pt-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-700">Total Harga</span>
                    <span class="text-gray-900 font-medium">Rp 250.000</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-700">Pajak</span>
                    <span class="text-gray-900 font-medium">Rp 10.000</span>
                </div>
                <div class="flex justify-between pt-2 border-t border-gray-200">
                    <span class="text-gray-900 font-bold">Total</span>
                    <span class="text-gray-900 font-bold">Rp 260.000</span>
                </div>
            </div>
        </div>

        <!-- Pay Button -->
        <button @click="alert('Pembayaran berhasil! Akun Anda telah diaktifkan.')" 
                class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Bayar
        </button>
    </div>
</div> 
</x-guest-layout>