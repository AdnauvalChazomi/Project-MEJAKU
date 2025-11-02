@extends('layouts.app')
@section('title', 'Dashboard Owner | MejaKu')

@php
    $owner = $user->owner;
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-10">
        <section class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $owner->nama_restoran }}</p>
            </div>

            <div class="w-full md:w-1/3 relative">
                <input type="text" placeholder="Cari di sini..."
                    class="w-full rounded-full border border-gray-200 bg-white pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm placeholder-gray-400 transition" />
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3.5 top-2.5 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </section>

        <section>
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Manajemen Restoran</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ([['icon' => 'https://cdn-icons-png.flaticon.com/512/2890/2890793.png', 'label' => 'Manajemen Reservasi', 'route' => route('owner.reservations')], ['icon' => 'https://cdn-icons-png.flaticon.com/512/857/857681.png', 'label' => 'Kelola Menu', 'route' => '#'], ['icon' => 'https://cdn-icons-png.flaticon.com/512/921/921594.png', 'label' => 'Kelola Pesanan', 'route' => '#'], ['icon' => 'https://cdn-icons-png.flaticon.com/512/833/833524.png', 'label' => 'Kelola Promo', 'route' => '#']] as $item)
                    <a href="{{ $item['route'] }}"
                        class="group bg-white hover:bg-[#FDEEDC] transition-all duration-300 border border-gray-100 p-5 rounded-2xl shadow-sm hover:shadow-md flex flex-col items-center justify-center space-y-2">
                        <img src="{{ $item['icon'] }}"
                            class="w-10 h-10 opacity-90 group-hover:scale-110 transition-transform" alt="">
                        <p class="text-sm font-medium text-gray-800 group-hover:text-red-600">{{ $item['label'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>

    {{-- Promosi & Iklan --}}
    <section class="mb-3">
        <div class="flex items-center justify-between my-4">
            <h2 class="text-lg font-semibold text-gray-800">Promosi & Iklan</h2>
            <button
                class="text-xs border border-gray-300 px-3 py-1.5 rounded-full hover:bg-gray-100 transition font-medium text-gray-600 flex items-center gap-1">
                <span>+</span> Promo
            </button>
        </div>

        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Promosi & Iklan</h2>
                <button
                    class="text-xs border border-gray-300 px-3 py-1.5 rounded-full hover:bg-gray-100 transition font-medium text-gray-600 flex items-center gap-1">
                    <span>+</span> Promo
                </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                <div
                    class="bg-white p-5 rounded-2xl shadow-sm text-center hover:shadow-md transition flex flex-col justify-center">
                    <p class="text-sm text-gray-500 mb-1">Promo Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-900">3</h3>
                </div>
                <div
                    class="bg-white p-5 rounded-2xl shadow-sm text-center hover:shadow-md transition flex flex-col justify-center">
                    <p class="text-sm text-gray-500 mb-1">Total Pengguna</p>
                    <h3 class="text-3xl font-bold text-gray-900">90 <span
                            class="text-sm text-gray-500 font-normal">Orang</span></h3>
                </div>
            </div>
        </section>

    {{-- Statistik --}}
    <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-3">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Statistik</h2>
            <select
                class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-red-500 bg-gray-50">
                <option>Bulan Ini</option>
                <option>Minggu Ini</option>
            </select>
        </div>

            <div class="space-y-5">
                <div>
                    <div class="flex justify-between mb-1">
                        <p class="text-sm text-gray-700">Tamu</p>
                        <span class="text-xs font-medium text-gray-500">112</span>
                    </div>
                    <div class="h-3 bg-red-600 rounded-full w-[80%] transition-all"></div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <p class="text-sm text-gray-700">Reservasi</p>
                        <span class="text-xs font-medium text-gray-500">85</span>
                    </div>
                    <div class="h-3 bg-blue-500 rounded-full w-[60%] transition-all"></div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <p class="text-sm text-gray-700">Pesanan</p>
                        <span class="text-xs font-medium text-gray-500">70</span>
                    </div>
                    <div class="h-3 bg-yellow-400 rounded-full w-[50%] transition-all"></div>
                </div>
            </div>
        </section>
    </div>
@endsection
