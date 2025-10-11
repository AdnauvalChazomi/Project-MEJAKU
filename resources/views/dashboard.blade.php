@extends('layouts.main')

@section('title', 'Dashboard | MejaKu')

@section('content')
<section class="flex flex-col items-top text-center px-6 py-6">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">MejaKu</h1>
    <h2 class="text-lg font-semibold text-gray-800 mb-3">Reservasi Cepat, Makan nikmat!</h2>
    <p class="text-sm text-gray-600 max-w-xs mx-auto">
        Pesan tempat favoritmu tanpa antre, nikmati hidangan tanpa gangguan.
    </p>

    <a href="#reservasi"
        class="w-48 px-6 py-3 rounded-lg bg-[#A63232] text-white font-semibold text-base shadow-md hover:bg-[#8B2B2B] transition mx-auto my-5">
        Reservasi Sekarang
    </a>

    <img src="{{ asset('images/image-1.jpg') }}" alt="Gambar 1" class="w-80 h-auto rounded-lg mx-auto">
</section>

<section class="flex flex-col items-top px-6 py-6 mx-auto">
    <h2 class="text-lg font-semibold text-gray-800 mb-3">Temukan Tempat Disini</h2>
    <div class="w-80 mx-auto bg-white p-6 rounded-xl shadow-md space-y-4">

        <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2">
            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" placeholder="Cari Resto / Cafe Disini"
                class="w-full bg-transparent focus:outline-none focus:ring-0 text-gray-700" />
        </div>

        <input type="text" placeholder="Kota"
            class="w-full bg-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400 text-gray-700" />

        <button
            class="w-full bg-[#A63232] text-white font-semibold py-3 rounded-lg shadow-md hover:bg-[#8B2B2B] transition">
            Cari
        </button>
    </div>
</section>

<section class="px-6 py-8 max-w-lg m-auto">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Rekomendasi</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ([
            ['Cafe Lorem', 'Jakarta', 'cafe1.jpg', 4.5],
            ['Cafe Brasserie', 'Jakarta', 'cafe2.jpg', 4.5],
            ['Sushi House', 'Bandung', 'cafe3.jpg', 4.5],
        ] as [$name, $city, $img, $rating])
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <img src="{{ asset('images/'.$img) }}" alt="{{ $name }}" class="w-full h-40 object-cover">
            <div class="p-3">
                <h3 class="font-semibold text-gray-900">{{ $name }}</h3>
                <p class="text-sm text-gray-500">{{ $city }}</p>
                <div class="flex items-center mt-1 text-yellow-500">
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                    </svg>
                    <span class="ml-1 text-sm text-gray-700">{{ $rating }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        <h2 class="text-lg font-bold text-gray-900 mb-2">Kenapa harus MejaKu?</h2>
        <p class="text-gray-700">
            Reservasi lebih cepat, bebas antre, dan bisa pre-order.
            Plus, kumpulkan poin untuk reward spesial!
        </p>
    </div>
</section>

<section class="px-6 py-10 max-w-lg m-auto">
    @foreach ([
        ['1', 'Reservasi Cepat', 'Pesan meja dengan mudah dan dapatkan antrian digital otomatis saat restoran penuh.', true],
        ['2', 'Pre-Order & Cashless Payment', 'Pesan makanan sebelum tiba dan bayar langsung lewat aplikasi. Hemat waktu, bebas ribet!', false],
        ['3', 'Kumpulkan Poin & Dapatkan Reward', 'Setiap reservasi mengumpulkan poin yang bisa ditukar dengan diskon atau promo eksklusif.', true],
    ] as [$num, $title, $desc, $dark])
        <div
            class="{{ $dark ? 'bg-[#A63232] text-white' : 'bg-white text-[#A63232] border border-[#A63232]' }} p-6 md:p-10 rounded-lg mb-6 flex flex-col md:flex-row items-start md:items-center justify-between">
            <div class="text-4xl font-bold">{{ $num }}</div>
            <div class="md:ml-6 mt-3 md:mt-0">
                <h3 class="text-lg font-semibold">{{ $title }}</h3>
                <p class="text-sm mt-1 {{ $dark ? '' : 'text-gray-700' }}">{{ $desc }}</p>
            </div>
        </div>
    @endforeach

    <div class="flex justify-center space-x-6 py-4">
        <img src="{{ asset('images/logo1.png') }}" alt="Partner 1" class="h-6">
        <img src="{{ asset('images/logo2.png') }}" alt="Partner 2" class="h-6">
        <img src="{{ asset('images/logo3.png') }}" alt="Partner 3" class="h-6">
        <img src="{{ asset('images/logo4.png') }}" alt="Partner 4" class="h-6">
    </div>
</section>
@endsection
