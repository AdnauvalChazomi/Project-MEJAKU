@extends('layouts.app')
@section('title', 'MejaKu - Detail Pesanan')

@section('navbar')
    <header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
        <button onclick="window.history.back()" class="hover:text-[#9D3935] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-lg font-bold text-[#9D3935] tracking-tight">Detail Pesanan</h1>
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

            @php
                $order = $reservation->order;
                $subtotal = $order?->total_harga ?? 0;
                $pajak = $subtotal * 0.1;
            @endphp

            {{-- Daftar Order Items (opsional) --}}
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
                    @if ($reservation->status === 'pending')
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
                    @endif
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

            <section class="bg-white border rounded-lg p-4 shadow-sm" id="summarySection">
                <div class="divide-y">
                    @if ($order && $order->items->isNotEmpty())
                        <div class="flex justify-between py-2 text-sm font-medium text-gray-700">
                            <p>Subtotal</p>
                            <p id="subtotalDisplay">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between py-2 text-sm text-gray-500">
                            <p>Pajak (10%)</p>
                            <p id="pajakDisplay">Rp{{ number_format($pajak, 0, ',', '.') }}</p>
                        </div>
                    @endif

                    <div class="flex justify-between py-2 text-sm font-medium text-gray-700">
                        <p>Biaya Reservasi</p>
                        <p id="feeDisplay">Rp{{ number_format($reservationFee, 0, ',', '.') }}</p>
                    </div>

                    <div id="promoRow"
                        class="{{ $promoApplied ? 'flex' : 'hidden' }} justify-between py-2 text-sm text-green-600 font-medium">
                        <p>Promo</p>
                        <p id="promoAmount">- Rp{{ number_format($diskon, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex justify-between py-2 text-base font-semibold text-gray-800">
                        <p>Total</p>
                        <p id="totalDisplay">Rp{{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </section>

            <section class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-700 mb-2">Catatan & Promo</h2>

                <form action="{{ route('neopayment.confirm', $reservation->id) }}" method="GET" class="space-y-3">
                    @csrf

                    <textarea name="catatan" placeholder="Contoh: tanpa pedas, saus terpisah..."
                        class="w-full text-sm border rounded-lg p-2 focus:ring-2 focus:ring-red-200 focus:outline-none resize-none">{{ old('catatan', $reservation->catatan) }}</textarea>

                    @if ($reservation->status === 'pending')
                        <div>
                            <label for="promo_code" class="block text-sm font-medium text-gray-700">
                                Kode Promo (opsional)
                            </label>
                            <div class="flex gap-2">
                                <input type="text" id="promo_code" name="promo_code"
                                    value="{{ old('promo_code', $reservation->order->promo->kode ?? '') }}"
                                    placeholder="Masukkan kode promo, contoh: WEEKEND50"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
                                <button type="button" id="checkPromoBtn"
                                    class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-black text-sm rounded-lg">
                                    Terapkan
                                </button>
                            </div>
                            <p id="promoMessage" class="text-xs mt-1 text-gray-500"></p>
                        </div>
                    @endif

                    @if ($reservation->status === 'completed')
                        <button type="button"
                            class="w-full bg-gray-200 text-gray-600 py-3 rounded-lg font-semibold cursor-default">
                            Reservasi Selesai
                        </button>
                    @elseif ($reservation->status === 'cancelled')
                        <button type="button"
                            class="w-full bg-gray-200 text-gray-600 py-3 rounded-lg font-semibold cursor-default">
                            Reservasi Dibatalkan
                        </button>
                    @elseif ($reservation->status === 'paid')
                        <button type="button"
                            class="w-full bg-green-200 text-green-600 py-3 rounded-lg font-semibold cursor-default">
                            Reservasi Sudah Dibayar
                        </button>
                    @else
                        <button type="submit"
                            class="w-full bg-[#9D3935] text-white py-3 rounded-lg font-semibold hover:bg-red-700">
                            Lanjutkan
                        </button>
                    @endif
                </form>

                @if (!in_array($reservation->status, ['completed', 'cancelled', 'paid']))
                    <form id="cancelForm" action="{{ route('payment.cancel', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="button" id="cancelButton"
                            class="w-full bg-gray-100 text-[#9D3935] border border-red-300 py-3 rounded-lg font-semibold hover:bg-red-50 mt-4">
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

    <script>
        document.getElementById('checkPromoBtn')?.addEventListener('click', function() {
            const promoCode = document.getElementById('promo_code').value.trim();
            const promoMessage = document.getElementById('promoMessage');

            if (!promoCode) {
                promoMessage.textContent = "Masukkan kode promo terlebih dahulu.";
                promoMessage.classList.add("text-[#9D3935]");
                return;
            }

            fetch(`{{ route('payment.terapkanPromo', $reservation->id) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        promo_code: promoCode
                    })
                })
                .then(res => res.json())
                .then(data => {
                    const promoRow = document.getElementById('promoRow');
                    const promoAmount = document.getElementById('promoAmount');
                    const subtotalDisplay = document.getElementById('subtotalDisplay');
                    const pajakDisplay = document.getElementById('pajakDisplay');
                    const feeDisplay = document.getElementById('feeDisplay');
                    const totalDisplay = document.getElementById('totalDisplay');

                    if (data.valid) {
                        promoMessage.classList.remove("text-[#9D3935]");
                        promoMessage.classList.add("text-green-600");
                        promoMessage.textContent =
                            `${data.message} Diskon: Rp${Number(data.diskon).toLocaleString()}`;

                        // ✅ Tampilkan baris promo
                        promoRow.classList.remove('hidden');
                        promoAmount.textContent = `- Rp${Number(data.diskon).toLocaleString()}`;

                        // ✅ Hitung ulang subtotal, pajak, dan total
                        const subtotalAwal = Number({{ $subtotal }});
                        const pajakRate = 0.1;
                        const fee = Number({{ $reservationFee }});
                        const subtotalBaru = Math.max(subtotalAwal - data.diskon, 0);
                        const pajakBaru = subtotalBaru * pajakRate;
                        const totalBaru = subtotalBaru + pajakBaru + fee;

                        // ✅ Update tampilan angka
                        subtotalDisplay.textContent = `Rp${subtotalBaru.toLocaleString()}`;
                        pajakDisplay.textContent = `Rp${pajakBaru.toLocaleString()}`;
                        totalDisplay.textContent = `Rp${totalBaru.toLocaleString()}`;
                    } else {
                        promoMessage.classList.remove("text-green-600");
                        promoMessage.classList.add("text-[#9D3935]");
                        promoMessage.textContent = data.message;

                        promoRow.classList.add('hidden');

                        // ✅ Kembalikan nilai awal jika promo gagal
                        const subtotalAwal = Number({{ $subtotal }});
                        const pajakAwal = subtotalAwal * 0.1;
                        const totalAwal = subtotalAwal + pajakAwal + Number({{ $reservationFee }});

                        subtotalDisplay.textContent = `Rp${subtotalAwal.toLocaleString()}`;
                        pajakDisplay.textContent = `Rp${pajakAwal.toLocaleString()}`;
                        totalDisplay.textContent = `Rp${totalAwal.toLocaleString()}`;
                    }
                })
                .catch(err => {
                    promoMessage.textContent = "Terjadi kesalahan saat memeriksa promo.";
                    promoMessage.classList.add("text-[#9D3935]");
                });
        });
    </script>

@endsection
