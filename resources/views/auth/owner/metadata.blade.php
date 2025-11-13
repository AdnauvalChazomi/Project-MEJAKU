<x-guest-layout>
    <form method="POST" action="{{ route('owner.metadata.store') }}" enctype="multipart/form-data" x-data="metadataForm()"
        @submit.prevent="handleSubmit" class="max-w-2xl mx-auto space-y-6 py-8">
        @csrf

        <!-- Header -->
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-bold text-[#9D3935]">MejaKu Partner</h1>
            <h2 class="text-xl font-semibold text-gray-900">Selesaikan Pendaftaran Anda</h2>
            <p class="text-gray-600">Jangkau lebih banyak pelanggan dan kelola reservasi dengan mudah.</p>
        </div>

        <!-- Progress Steps -->
        <div class="flex items-center justify-between mb-8">
            <template x-for="step in [1,2,3]" :key="step">
                <div class="flex flex-col items-center w-1/3">
                    <div :class="{
                        'bg-[#9D3935] text-white': currentStep >= step,
                        'bg-gray-300 text-gray-700': currentStep < step
                    }"
                        class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">
                        <template x-if="currentStep > step">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </template>
                        <template x-if="currentStep === step">
                            <span x-text="step"></span>
                        </template>
                    </div>
                    <span
                        :class="{
                            'text-[#9D3935] font-medium': currentStep >= step,
                            'text-gray-500': currentStep < step
                        }"
                        class="mt-2 text-xs"
                        x-text="['Informasi Restoran', 'Kemitraan', 'Pembayaran Mitra'][step-1]"></span>
                    <template x-if="step < 3">
                        <div class="flex-1 border-t-2 border-dashed w-full mt-2"
                            :class="{ 'border-red-600': currentStep > step, 'border-gray-300': currentStep <= step }">
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <!-- Step 1 -->
        <div x-show="currentStep === 1" x-transition class="space-y-6">
            <div class="flex justify-center">
                <div class="relative w-24 h-24">
                    <template x-if="fotoPreview">
                        <img :src="fotoPreview" alt="Preview Foto" class="object-cover w-full h-full rounded-full">
                    </template>

                    @if ($user->owner && $user->owner->foto_restoran)
                        <template x-if="!fotoPreview">
                            <img src="{{ asset('storage/' . $user->owner->foto_restoran) }}" alt="Foto Restoran"
                                class="object-cover w-full h-full rounded-full">
                        </template>
                    @else
                        <template x-if="!fotoPreview">
                            <div class="w-full h-full bg-gray-200 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h3m-6 0a1 1 0 001-1v-4a1 1 0 00-1-1h-2a1 1 0 00-1 1v4a1 1 0 001 1m3-8a1 1 0 001-1v-4a1 1 0 00-1-1h-2a1 1 0 00-1 1v4a1 1 0 001 1z" />
                                </svg>
                            </div>
                        </template>
                    @endif

                    <!-- Tombol Edit -->
                    <label for="foto_restoran"
                        class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-md cursor-pointer z-20 hover:bg-gray-100 transition flex items-center justify-center w-7 h-7">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </label>
                    <input type="file" id="foto_restoran" name="foto_restoran" class="hidden" accept="image/*"
                        @change="handleFileChange">
                </div>
            </div>

            <div class="space-y-6">
                <div class="space-y-2">
                    <label for="restaurant-name" class="block text-sm font-medium text-gray-700">Nama Restoran</label>
                    <input id="restaurant-name" name="nama_restoran" x-model="restaurantName" type="text" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500" />
                </div>

                <div class="space-y-2">
                    <label for="restaurant-address" class="block text-sm font-medium text-gray-700">Alamat Lengkap
                        Restoran</label>
                    <textarea id="restaurant-address" name="alamat_restoran" x-model="restaurantAddress" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"></textarea>
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="description" name="summary" x-model="description" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"></textarea>
                </div>

                <template x-if="warningMessage">
                    <p x-text="warningMessage" class="text-[#9D3935] text-sm text-center font-medium"></p>
                </template>

                <button type="button" @click="validateStep1" class="w-full py-3 bg-[#9D3935] text-white rounded-lg">
                    Lanjut
                </button>
            </div>
        </div>

        <!-- Step 2 -->
        <div x-show="currentStep === 2" x-transition class="space-y-6">
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="bg-red-100 text-red-700 rounded-full px-4 py-1 text-sm font-medium inline-block mb-4">
                    Biaya Aktivasi Akun
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">
                    Rp 250.000 <span class="text-lg font-normal text-gray-600">Sekali bayar</span>
                </div>
                <ul class="space-y-3 mt-4">
                    <template x-for="fitur in ['Manajemen Reservasi', 'Kelola Menu', 'Kelola Pesanan', 'Kelola Promo']"
                        :key="fitur">
                        <li class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700" x-text="fitur"></span>
                        </li>
                    </template>
                </ul>
            </div>
            <button type="button" @click="nextStep"
                class="w-full py-3 bg-[#9D3935] text-white rounded-lg font-medium hover:bg-red-700 transition">
                Lanjut
            </button>
        </div>

        <div x-show="currentStep === 3" x-transition class="space-y-6">
            <div class="text-center">
                <p class="text-gray-600">
                    Langkah terakhir untuk mengaktifkan akun
                    <span x-text="restaurantName || 'Cafe Lorem'"></span> Anda.
                </p>
            </div>

            <div class="space-y-2">
                <h3 class="font-medium text-gray-900">Ringkasan Pesanan</h3>
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Total Harga</span>
                        <span class="font-medium">Rp 250.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Pajak</span>
                        <span class="font-medium">Rp 10.000</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2">
                        <span class="font-bold">Total</span>
                        <span class="font-bold">Rp 260.000</span>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 bg-[#9D3935] text-white rounded-lg font-medium hover:bg-red-700 transition">
                Bayar Sekarang
            </button>
        </div>
    </form>

    <script>
        function metadataForm() {
            return {
                currentStep: 1,
                restaurantName: '',
                restaurantAddress: '',
                description: '',
                fotoRestoran: null,
                fotoPreview: null,
                warningMessage: '', // ← tambahkan ini

                handleFileChange(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.fotoRestoran = file;
                        this.fotoPreview = URL.createObjectURL(file);
                    }
                },

                validateStep1() {
                    // Reset pesan sebelumnya
                    this.warningMessage = '';

                    // Validasi form
                    if (!this.restaurantName || !this.restaurantAddress || !this.description) {
                        this.warningMessage = "⚠️ Harap isi semua field terlebih dahulu sebelum melanjutkan.";
                        return;
                    }

                    this.nextStep();
                },

                nextStep() {
                    if (this.currentStep < 3) this.currentStep++;
                },

                handleSubmit(event) {
                    if (this.currentStep !== 3) {
                        event.preventDefault();
                        return;
                    }

                    if (event.submitter && event.submitter.type === "submit") {
                        event.target.submit();
                    }
                }
            }
        }
    </script>
</x-guest-layout>
