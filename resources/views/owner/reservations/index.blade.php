@extends('layouts.app')
@section('title', 'Manajemen Reservasi | MejaKu')

@section('content')
    <div x-data="{ activeTab: 'penuh' }" class="min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-10">

        <header class="flex items-center gap-3">
            <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Manajemen Reservasi</h1>
        </header>

        {{-- === SUMMARY === --}}
        <section>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Meja</h2>
            <div class="grid grid-cols-3 gap-3">
                <button @click="activeTab = 'penuh'"
                    :class="activeTab === 'penuh' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                    class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                    <p>Penuh</p>
                    <p class="text-lg font-bold">{{ $penuh->count() }}</p>
                </button>

                <button @click="activeTab = 'tersedia'"
                    :class="activeTab === 'tersedia' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                    class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                    <p>Tersedia</p>
                    <p class="text-lg font-bold">{{ $mejas->where('status', 'tersedia')->count() }}</p>
                </button>

                <button @click="activeTab = 'direservasi'"
                    :class="activeTab === 'direservasi' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                    class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                    <p>Direservasi</p>
                    <p class="text-lg font-bold">{{ $direservasi->count() }}</p>
                </button>
            </div>
        </section>

        {{-- === TAB: PENUH === --}}
        <div x-show="activeTab === 'penuh'" x-transition class="space-y-4">
            @forelse ($penuh as $r)
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="text-xs font-semibold text-[#9D3935] uppercase">Grup • {{ $r->jumlah_tamu }} Tamu</p>
                            <h3 class="text-sm font-bold text-gray-800">{{ $r->customer->user->name ?? '-' }}</h3>
                        </div>

                        <div class="text-sm text-gray-600 text-right">
                            <p>
                                {{ \Carbon\Carbon::parse($r->tanggal_reservasi . ' ' . $r->jam_reservasi)->locale('id')->translatedFormat('d M Y, H:i') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Nomor Meja:
                                <span class="font-semibold text-gray-800">{{ $r->meja->nomor ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    <div>
                        @if ($r->order && $r->order->items)
                            @foreach ($r->order->items as $itm)
                                <div class="flex justify-between items-center py-2">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $itm->menu->foto ? asset('storage/' . $itm->menu->foto) : 'https://via.placeholder.com/80' }}"
                                            alt="{{ $itm->menu->nama }}"
                                            class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $itm->menu->nama }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ $itm->jumlah }}x
                                                Rp{{ number_format($itm->harga_satuan, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="flex justify-between items-center py-2 border-t border-gray-100 mt-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 text-sm">
                                    ৹
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Reservasi</p>
                                    <p class="text-xs text-gray-500">1x Rp10.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-3">
                        <div class="flex gap-2">
                            <span
                                class="px-2.5 py-1 text-xs rounded-full font-medium
                                    {{ $r->status === 'paid'
                                        ? 'bg-green-100 text-green-700'
                                        : ($r->status === 'completed'
                                            ? 'bg-blue-100 text-blue-700'
                                            : ($r->status === 'cancelled'
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-yellow-100 text-yellow-700')) }}">
                                {{ ucfirst($r->status ?? 'reservasi') }}
                            </span>

                            <span class="px-2.5 py-1 text-xs rounded-full font-medium bg-blue-100 text-blue-700">
                                {{ ucfirst($r->area ?? 'Umum') }}
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total</p>
                            <p class="text-base font-semibold text-[#9D3935] mt-1">
                                Rp{{ number_format(($r->order->total_harga ?? 0) + 10000, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-3">
                        <span
                            class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">Penuh</span>
                        <button
                            class="flex-1 border border-gray-200 rounded-lg text-sm py-2 hover:bg-gray-100 transition font-medium">
                            Ubah Pesanan
                        </button>
                        <form action="{{ route('owner.reservations.markAsSelesai', $r->id) }}" method="POST"
                            class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full rounded-lg text-sm py-2 bg-red-700 text-white hover:bg-red-800 transition font-medium
                                        {{ $r->status === 'cancelled' ? 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed' : '' }}"
                                {{ $r->status === 'cancelled' ? 'disabled' : '' }}>
                                Sudah Kosong
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center mt-4">Belum ada meja penuh.</p>
            @endforelse
        </div>

        {{-- === TAB: TERSEDIA === --}}
        <div x-show="activeTab === 'tersedia'" x-transition x-data="{
            mejas: {{ $mejas->toJson() }},
            get mejaCount() {
                return this.mejas.length;
            },
            async increase() {
                await fetch('{{ route('reservations.store', $ownerId) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ jumlah: 1 })
                });
                // Ambil ulang data meja terbaru
                const res = await fetch('{{ route('owner.reservations.data', $ownerId) }}');
                this.mejas = await res.json();
            },
            async decrease() {
                const sedangDigunakan = this.mejas.some(m => m.status === 'digunakan');
                if (sedangDigunakan) {
                    alert('Tidak bisa menghapus karena ada meja yang sedang digunakan.');
                    return;
                }

                if (this.mejas.length <= 0) return;

                await fetch('{{ route('reservations.destroyLast', $ownerId) }}', {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });

                this.mejas.pop();
            }
        }" class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-700">Meja</h2>

                <div class="flex gap-2">
                    <button type="button" @click="decrease()"
                        class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700 font-semibold">
                        -
                    </button>

                    <span x-text="mejaCount" class="text-gray-800 font-medium"></span>

                    <button type="button" @click="increase()"
                        class="px-3 py-1 bg-[#9D3935] hover:bg-red-700 text-white rounded-lg font-semibold">
                        +
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-4 sm:grid-cols-6 gap-3 mt-3">
                <template x-for="meja in mejas" :key="meja.id">
                    <button x-text="meja.nomor"
                        :class="{
                            'bg-gray-200 text-gray-700': meja.status === 'tersedia',
                            'bg-[#9D3935] text-white cursor-not-allowed': meja.status === 'digunakan',
                        }"
                        class="border border-gray-200 rounded-xl font-semibold text-sm py-5 shadow-sm hover:shadow-md transition"
                        :disabled="meja.status === 'digunakan'">
                    </button>
                </template>
            </div>
        </div>

        {{-- === TAB: DIRESERVASI === --}}
        <div x-data="{ showModal: false, selectedReservation: null }" x-show="activeTab === 'direservasi'" x-transition class="space-y-4">
            @forelse ($direservasi as $r)
                <div
                    class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition
    {{ $r->status === 'batal' ? 'opacity-60 pointer-events-none' : '' }}">

                    {{-- === HEADER INFO === --}}
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="text-xs font-semibold text-[#9D3935] uppercase">Grup • {{ $r->jumlah_tamu }} Tamu</p>
                            <h3 class="text-sm font-bold text-gray-800">{{ $r->customer->user->name ?? '-' }}</h3>
                        </div>

                        <div class="text-sm text-gray-600 text-right">
                            <p>
                                {{ \Carbon\Carbon::parse($r->tanggal_reservasi . ' ' . $r->jam_reservasi)->locale('id')->translatedFormat('d M Y, H:i') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Nomor Meja:
                                <span class="font-semibold text-gray-800">{{ $r->meja->nomor ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- === LIST MENU === --}}
                    <div>
                        @if ($r->order && $r->order->items)
                            @foreach ($r->order->items as $itm)
                                <div class="flex justify-between items-center py-2">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $itm->menu->foto ? asset('storage/' . $itm->menu->foto) : 'https://via.placeholder.com/80' }}"
                                            alt="{{ $itm->menu->nama }}"
                                            class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $itm->menu->nama }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ $itm->jumlah }}x
                                                Rp{{ number_format($itm->harga_satuan, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        {{-- ITEM TAMBAHAN RESERVASI --}}
                        <div class="flex justify-between items-center py-2 border-t border-gray-100 mt-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 text-sm">
                                    ৹
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Reservasi</p>
                                    <p class="text-xs text-gray-500">1x Rp10.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- === DETAIL & TOTAL === --}}
                    <div class="flex justify-between items-center mt-3">
                        <div class="flex gap-2">
                            <span
                                class="px-2.5 py-1 text-xs rounded-full font-medium
                                    {{ $r->status === 'paid'
                                        ? 'bg-green-100 text-green-700'
                                        : ($r->status === 'completed'
                                            ? 'bg-blue-100 text-blue-700'
                                            : ($r->status === 'cancelled'
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-yellow-100 text-yellow-700')) }}">
                                {{ ucfirst($r->status ?? 'reservasi') }}
                            </span>

                            {{-- Badge Area --}}
                            <span class="px-2.5 py-1 text-xs rounded-full font-medium bg-blue-100 text-blue-700">
                                {{ ucfirst($r->area ?? 'Umum') }}
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total</p>
                            <p class="text-base font-semibold text-[#9D3935] mt-1">
                                Rp{{ number_format(($r->order->total_harga ?? 0) + 10000, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- === BUTTON AKSI === --}}
                    <div class="flex gap-2 mt-4">
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $r->customer->user->no_hp) }}"
                            target="_blank"
                            class="flex-1 text-sm py-2 font-medium text-center transition rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">
                            Hubungi Customer
                        </a>

                        <button
                            class="flex-1 text-sm py-2 font-medium rounded-lg transition
            {{ $r->status === 'cancelled'
                ? 'bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed'
                : 'border border-yellow-300 bg-yellow-50 text-yellow-700 hover:bg-yellow-100' }}"
                            {{ $r->status === 'cancelled' ? 'disabled' : '' }}>
                            Belum Datang
                        </button>

                        <button @click="selectedReservation = {{ $r->id }}; showModal = true"
                            class="flex-1 text-sm py-2 font-medium rounded-lg transition
            {{ $r->status === 'cancelled'
                ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                : 'bg-red-700 text-white hover:bg-red-800' }}"
                            {{ $r->status === 'cancelled' ? 'disabled' : '' }}>
                            Tambahkan Meja
                        </button>
                    </div>

                </div>

            @empty
                <p class="text-gray-500 text-center mt-4">Tidak ada reservasi yang menunggu meja.</p>
            @endforelse

            {{-- === MODAL PILIH MEJA === --}}
            <div x-show="showModal" x-transition class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div @click.away="showModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 space-y-4">

                    <h2 class="text-lg font-semibold text-gray-900 text-center">Pilih Meja untuk Reservasi</h2>

                    <form method="POST" :action="`/owner/reservations/${selectedReservation}/assign-meja`">
                        @csrf
                        <div class="max-h-60 overflow-y-auto border rounded-lg">
                            @foreach ($mejas->where('status', 'tersedia') as $meja)
                                <label
                                    class="flex items-center justify-between p-3 border-b hover:bg-gray-50 cursor-pointer">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="meja_id" value="{{ $meja->id }}"
                                            class="text-[#9D3935] focus:ring-red-500">
                                        <span class="text-sm font-medium text-gray-800">Meja {{ $meja->nomor }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500">Kapasitas {{ $meja->kapasitas ?? '-' }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex gap-2 mt-5">
                            <button type="button" @click="showModal = false"
                                class="flex-1 border border-gray-300 rounded-lg py-2 text-sm font-medium hover:bg-gray-100">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-1 bg-red-700 text-white rounded-lg py-2 text-sm font-medium hover:bg-red-800">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
