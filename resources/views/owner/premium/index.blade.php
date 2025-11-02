@extends('layouts.app')
@section('title', 'Paket Premium | MejaKu')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6 py-8">
    <div class="max-w-2xl mx-auto space-y-6 py-8">

    <!-- Header Section -->
    <div class="text-center space-y-2">
        <h2 class="text-xl font-bold text-gray-900">Tingkatkan Fitur Anda</h2>
        <p class="text-gray-600">Dapatkan wawasan lebih dalam dan kelola restoran Anda lebih efisien dengan Paket Premium.</p>
    </div>

    <!-- Pricing Cards -->
    <div class="space-y-6">
        
        <!-- Annual Package -->
        <div class="border border-gray-200 rounded-xl p-6 text-center">
            <div class="bg-red-100 text-red-700 rounded-full px-4 py-1 text-sm font-medium inline-block mb-4">
                Paket Premium Tahunan
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-2">
                Rp 1.490.000<span class="text-lg font-normal text-gray-600">/Tahun</span>
            </div>
        </div>

        <!-- Monthly Package -->
        <div class="border border-gray-200 rounded-xl p-6 text-center">
            <div class="bg-red-100 text-red-700 rounded-full px-4 py-1 text-sm font-medium inline-block mb-4">
                Paket Premium Bulanan
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-2">
                Rp 149.000<span class="text-lg font-normal text-gray-600">/Bulan</span>
            </div>
        </div>

    </div>

    <!-- Features Section -->
    <div class="space-y-4">
        <h3 class="font-medium text-gray-900">Semua fitur gratis, ditambah:</h3>
        
        <div class="space-y-3">
            <!-- Feature 1 -->
            <div class="flex items-start space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div>
                    <strong class="text-gray-900">Analitik Pelanggan:</strong> 
                    <span class="text-gray-600">Pahami data total reservasi, jam sibuk, dan menu favorit pelanggan.</span>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="flex items-start space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div>
                    <strong class="text-gray-900">Integrasi Pre-Order:</strong> 
                    <span class="text-gray-600">Aktifkan fitur pre-order untuk semua atau menu tertentu.</span>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="flex items-start space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div>
                    <strong class="text-gray-900">Manajemen Acara:</strong> 
                    <span class="text-gray-600">Kelola reservasi untuk acara khusus seperti ulang tahun atau gathering.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Upgrade Button -->
    <div class="pt-4">
        <button class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Upgrade ke Premium Sekarang
        </button>
    </div>
</div>
@endsection