@extends('layouts.app')
@section('title', 'Manajemen Acara | MejaKu')

@section('content')
<div class="relative max-w-2xl mx-auto min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-8 mb-3">

    {{-- Header --}}
    <header class="flex items-center gap-2">
        <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Manajemen Acara</h1>
        <span class="ml-2 text-xs bg-[#9D3935] text-white px-2 py-0.5 rounded-full font-semibold">PRO</span>
    </header>

    {{-- === Daftar Jenis Acara === --}}
    <section class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 space-y-4">
        <h2 class="text-sm font-semibold text-gray-800">Daftar Jenis Acara</h2>

        <div class="flex flex-wrap gap-2">
            @foreach (['Ulang Tahun', 'Gathering Komunitas', 'Meeting'] as $event)
            <div class="flex items-center justify-between bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">
                {{ $event }}
                <button class="ml-2 text-gray-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endforeach
        </div>

        <button
            class="w-full py-2 bg-gray-100 text-gray-500 text-sm font-semibold rounded-lg hover:bg-gray-200 transition">
            + Jenis Acara
        </button>
    </section>

    {{-- === Daftar Reservasi Acara === --}}
    <section class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 space-y-4 overflow-x-auto">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-800">Daftar Reservasi Acara</h2>

            {{-- Filter & Search --}}
            <div class="flex items-center gap-2">
                <button
                    class="p-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition text-gray-600 flex items-center gap-1 text-xs font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 14.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 018 17v-2.586L3.293 6.707A1 1 0 013 6V4z" />
                    </svg>
                    Filter
                </button>
                <div class="relative">
                    <input type="text" placeholder="Search"
                        class="pl-8 pr-3 py-2 text-xs border border-gray-300 rounded-lg focus:ring-1 focus:ring-red-500 focus:outline-none text-gray-700 placeholder-gray-400" />
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute left-2 top-2.5 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-800 border-t border-gray-100">
                <thead>
                    <tr class="bg-gray-50 text-gray-600">
                        <th class="text-left py-2 px-3">No.</th>
                        <th class="text-left py-2 px-3">Event</th>
                        <th class="text-left py-2 px-3">Jumlah Tamu</th>
                        <th class="text-left py-2 px-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-2 px-3">1</td>
                        <td class="py-2 px-3">Ulang Tahun</td>
                        <td class="py-2 px-3">15</td>
                        <td class="py-2 px-3 text-green-600 font-medium">Dikonfirmasi</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3">2</td>
                        <td class="py-2 px-3">Gathering Komunitas</td>
                        <td class="py-2 px-3">22</td>
                        <td class="py-2 px-3 text-yellow-500 font-medium">Menunggu Persetujuan</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3">3</td>
                        <td class="py-2 px-3">Meeting</td>
                        <td class="py-2 px-3">22</td>
                        <td class="py-2 px-3 text-green-600 font-medium">Dikonfirmasi</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3">4</td>
                        <td class="py-2 px-3">Ulang Tahun</td>
                        <td class="py-2 px-3">22</td>
                        <td class="py-2 px-3 text-green-600 font-medium">Dikonfirmasi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
