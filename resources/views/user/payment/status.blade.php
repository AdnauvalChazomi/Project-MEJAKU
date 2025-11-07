@extends('layouts.app')
@section('title', 'MejaKu - Status Pesanan')

@section('navbar')
@include('components.navbar')
@endsection

@section('content')
@php
    $status = $status ?? 'belum_bayar';

    // Daftar langkah (step)
    $steps = [
        ['key' => 'belum_bayar', 'label' => 'Belum Bayar', 'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4m0 4h.01M9.75 3a1.5 1.5 0 00-1.5 1.5v1.25H6a1.5 1.5 0 00-1.5 1.5v10.5A1.5 1.5 0 006 19.25h12a1.5 1.5 0 001.5-1.5V7.25a1.5 1.5 0 00-1.5-1.5h-2.25V4.5a1.5 1.5 0 00-1.5-1.5h-3.5z" />'],
        ['key' => 'batal', 'label' => 'Batal', 'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />'],
        ['key' => 'diproses', 'label' => 'Diproses', 'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />'],
        ['key' => 'selesai', 'label' => 'Selesai', 'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2l4 -4m5 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />'],
    ];

    // Hapus step "batal" jika status bukan batal
    if ($status !== 'batal') {
        $steps = array_filter($steps, fn($s) => $s['key'] !== 'batal');
    }

    $statusIndex = collect(array_values($steps))->search(fn($step) => $step['key'] === $status);
@endphp

<div class="flex flex-col items-center min-h-screen p-6 text-center space-y-6">

    <section class="border rounded-lg p-6 shadow-sm text-center max-w-2xl bg-white">
        <h2 class="text-base font-semibold text-gray-800 mb-6">Status Reservasi</h2>

        <div class="relative flex items-center justify-between max-w-lg mx-auto">

            <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 transform -translate-y-1/2 z-0"></div>

            @foreach (array_values($steps) as $index => $step)
                @php
                    $isCurrent = $index === $statusIndex;
                    $iconColor = $isCurrent ? 'text-red-600 bg-red-100 border-red-500'
                                            : 'text-gray-400 bg-gray-100 border-gray-300';
                    $textColor = $isCurrent ? 'text-red-600 font-medium' : 'text-gray-400';
                @endphp

                <div class="relative flex flex-col items-center z-10 w-1/4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full border-2 {{ $iconColor }} mb-2 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {!! $step['icon'] !!}
                        </svg>
                    </div>
                    <p class="text-xs {{ $textColor }}">{{ $step['label'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            @if($status === 'belum_bayar')
                <h1 class="text-lg font-semibold text-gray-800">Menunggu Pembayaran</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kamu telah memesan menu, namun pembayaran belum dilakukan.
                    Selesaikan pembayaran agar pesanan segera diproses.
                </p>
            @elseif($status === 'batal')
                <h1 class="text-lg font-semibold text-gray-700">Pesanan Dibatalkan</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kamu belum melakukan pembayaran, sehingga pesanan otomatis dibatalkan.
                    Silakan pesan kembali jika ingin melanjutkan.
                </p>
            @elseif($status === 'diproses')
                <h1 class="text-lg font-semibold text-gray-800">Pesanan Sedang Diproses</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Dapur sedang menyiapkan pesananmu. Kami akan memberi tahu jika sudah siap!
                </p>
            @elseif($status === 'selesai')
                <h1 class="text-lg font-semibold text-gray-800">Pesanan Selesai</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Terima kasih sudah memesan melalui <strong>MejaKu</strong>. Selamat menikmati hidanganmu!
                </p>
            @endif
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="flex flex-col items-center mt-6 lg:my-10">
            <div class="bg-gray-50 border rounded-lg p-4 w-full max-w-sm text-left space-y-2 text-sm text-gray-700">
                <p><span class="font-medium">Nomor Pesanan:</span> #MK20251008</p>
                <p><span class="font-medium">Waktu Pesan:</span> 11:45 WIB</p>
                <p><span class="font-medium">Nomor Meja:</span> 12</p>
                <p><span class="font-medium">Total:</span> Rp74.800</p>
            </div>

            <!-- Tombol -->
            <div class="w-full max-w-sm space-y-2 mt-6">
                @if($status === 'belum_bayar')
                    <a href="{{ route('payment.bank') }}"
                        class="block w-full bg-red-600 text-white py-3 rounded-lg font-semibold
                            hover:bg-red-700 active:scale-95 focus:outline-none
                            focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out">
                        Lanjutkan Pembayaran
                    </a>
                @else
                    <a href="{{ route('history') }}"
                        class="block w-full bg-red-600 text-white py-3 rounded-lg font-semibold
                            text-center hover:bg-red-700 active:scale-95 focus:outline-none
                            focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out">
                        Lihat Riwayat Pesanan
                    </a>
                @endif

                <a href="{{ route('dashboard') }}"
                    class="block w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-medium
                        hover:bg-gray-100 active:scale-95 transition-all duration-300 ease-in-out">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
