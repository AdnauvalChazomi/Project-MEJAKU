@extends('layouts.app')
@section('title', 'MejaKu')

@section('content')
<div class="min-h-screen flex flex-col">
    <section
        class="relative bg-cover bg-center bg-no-repeat flex items-center justify-center lg:justify-start text-center lg:text-left px-6 lg:px-20 py-20 lg:py-32"
        style="background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1600&q=80');">

        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="relative z-10 flex flex-col items-center lg:items-start max-w-2xl text-white space-y-5">
            <h1 class="text-5xl lg:text-6xl font-extrabold tracking-wide leading-tight drop-shadow-lg font-sans">
                MejaKu
            </h1>
            <h2 class="text-lg lg:text-2xl font-medium tracking-wide text-[#FDEEDC]">
                Reservasi Cepat, Makan Nikmat!
            </h2>
            <p class="text-sm lg:text-base text-gray-200 max-w-md leading-relaxed">
                Pesan tempat favoritmu tanpa antre, nikmati hidangan tanpa gangguan.
                Rasakan pengalaman reservasi yang praktis dan menyenangkan!
            </p>

            <a href="#reservasi"
                class="px-8 py-3 mt-4 bg-red-600 text-white rounded-full font-semibold
                    hover:bg-red-700 active:scale-95 focus:outline-none
                    focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out
                    shadow-md hover:shadow-lg">
                Reservasi Sekarang
            </a>
        </div>
    </section>

    {{-- Search Section --}}
    <section class="flex flex-col items-center justify-center px-6 lg:px-20 py-16 text-center" id="reservasi">
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6 tracking-wide">
            Temukan Restoran Favoritmu
        </h2>
        <p class="text-gray-700 text-sm lg:text-base mb-8 max-w-md">
            Jelajahi berbagai restoran, cafe, dan tempat makan terbaik di sekitarmu.
        </p>

        {{-- Tombol Arah ke Halaman Cari --}}
        <a href="{{ url('/search') }}"
            class="group relative inline-flex items-center justify-center px-8 py-4 bg-red-600 text-white rounded-full font-semibold
                    hover:bg-red-700 active:scale-95 focus:outline-none
                    focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out
                    shadow-md hover:shadow-lg gap-2">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p>Jelajahi Restoran</p>
            </span>
        </a>
    </section>


    {{-- Rekomendasi Section --}}
    <section class="px-6 lg:px-20 py-10 max-w-7xl mx-auto">
        <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center lg:text-left">Rekomendasi</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            {{-- Card 3 --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:scale-[1.02] transition">
                <img src="https://images.unsplash.com/photo-1544145945-f90425340c7e?w=800&q=80"
                    alt="Sushi House" class="w-full h-40 object-cover">
                <div class="p-3">
                    <h3 class="font-semibold text-gray-900">Sushi House</h3>
                    <p class="text-sm text-gray-500">Bandung</p>
                    <div class="flex items-center mt-1 text-yellow-500">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                        </svg>
                        <span class="ml-1 text-sm text-gray-700">4.5</span>
                    </div>
                </div>
            </div>

            {{-- Card 1 --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:scale-[1.02] transition">
                <img src="https://images.unsplash.com/photo-1555993539-1732b0258235?w=800&q=80"
                    alt="Cafe Lorem" class="w-full h-40 object-cover">
                <div class="p-3">
                    <h3 class="font-semibold text-gray-900">Cafe Lorem</h3>
                    <p class="text-sm text-gray-500">Jakarta</p>
                    <div class="flex items-center mt-1 text-yellow-500">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                        </svg>
                        <span class="ml-1 text-sm text-gray-700">4.5</span>
                    </div>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:scale-[1.02] transition">
                <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=800&q=80"
                    alt="Cafe Brasserie" class="w-full h-40 object-cover">
                <div class="p-3">
                    <h3 class="font-semibold text-gray-900">Cafe Brasserie</h3>
                    <p class="text-sm text-gray-500">Jakarta</p>
                    <div class="flex items-center mt-1 text-yellow-500">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                        </svg>
                        <span class="ml-1 text-sm text-gray-700">4.5</span>
                    </div>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:scale-[1.02] transition">
                <img src="https://images.unsplash.com/photo-1544145945-f90425340c7e?w=800&q=80"
                    alt="Sushi House" class="w-full h-40 object-cover">
                <div class="p-3">
                    <h3 class="font-semibold text-gray-900">Sushi House</h3>
                    <p class="text-sm text-gray-500">Bandung</p>
                    <div class="flex items-center mt-1 text-yellow-500">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                        </svg>
                        <span class="ml-1 text-sm text-gray-700">4.5</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kenapa Harus Mejaku --}}
        <div class="mt-10 lg:mt-16 text-center lg:text-left">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Kenapa Harus MejaKu?</h2>
            <p class="text-gray-700 max-w-3xl">
                Reservasi lebih cepat, bebas antre, dan bisa pre-order.
                Plus, kumpulkan poin untuk reward spesial!
            </p>
        </div>
    </section>

    {{-- Fitur Section --}}
    <section class="px-6 lg:px-20 py-10 max-w-7xl mx-auto grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <div class="bg-red-600 text-white p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Reservasi Cepat</h3>
            <p class="text-sm">
                Pesan meja dengan mudah dan dapatkan antrian digital otomatis saat restoran penuh.
            </p>
        </div>

        <div class="bg-white border-2 border-red-600 text-red-600 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Pre-Order & Cashless Payment</h3>
            <p class="text-sm text-gray-700">
                Pesan makanan sebelum tiba dan bayar langsung lewat aplikasi. Hemat waktu, bebas ribet!
            </p>
        </div>

        <div class="bg-red-600 text-white p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Kumpulkan Poin & Dapatkan Reward</h3>
            <p class="text-sm">
                Setiap reservasi mengumpulkan poin yang bisa ditukar dengan diskon atau promo eksklusif.
            </p>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
