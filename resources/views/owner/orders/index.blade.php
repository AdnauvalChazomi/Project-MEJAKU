@extends('layouts.app')
@section('title', 'Kelola Pesanan | MejaKu')

@section('content')
<div x-data="{ tab: 'baru' }" class="min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-8">

    {{-- Header --}}
    <header class="flex items-center gap-3">
        <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Kelola Pesanan</h1>
    </header>

    {{-- Filter Status Pesanan --}}
    <section>
        <h2 class="text-sm font-semibold text-gray-700 mb-3">Pesanan</h2>
        <div class="grid grid-cols-3 gap-3">
            <button @click="tab = 'baru'"
                :class="tab === 'baru' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                <p>Baru</p>
                <p class="text-lg font-bold">{{ $direservasi->count() }}</p>
            </button>

            <button @click="tab = 'aktif'"
                :class="tab === 'aktif' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                <p>Aktif</p>
                <p class="text-lg font-bold">{{ $penuh->whereIn('status', ['pending','paid'])->count() }}</p>
            </button>

            <button @click="tab = 'selesai'"
                :class="tab === 'selesai' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                <p>Selesai</p>
                <p class="text-lg font-bold">{{ $penuh->where('status', 'completed')->count() }}</p>
            </button>
        </div>
    </section>

    {{-- Konten Pesanan --}}
    <section class="space-y-4">

        {{-- === TAB: BARU === --}}
        <div x-show="tab === 'baru'" x-transition>
            <h2 class="text-sm font-semibold text-gray-700 mb-3 mt-6">Rincian</h2>

            @foreach($direservasi as $r)
            <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between mb-3">
                    <div>
                        <p class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($r->tanggal_reservasi.' '.$r->jam_reservasi)->locale('id')->translatedFormat('l, d M Y | H:i') }}
                        </p>
                        <p class="text-xs font-semibold text-red-600 uppercase mt-1">
                            Grup • {{ $r->jumlah_tamu }} Tamu
                        </p>
                        <h3 class="text-sm font-bold text-gray-900">{{ $r->customer->user->name ?? '-' }}</h3>

                        @if($r->order && $r->order->items->count())
                        <p class="text-xs text-gray-500 mt-1">
                            @foreach ($r->order->items as $itm)
                                {{ $itm->jumlah }}x {{ $itm->menu->nama }}@if(!$loop->last),<br>@endif
                            @endforeach
                        </p>
                        @else
                        <p class="text-xs text-gray-500 mt-1">Hanya Reservasi</p>
                        @endif

                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-600">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                            <p>Status Meja: <span class="font-medium text-gray-800">Belum Terisi</span></p>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="bg-orange-50 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded-md inline-block mb-1">
                            {{ $r->area }}
                        </div>
                        <p class="text-xs text-gray-500">Nomor Meja</p>
                        <p class="text-base font-semibold text-gray-900">{{ $r->meja->nomor ?? '-' }}</p>
                        <p class="text-sm font-semibold text-red-600 mt-1">
                            Rp{{ number_format($r->order->total_harga ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-3 mt-3">
                    <button class="flex-1 border border-red-500 text-red-600 font-medium text-sm py-2 rounded-lg hover:bg-red-50 transition">
                        Cancel Pesanan
                    </button>
                    <button class="flex-1 border border-yellow-400 text-yellow-600 font-medium text-sm py-2 rounded-lg hover:bg-yellow-50 transition">
                        Kirim Reminder
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- === TAB: AKTIF === --}}
        <div x-show="tab === 'aktif'" x-transition>
            <h2 class="text-sm font-semibold text-gray-700 mb-3 mt-6">Rincian</h2>

            @foreach($penuh->whereIn('status', ['pending','paid']) as $r)
            <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between mb-3">
                    <div>
                        <p class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($r->tanggal_reservasi.' '.$r->jam_reservasi)->locale('id')->translatedFormat('l, d M Y | H:i') }}
                        </p>
                        <p class="text-xs font-semibold text-red-600 uppercase mt-1">
                            Grup • {{ $r->jumlah_tamu }} Tamu
                        </p>
                        <h3 class="text-sm font-bold text-gray-900">{{ $r->customer->user->name ?? '-' }}</h3>

                        @if($r->order && $r->order->items->count())
                        <p class="text-xs text-gray-500 mt-1">
                            @foreach ($r->order->items as $itm)
                                {{ $itm->jumlah }}x {{ $itm->menu->nama }}@if(!$loop->last),<br>@endif
                            @endforeach
                        </p>
                        @else
                        <p class="text-xs text-gray-500 mt-1">Hanya Reservasi</p>
                        @endif

                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-600">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            <p>Status Meja: <span class="font-medium text-gray-800">Penuh</span></p>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="bg-orange-50 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded-md inline-block mb-1">
                            {{ $r->area }}
                        </div>
                        <p class="text-xs text-gray-500">Nomor Meja</p>
                        <p class="text-base font-semibold text-gray-900">{{ $r->meja->nomor ?? '-' }}</p>
                        <p class="text-sm font-semibold text-red-600 mt-1">
                            Rp{{ number_format($r->order->total_harga ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-3 mt-3">
                    <button class="flex-1 border border-red-500 text-red-600 font-medium text-sm py-2 rounded-lg hover:bg-red-50 transition">
                        Cancel Pesanan
                    </button>
                    <button class="flex-1 bg-green-600 text-white font-medium text-sm py-2 rounded-lg hover:bg-green-700 transition">
                        Ambil Pesanan
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- === TAB: SELESAI === --}}
        <div x-show="tab === 'selesai'" x-transition>
            <h2 class="text-sm font-semibold text-gray-700 mb-3 mt-6">Rincian</h2>

            @foreach($penuh->where('status', 'completed') as $r)
            <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition opacity-60">

                <div class="flex justify-between mb-3">
                    <div>
                        <p class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($r->tanggal_reservasi.' '.$r->jam_reservasi)->locale('id')->translatedFormat('l, d M Y | H:i') }}
                        </p>
                        <p class="text-xs font-semibold text-green-600 uppercase mt-1">Selesai</p>
                        <h3 class="text-sm font-bold text-gray-900">{{ $r->customer->user->name ?? '-' }}</h3>

                        @if($r->order && $r->order->items->count())
                        <p class="text-xs text-gray-500 mt-1">
                            @foreach ($r->order->items as $itm)
                                {{ $itm->jumlah }}x {{ $itm->menu->nama }}@if(!$loop->last),<br>@endif
                            @endforeach
                        </p>
                        @else
                        <p class="text-xs text-gray-500 mt-1">Hanya Reservasi</p>
                        @endif

                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-600">
                            <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                            <p>Status Meja: <span class="font-medium text-gray-800">Kosong</span></p>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="bg-orange-50 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded-md inline-block mb-1">
                            {{ $r->area }}
                        </div>
                        <p class="text-xs text-gray-500">Nomor Meja</p>
                        <p class="text-base font-semibold text-gray-900">{{ $r->meja->nomor ?? '-' }}</p>
                        <p class="text-sm font-semibold text-gray-600 mt-1">
                            Rp{{ number_format($r->order->total_harga ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-end mt-3">
                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                </div>
            </div>
            @endforeach
        </div>

    </section>
</div>
@endsection
