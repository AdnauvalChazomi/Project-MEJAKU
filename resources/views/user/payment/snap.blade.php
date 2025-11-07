@extends('layouts.app')

@section('title', 'Pembayaran - MejaKu')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg text-center">
    <h2 class="text-lg font-bold mb-4 text-gray-800">Proses Pembayaran</h2>
    <p class="text-gray-600 mb-6">Silakan selesaikan pembayaran Anda melalui Midtrans.</p>

    <button id="pay-button" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700">
        Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                window.location.href = "{{ route('dashboard')}}";
            },
            onPending: function(result) {
                alert('Menunggu pembayaran...');
                window.location.href = "{{ route('dashboard')}}";
            },
            onError: function(result) {
                alert('Terjadi kesalahan dalam pembayaran!');
            },
            onClose: function() {
                alert('Anda menutup popup sebelum menyelesaikan pembayaran.');
            }
        });
    });
</script>
@endsection
