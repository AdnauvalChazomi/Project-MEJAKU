@extends('layouts.app')
@section('title', 'Kelola Promo | MejaKu')

@section('content')
    <div x-data="{ tab: 'aktif' }" class="relative max-w-lg mx-auto min-h-screen px-10 py-0">

        <button onclick="window.history.back()" class="flex items-center gap-3 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 my-3">Kelola Promo</h1>
        </button>

        {{-- Tab Promo --}}
        <section>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Promo</h2>
            <div class="grid grid-cols-2 gap-3">
                <button @click="tab = 'aktif'"
                    :class="tab === 'aktif' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                    class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                    <p>Aktif</p>
                    <p class="text-lg font-bold">{{ $promosAktif->count() }}</p>
                </button>

                <button @click="tab = 'selesai'"
                    :class="tab === 'selesai' ? 'bg-red-700 text-white' : 'bg-white text-gray-800 border'"
                    class="rounded-xl p-4 font-semibold text-sm shadow-sm transition">
                    <p>Selesai</p>
                    <p class="text-lg font-bold">{{ $promosSelesai->count() }}</p>
                </button>
            </div>
        </section>

        {{-- Rincian Promo --}}
        <section>
            <h2 class="text-sm font-semibold text-gray-700 mb-3 mt-6">Rincian</h2>

            {{-- === TAB AKTIF === --}}
            <div x-show="tab === 'aktif'" x-transition class="space-y-4">
                @forelse ($promosAktif as $promo)
                    <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">{{ $promo->nama_promo }}</h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    Diskon
                                    @if ($promo->tipe_diskon === 'persentase' && $promo->nilai_diskon <= 999)
                                        {{ $promo->nilai_diskon }}%
                                    @else
                                        Rp{{ number_format($promo->nilai_diskon, 0, ',', '.') }}
                                    @endif
                                    • Berlaku s/d
                                    {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->translatedFormat('d F Y') }}
                                    <br>
                                    <span class="text-gray-400">
                                        *Sudah digunakan {{ $promo->digunakan }}x dari {{ $promo->batas_penggunaan }}
                                        pengguna
                                    </span>
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('owner.promos.edit', $promo->id) }}">
                                    <button
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold px-4 py-1.5 rounded-md shadow-sm transition">
                                        Ubah
                                    </button>
                                </a>
                                <form action="{{ route('owner.promos.destroy', $promo->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus promo ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-[#9D3935] hover:bg-red-700 text-white p-2 rounded-md shadow-sm transition"
                                        title="Hapus Promo">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center mt-4">Belum ada promo aktif.</p>
                @endforelse
            </div>

            {{-- === TAB SELESAI === --}}
            <div x-show="tab === 'selesai'" x-transition class="space-y-4">
                @forelse ($promosSelesai as $promo)
                    <div
                        class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition opacity-80">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">{{ $promo->nama_promo }}</h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    Berakhir
                                    {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->translatedFormat('d F Y') }}
                                    <br>
                                    <span class="text-gray-400">
                                        *Telah digunakan {{ $promo->digunakan }}x dari {{ $promo->batas_penggunaan }}
                                        pengguna
                                    </span>
                                </p>
                            </div>
                            <span
                                class="bg-gray-200 text-gray-600 text-xs font-semibold px-4 py-1.5 rounded-md shadow-sm cursor-default">
                                Selesai
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center mt-4">Belum ada promo selesai.</p>
                @endforelse
            </div>
        </section>

        <div class="pt-4 mt-4">
            <a href="{{ route('owner.promos.create') }}">
                <button
                    class="w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-3 rounded-full transition-all duration-200 shadow-sm hover:shadow-md">
                    Tambah Promo
                </button>
            </a>
        </div>
    </div>
@endsection
