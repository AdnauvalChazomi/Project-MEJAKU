@extends('layouts.app')

@section('title', 'Pembayaran - MejaKu')

@section('content')
    <div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-lg font-bold mb-4 text-gray-800 text-center">Proses Pembayaran</h2>
        <p class="text-gray-600 mb-6 text-center">Silakan selesaikan pembayaran Anda melalui Midtrans.</p>

        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-gray-700 mb-2">Rincian Pesanan</h3>
            <table class="w-full text-sm text-left text-gray-600">
                <thead>
                    <tr class="border-b">
                        <th class="py-1">Item</th>
                        <th class="py-1 text-center">Qty</th>
                        <th class="py-1 text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($items) && $items->isNotEmpty())
                        @foreach ($items as $item)
                            <tr class="border-b">
                                <td class="py-1">{{ $item->menu->nama ?? 'Item Tanpa Nama' }}</td>
                                <td class="py-1 text-center">{{ $item->jumlah ?? 1 }}</td>
                                <td class="py-1 text-right">Rp
                                    {{ number_format(($item->menu->harga ?? 0) * ($item->jumlah ?? 1), 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="py-1 text-gray-700" colspan="2">Pajak (10%)</td>
                            <td class="py-1 text-right">Rp {{ number_format($tax, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="py-1 text-gray-700" colspan="2">Biaya Reservasi</td>
                        <td class="py-1 text-right">Rp {{ number_format($reservationFee, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="border-t mt-2 pt-2 flex justify-between font-semibold text-red-600">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center">
            <button id="pay-button" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700">
                Bayar Sekarang
            </button>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil!',
                        text: 'Terima kasih, pembayaran Anda telah berhasil diproses.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "{{ route('dashboard') }}";
                    });
                },
                onPending: function(result) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Menunggu Pembayaran',
                        text: 'Silakan selesaikan pembayaran Anda untuk melanjutkan.',
                        confirmButtonText: 'OK'
                    });
                },
                onError: function(result) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal memproses pembayaran. Silakan coba lagi.',
                        confirmButtonText: 'Tutup'
                    });
                },
                onClose: function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pembayaran Dibatalkan',
                        text: 'Anda menutup popup sebelum menyelesaikan pembayaran.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endsection
