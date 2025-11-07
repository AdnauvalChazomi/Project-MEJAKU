@extends('layouts.app')
@section('title', 'Paket Premium | MejaKu')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6 py-8">

    <div class="space-y-2">
        <h3 class="font-medium text-gray-900">Paket</h3>
        <p class="text-gray-600">Paket Premium Bulanan</p>
    </div>

    <div class="space-y-2">
        <h3 class="font-medium text-gray-900">Metode Pembayaran</h3>

        <div class="border border-gray-300 rounded-lg p-3 flex justify-between items-center cursor-pointer hover:bg-gray-50">
            <span class="text-gray-700">Pilih Metode pembayaran</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>

        <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-orange-700 font-medium">Hore! 1 Voucher Berhasil Digunakan</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </div>

    <div class="space-y-2">
        <h3 class="font-medium text-gray-900">Ringkasan Pesanan</h3>

        <div class="border-t border-gray-200 pt-4 space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-700">Total Harga</span>
                <span class="text-gray-900 font-medium">Rp 149.000</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700">Voucher</span>
                <span class="text-red-600 font-medium">-Rp 4.900</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700">Pajak</span>
                <span class="text-gray-900 font-medium">Rp 10.000</span>
            </div>
            <div class="flex justify-between pt-2 border-t border-gray-200">
                <span class="text-gray-900 font-bold">Total</span>
                <span class="text-gray-900 font-bold">Rp 154.100</span>
            </div>
        </div>
    </div>

    <div class="pt-8">
        <button class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Bayar
        </button>
    </div>
</div>
@endsection
