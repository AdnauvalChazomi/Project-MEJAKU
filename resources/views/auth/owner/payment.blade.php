<x-guest-layout>
    <div class="max-w-2xl mx-auto space-y-6 py-8">
        <!-- Header -->
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-bold text-[#9D3935]">MejaKu Partner</h1>
        </div>

        <!-- Payment Details -->
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900">Detail Pembayaran Mitra</h2>

            <!-- Total Amount -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Total</label>
                <div class="text-2xl font-bold text-gray-900">Rp {{ $activationFee }}</div>
            </div>

            <!-- Deadline -->
            <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm text-gray-600">Selesaikan pembayaranmu sebelum</p>
                    <p class="text-xl font-bold text-gray-900">{{ now()->addDay()->format('d M Y H:i') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Payment Button -->
        <div class="pt-8">
            <button id="pay-button" type="button"
                class="w-full py-3 bg-[#9D3935] text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                Bayar Sekarang
            </button>
        </div>
    </div>

    <!-- Midtrans Snap.js -->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    alert("Pembayaran sukses! Selamat bergabung 🎉");
                    window.location.href = "{{ route('owner.dashboard') }}";
                },
                onPending: function (result) {
                    alert("Pembayaran tertunda. Silakan selesaikan pembayaran.");
                },
                onError: function (result) {
                    alert("Terjadi kesalahan saat memproses pembayaran.");
                },
                onClose: function () {
                    alert("Kamu menutup jendela pembayaran sebelum selesai.");
                }
            });
        });
    </script>
</x-guest-layout>
