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
                    <p><span class="font-medium">Nomor Pesanan:</span> {{ $reservation->nomor_pesanan ?? '-' }}</p>
                    <p><span class="font-medium">Nomor Meja:</span> {{ $reservation->meja?->nomor ?? 'Belum ada' }}</p>
                    <p><span class="font-medium">Area:</span> {{ $reservation->area ?? 'Belum ada' }}</p>
                </div>
            </section>

            {{-- Daftar Order Items (opsional) --}}
            @if ($reservation->order && $reservation->order->items->isNotEmpty())
                @php
                    $order = $reservation->order;
                    $subtotal = $order->total_harga;
                    $pajak = $subtotal * 0.1;
                @endphp

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
                                            {{ $item->jumlah }}x Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-sm font-semibold text-gray-800">
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <section class="text-center mt-6">
                        <form action="{{ route('preorder.destroy', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-block text-red-700 py-2 px-4 rounded-lg hover:text-red-800 text-sm font-medium">
                                Mau ganti menu? Klik disini
                            </button>
                        </form>
                    </section>
                </section>
            @else
                @php
                    $subtotal = 0;
                    $pajak = 0;
                @endphp

                @if ($reservation->status === 'pending')
                    <section class="bg-white border rounded-lg p-4 shadow-sm text-center">
                        <p class="text-sm text-gray-600 mb-2">Belum ada menu yang dipesan.</p>
                        <a href="{{ route('preorder', $reservation->id) }}"
                            class="inline-block text-red-700 py-2 px-4 rounded-lg hover:text-red-800 text-sm font-medium">
                            Tambah Menu
                        </a>
                    </section>
                @endif
            @endif

            @php
                $reservationFee = 10000;
                $total = $subtotal + $pajak + $reservationFee;
            @endphp

            {{-- Subtotal, Pajak, Biaya Reservasi, Total --}}
            <section class="bg-white border rounded-lg p-4 shadow-sm">
                @if ($reservation->order && $reservation->order->items->isNotEmpty())
                    <div class="flex justify-between text-sm font-medium text-gray-700">
                        <p>Subtotal</p>
                        <p>Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <p>Pajak (10%)</p>
                        <p>Rp{{ number_format($pajak, 0, ',', '.') }}</p>
                    </div>
                @endif
                <div class="flex justify-between text-sm mt-2 font-medium text-gray-700">
                    <p>Biaya Reservasi</p>
                    <p>Rp{{ number_format($reservationFee, 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between text-base font-semibold text-gray-800 mt-2">
                    <p>Total</p>
                    <p>Rp{{ number_format($total, 0, ',', '.') }}</p>
                </div>
            </section>

            <section class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-700 mb-2">Catatan</h2>
                <form action="{{ route('neopayment.confirm', $reservation->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <textarea name="catatan" placeholder="Contoh: tanpa pedas, saus terpisah..."
                        class="w-full text-sm border rounded-lg p-2 focus:ring-2 focus:ring-red-200 focus:outline-none resize-none">{{ old('catatan', $reservation->catatan) }}</textarea>

                    @if ($reservation->status === 'completed')
                        <button type="button"
                            class="w-full bg-gray-200 text-gray-600 py-3 rounded-lg font-semibold cursor-default">Reservasi
                            Selesai</button>
                    @elseif ($reservation->status === 'cancelled')
                        <button type="button"
                            class="w-full bg-gray-200 text-gray-600 py-3 rounded-lg font-semibold cursor-default">Reservasi
                            Dibatalkan</button>
                    @elseif ($reservation->status === 'paid')
                        <button type="button"
                            class="w-full bg-green-200 text-green-600 py-3 rounded-lg font-semibold cursor-default">Reservasi
                            Sudah Dibayar</button>
                    @else
                        <button type="submit"
                            class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700">Lanjutkan</button>
                    @endif
                </form>

                @if (!in_array($reservation->status, ['completed', 'cancelled', 'paid']))
                    <form id="cancelForm" action="{{ route('payment.cancel', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="button" id="cancelButton"
                            class="w-full bg-gray-100 text-red-600 border border-red-300 py-3 rounded-lg font-semibold hover:bg-red-50 mt-4">
                            Batalkan Reservasi
                        </button>
                    </form>
                @endif
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('cancelButton')?.addEventListener('click', function() {
            Swal.fire({
                title: 'Batalkan Reservasi?',
                text: "Apakah Anda yakin ingin membatalkan reservasi ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancelForm').submit();
                }
            });
        });
    </script>
@endsection
