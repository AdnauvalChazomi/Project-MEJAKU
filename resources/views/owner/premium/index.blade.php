@extends('layouts.app')
@section('title', 'Paket Premium | MejaKu')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6 py-8">

        <div class="text-center space-y-2">
            <h2 class="text-xl font-bold text-gray-900">Tingkatkan Fitur Anda</h2>
            <p class="text-gray-600">Dapatkan wawasan lebih dalam dan kelola restoran Anda lebih efisien dengan Paket
                Premium.</p>
        </div>

        @if ($user->owner->tier === 'month')
            <div class="border border-green-300 rounded-2xl p-6 text-center bg-green-50 shadow-sm">
                <h3 class="text-xl font-extrabold text-green-900 mb-3">
                    🌟 Paket Premium Tahunan Aktif
                </h3>

                <p class="text-sm text-green-800 leading-relaxed mb-3">
                    Anda menikmati semua fitur premium selama sebulan kedepan.
                    Terima kasih telah mempercayai layanan kami!
                </p>

                <div class="p-3 bg-white rounded-xl border border-green-200 inline-block mt-2">
                    <p class="text-sm font-medium text-green-900">
                        Paket premium anda akan berakhir pada:
                    </p>
                    <p class="text-lg font-bold text-red-700 mt-1">
                        {{ \Carbon\Carbon::parse($user->owner->tier_end_at)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        @elseif($user->owner->tier === 'year')
            <div class="border border-green-300 rounded-2xl p-6 text-center bg-green-50 shadow-sm">
                <h3 class="text-xl font-extrabold text-green-900 mb-3">
                    🌟 Paket Premium Tahunan Aktif
                </h3>

                <p class="text-sm text-green-800 leading-relaxed mb-3">
                    Anda menikmati semua fitur premium sepanjang tahun.
                    Terima kasih telah mempercayai layanan kami!
                </p>

                <div class="p-3 bg-white rounded-xl border border-green-200 inline-block mt-2">
                    <p class="text-sm font-medium text-green-900">
                        Paket premium anda akan berakhir pada:
                    </p>
                    <p class="text-lg font-bold text-red-700 mt-1">
                        {{ \Carbon\Carbon::parse($user->owner->tier_end_at)->translatedFormat('d F Y') }}
                    </p>
                </div>
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
                        <button type="submit"
                            class="mt-4 w-full py-2 bg-[#9D3935] text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
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
                        <button type="submit"
                            class="mt-4 w-full py-2 bg-[#9D3935] text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                            Pilih Paket Bulanan
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
@endsection
