@extends('layouts.app')
@section('title', 'Pengaturan | MejaKu')

@section('content')
<div class="min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-8">

    {{-- Header --}}
    <header class="flex items-center gap-3 mb-6">
        <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Peraturan</h1>
    </header>

    {{-- Profil Restoran --}}
    <section class="bg-white rounded-xl shadow-sm p-6 flex flex-col items-center text-center border border-gray-100">
        <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=300&q=80"
            alt="Cafe Image"
            class="w-24 h-24 rounded-full object-cover shadow-md mb-4">
        <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
        <p class="text-sm text-gray-500">Jakarta</p>
        <p class="text-sm text-green-600 font-medium mt-1">Buka • tutup Pukul 22:00</p>

        {{-- Progress Bar --}}
        <div class="w-full mt-6">
            <div class="flex justify-between text-xs text-gray-600 font-medium mb-1">
                <span>100%</span>
                <span>10 / 10 profile data filled</span>
            </div>
            <div class="w-full bg-gray-200 h-1.5 rounded-full">
                <div class="bg-red-600 h-1.5 rounded-full w-full"></div>
            </div>
        </div>
    </section>

    {{-- Menu Utama --}}
    <section class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100 overflow-hidden">
        <a href="{{ route('owner.restoran.edit') }}" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Profil Restoran</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Manajemen Akun</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Pembayaran</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="{{ route('premium') }}" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Paket Premium</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </section>

    <section class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100 overflow-hidden">
        <div class="p-4 text-sm text-red-600 font-semibold bg-[#FDEEDC]">
            Pengaturan
        </div>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Bahasa</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Notifikasi</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Kebijakan Privasi</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Bantuan & Dukungan</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition">
            <span class="text-sm text-gray-800 font-medium">Tentang Website</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition text-red-600 font-medium">
            <span class="text-sm font-semibold">Log Out</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7" />
            </svg>
        </a>
    </section>
</div>
@endsection
