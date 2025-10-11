@extends('layouts.app')
@section('title', 'MejaKu - Riwayat Reservasi')

@section('navbar')
<!-- Header -->
<header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
    <button onclick="window.history.back()" class="hover:text-red-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <h1 class="text-lg font-bold text-red-600 tracking-tight">Riwayat Reservasi</h1>
    <div class="w-6"></div>
</header>
@endsection

@section('content')
<main class="p-4 max-w-lg mx-auto space-y-4">

    @php
        // Data dummy langsung di halaman (tanpa gambar)
        $riwayat = [
            [
                'id' => 1,
                'kode' => 'ZX3ER5GGS',
                'tanggal' => '08 Okt 2025, 11:30',
                'restoran' => 'Kopi Mendalo',
                'alamat' => 'Jl. Raya UNJA No.12, Mendalo',
                'total' => 74800,
                'status' => 'selesai'
            ],
            [
                'id' => 2,
                'kode' => 'ZX8HT5PQP',
                'tanggal' => '09 Okt 2025, 12:10',
                'restoran' => 'Resto Bukit Indah',
                'alamat' => 'Jl. Lintas Jambi – Muara Bulian KM. 15',
                'total' => 122000,
                'status' => 'diproses'
            ],
            [
                'id' => 3,
                'kode' => 'ZX1FA9KLM',
                'tanggal' => '10 Okt 2025, 09:20',
                'restoran' => 'Waroeng Selera Jambi',
                'alamat' => 'Jl. Sultan Thaha No.18, Telanaipura',
                'total' => 87000,
                'status' => 'belum_bayar'
            ],
            [
                'id' => 4,
                'kode' => 'ZX5LQ8ZDS',
                'tanggal' => '06 Okt 2025, 18:45',
                'restoran' => 'Dapoer Pinang',
                'alamat' => 'Jl. Kapten Pattimura No.45, Jambi Luar Kota',
                'total' => 98000,
                'status' => 'selesai'
            ],
        ];
    @endphp

    <!-- Jika belum ada riwayat -->
    @if(empty($riwayat) || count($riwayat) === 0)
        <div class="text-center py-16 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-3" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h18M9 3v18m6-18v18M3 21h18" />
            </svg>
            <p class="text-sm">Belum ada riwayat reservasi.</p>
        </div>
    @else

    <!-- Loop data riwayat -->
    @foreach ($riwayat as $item)
        <div class="bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-200">

            <!-- Header -->
            <div class="flex justify-between items-start mb-3">
                <div>
                    <p class="text-xs text-gray-500">Nomor Pesanan</p>
                    <p class="font-semibold text-sm text-gray-800">#{{ $item['kode'] }}</p>
                </div>
                <span class="text-xs text-gray-500">{{ $item['tanggal'] }}</span>
            </div>

            <!-- Info Restoran -->
            <div class="mb-2">
                <p class="font-medium text-gray-800 text-sm">{{ $item['restoran'] }}</p>
                <p class="text-xs text-gray-500">{{ $item['alamat'] }}</p>
            </div>

            <!-- Total & Status -->
            <div class="flex justify-between items-center text-sm mt-3">
                <div>
                    <p class="text-gray-600">Total Pembayaran</p>
                    <p class="font-semibold text-red-600">Rp{{ number_format($item['total'], 0, ',', '.') }}</p>
                </div>

                @php
                    $statusClass = match($item['status']) {
                        'belum_bayar' => 'bg-yellow-100 border-yellow-500',
                        'diproses' => 'bg-red-100  border-red-400',
                        'selesai' => 'bg-green-100  border-green-500',
                        default => 'bg-gray-100 text-gray-500 border-gray-300'
                    };
                    $labelStatus = [
                        'belum_bayar' => 'Menunggu Pembayaran',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai'
                    ][$item['status']] ?? 'Tidak Diketahui';
                @endphp

                <span class="px-3 py-1 text-xs font-medium border rounded-full {{ $statusClass }}">
                    {{ $labelStatus }}
                </span>
            </div>

            <!-- Lihat Detail -->
            <div class="mt-3 text-right">
                <a href="{{ route('status') }}"
                   class="inline-flex items-center gap-1 text-sm text-red-600 font-medium hover:underline">
                    Lihat Detail
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
    @endif
</main>
@endsection
