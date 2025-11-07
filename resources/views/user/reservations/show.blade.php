@extends('layouts.app')
@section('title', 'MejaKu - Detail Pesanan')

@section('navbar')
    <header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
        <button onclick="window.history.back()" class="hover:text-red-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-lg font-bold text-red-600 tracking-tight">Detail Pesanan</h1>
        <div class="w-6"></div>
    </header>
@endsection

@php
    $order = $reservation->order;
    $subtotal = $order->total_harga;
    $pajak = $subtotal * 0.1;
    $total = $subtotal + $pajak;
@endphp

@section('content')
    <div class="mx-auto min-h-screen relative">
        <main class="p-4 space-y-5 max-w-lg mx-auto bg-white md:rounded-lg md:mt-2 mb-10 md:p-10">
            {{-- Informasi Pemesan --}}
            <section class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-700 mb-2">Informasi Pemesan</h2>
                <div class="text-sm text-gray-600 space-y-1">
                    <p><span class="font-medium">Nama:</span> {{ $reservation->customer->user->name ?? '-' }}</p>
                    <p><span class="font-medium">Waktu Pemesanan:</span>
                        {{ $reservation->tanggal_reservasi ? \Carbon\Carbon::parse($reservation->tanggal_reservasi)->format('d M Y') : '-' }},
                        {{ $reservation->jam_reservasi ?? '-' }}
                    </p>
                    <p><span class="font-medium">Nomor Pesanan:</span> {{ $order->nomor_pesanan ?? '-' }}</p>
                    <p><span class="font-medium">Nomor Meja:</span> {{ $reservation->meja?->nomor ?? 'Belum ada' }}</p>
                    <p><span class="font-medium">Area:</span> {{ $reservation->area ?? 'Belum ada' }}</p>
                </div>
            </section>

            @if ($reservation->order && $reservation->order->items->isNotEmpty())

                <section class="bg-white border rounded-lg p-4 shadow-sm relative">
                    <div class="divide-y">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between items-center py-2">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $item->menu->foto ? asset('storage/' . $item->menu->foto) : 'https://via.placeholder.com/80' }}"
                                        alt="{{ $item->menu->nama_menu }}" class="w-12 h-12 rounded-lg object-cover">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">{{ $item->menu->nama_menu }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $item->jumlah }}x
                                            Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-sm font-semibold text-gray-800">
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t mt-3 pt-3">
                        <div class="flex justify-between text-sm font-medium text-gray-700">
                            <p>Subtotal</p>
                            <p>Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500">
                            <p>Pajak (10%)</p>
                            <p>Rp{{ number_format($pajak, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between text-base font-semibold text-gray-800 mt-2">
                            <p>Total</p>
                            <p>Rp{{ number_format($total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </section>
            @endif

            {{-- Catatan dan Pembayaran --}}
            <section class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-700 mb-2">Catatan</h2>

                <form action="{{ route('preorder.confirm', $reservation->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <textarea name="catatan" placeholder="Contoh: tanpa pedas, saus terpisah..."
                        class="w-full text-sm border rounded-lg p-2 focus:ring-2 focus:ring-red-200 focus:outline-none resize-none">{{ old('catatan', $reservation->catatan) }}</textarea>

                    <p class="flex items-center gap-1 text-sm text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                        </svg>
                        <span>Silakan periksa history secara berkala untuk melihat update nomor meja</span>
                    </p>

                    <button type="submit"
                        class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold
                   hover:bg-red-700 active:scale-95 focus:outline-none
                   focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out
                   shadow-md hover:shadow-lg">
                        Bayar
                    </button>
                </form>
            </section>
        </main>
    </div>
@endsection
