@extends('layouts.app')
@section('title', 'MejaKu - Riwayat Reservasi')

@section('navbar')
    <header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
        <button onclick="window.history.back()" class="hover:text-[#9D3935] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-lg font-bold text-[#9D3935] tracking-tight">Riwayat Reservasi</h1>
        <div class="w-6"></div>
    </header>
@endsection

@section('content')
    <main class="p-5 max-w-lg mx-auto space-y-6 bg-gray-50 min-h-screen">

        @if (empty($riwayat) || count($riwayat) === 0)
            <div class="text-center py-16 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h18M9 3v18m6-18v18M3 21h18" />
                </svg>
                <p class="text-sm">Belum ada riwayat reservasi.</p>
            </div>
        @else
            @foreach ($riwayat as $index => $item)
                @php
                    $statusColor = match (strtolower($item['reservationStatus'])) {
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'belum_bayar' => 'bg-yellow-100 text-yellow-700',
                        'paid' => 'bg-green-100 text-green-700',
                        'completed' => 'bg-blue-100 text-blue-700',
                        'selesai' => 'bg-green-100 text-green-700',
                        'cancelled', 'canceled' => 'bg-red-100 text-red-700',
                        'diproses' => 'bg-orange-100 text-orange-700',
                        'reservasi' => 'bg-green-100 text-green-700',
                        default => 'bg-gray-100 text-gray-500',
                    };

                    $labelStatus = match (strtolower($item['reservationStatus'])) {
                        'pending' => 'Belum Dibayar',
                        'paid' => 'Sudah Dibayar',
                        'reservasi' => 'Reservasi',
                        'completed', 'selesai' => 'Selesai',
                        'cancelled', 'canceled' => 'Dibatalkan',
                        'diproses' => 'Sedang Diproses',
                        default => ucfirst($item['status']),
                    };
                @endphp

                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between mb-3">
                        <div class="flex flex-col justify-between">
                            <p class="text-xs text-[#9D3935] font-bold mb-1">
                                Grup • {{ $item['jumlah_tamu'] }} Orang
                            </p>

                            <div>
                                <p class="text-xs font-semibold text-black uppercase">{{ $item['restoran'] }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $item['alamat'] }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-xs text-gray-500">Nomor Meja</p>
                            <p class="text-base font-semibold text-gray-900">{{ $item['meja'] }}</p>
                            <p class="text-sm font-semibold text-[#9D3935] mt-1">
                                Rp {{ number_format(10000 + $item['total'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-600 mt-3">
                        <p>{{ $item['tanggal'] }}</p>
                        <p class="font-semibold text-gray-900">{{ ucfirst($item['area']) }}</p>
                    </div>

                    <div class="flex gap-2 mt-4">
                        <span class="{{ $statusColor }} text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $labelStatus }}
                        </span>

                        <a href="tel:{{ $item['telepon'] ?? '' }}"
                            class="flex-1 border border-green-500 text-green-600 rounded-lg text-sm py-2 hover:bg-green-50 transition font-medium text-center">
                            Hubungi Toko
                        </a>

                        <a href="{{ route('payment.show', ['id' => $item['id']]) }}"
                            class="flex-1 border border-gray-200 rounded-lg text-sm py-2 hover:bg-gray-100 transition font-medium text-center">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </main>
@endsection
