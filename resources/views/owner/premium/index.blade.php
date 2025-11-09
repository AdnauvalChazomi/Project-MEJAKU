@extends('layouts.app')
@section('title', 'Paket Premium | MejaKu')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 py-8">

    <div class="text-center space-y-2">
        <h2 class="text-xl font-bold text-gray-900">Tingkatkan Fitur Anda</h2>
        <p class="text-gray-600">Dapatkan wawasan lebih dalam dan kelola restoran Anda lebih efisien dengan Paket Premium.</p>
    </div>

    @if($user->owner->tier === 'month')
        <div class="border border-gray-200 rounded-xl p-6 text-center bg-yellow-50">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Anda sedang menggunakan Paket Bulanan</h3>
            <p class="text-gray-600 mb-4">Silakan menikmati fitur bulanan kami. Terima kasih telah berlangganan!</p>
        </div>
    @elseif($user->owner->tier === 'year')
        <div class="border border-gray-200 rounded-xl p-6 text-center bg-green-50">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Anda sedang menggunakan Paket Tahunan</h3>
            <p class="text-gray-600 mb-4">Nikmati semua fitur premium sepanjang tahun. Terima kasih telah berlangganan!</p>
        </div>
    @else
        <div class="space-y-6">
            <form action="{{ route('neopayment.confirm', ['id' => $user->owner->id]) }}" method="GET">
                @csrf
                <input type="hidden" name="type" value="yearly">
                <div class="border border-gray-200 rounded-xl p-6 text-center">
                    <div class="bg-red-100 text-red-700 rounded-full px-4 py-1 text-sm font-medium inline-block mb-4">
                        Paket Premium Tahunan
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">
                        Rp 1.490.000<span class="text-lg font-normal text-gray-600">/Tahun</span>
                    </div>
                    <button type="submit" class="mt-4 w-full py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                        Pilih Paket Tahunan
                    </button>
                </div>
            </form>

            <!-- Monthly Package -->
            <form action="{{ route('neopayment.confirm', ['id' => $user->owner->id]) }}" method="GET">
                @csrf
                <input type="hidden" name="type" value="monthly">
                <div class="border border-gray-200 rounded-xl p-6 text-center">
                    <div class="bg-red-100 text-red-700 rounded-full px-4 py-1 text-sm font-medium inline-block mb-4">
                        Paket Premium Bulanan
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">
                        Rp 149.000<span class="text-lg font-normal text-gray-600">/Bulan</span>
                    </div>
                    <button type="submit" class="mt-4 w-full py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                        Pilih Paket Bulanan
                    </button>
                </div>
            </form>
        </div>
    @endif

</div>
@endsection
