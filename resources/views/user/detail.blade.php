@extends('layouts.app')

@section('title', 'Cafe Lorem | Mejaku')

{{-- Navbar khusus halaman restoran --}}
@section('navbar')
@include('components.navbar')
@endsection

@section('content')
<div x-data="{ open: false }" class="relative max-w-lg mx-auto min-h-screen">
    <!-- Konten Utama -->
    <div class="max-w-5xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="px-4 py-3 text-sm text-gray-500 flex items-center space-x-2">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">Cafe Lorem</span>
        </nav>

        <!-- Banner -->
        <div class="relative">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80"
                alt="Cafe Lorem" class="w-full h-64 md:h-96 object-cover lg:rounded-lg shadow">

            <!-- Tombol navigasi gambar -->
            <button class="absolute top-1/2 left-3 transform -translate-y-1/2 bg-black bg-opacity-40 text-white rounded-full p-2">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="absolute top-1/2 right-3 transform -translate-y-1/2 bg-black bg-opacity-40 text-white rounded-full p-2">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <!-- Detail Cafe -->
        <section class="p-4 bg-white shadow mt-4 lg:rounded-lg">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-3">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Cafe Lorem</h2>
                    <p class="text-gray-500 text-sm">Jakarta Selatan</p>
                    <div class="flex items-center text-yellow-500 text-sm mt-1">
                        <i class="fa-solid fa-star text-sm"></i>
                        <span class="ml-1">4.5</span>
                    </div>
                </div>
                <a href="{{ route('reservations') }}"
                    class="mt-3 md:mt-0 px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 active:scale-95 focus:outline-none 
                    focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out 
                    shadow-md hover:shadow-lg">
                    Reservasi
                </a>
            </div>
            <p class="text-gray-600 text-sm leading-relaxed">
                Cafe Lorem menghadirkan suasana hangat dengan menu kopi dan pastry khas Jakarta.
                Nikmati waktu santai Anda bersama teman dan keluarga.
            </p>
        </section>

        <section class="p-4 bg-white mt-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-5">Book Menu</h3>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
                {{-- Food Menu --}}
                <a href="{{ asset('pdfs/food-menu.pdf') }}" target="_blank"
                    class="group block">
                    <div class="aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition relative">
                        <img src="https://marketplace.canva.com/EAGGkMvO1gk/1/0/1131w/canva-black-illustrative-restaurant-menu-UojxZFjaQDg.jpg"
                            alt="Food Menu" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Open PDF</span>
                        </div>
                    </div>
                    <h4 class="mt-3 text-base font-semibold text-gray-800">Food Menu</h4>
                </a>

                {{-- Beverage Menu --}}
                <a href="{{ asset('pdfs/beverage-menu.pdf') }}" target="_blank"
                    class="group block">
                    <div class="aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition relative">
                        <img src="https://media-cdn.tripadvisor.com/media/photo-s/0f/c7/3d/87/beverages-menu.jpg"
                            alt="Beverage Menu" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Open PDF</span>
                        </div>
                    </div>
                    <h4 class="mt-3 text-base font-semibold text-gray-800">Beverage Menu</h4>
                </a>

                {{-- Dessert Menu --}}
                <a href="{{ asset('pdfs/dessert-menu.pdf') }}" target="_blank"
                    class="group block">
                    <div class="aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition relative">
                        <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/bar-desserts-restaurant-food-menu-flyer-design-template-f1f01c47190f615e6e43d62be1ff14a4_screen.jpg?ts=1683151223"
                            alt="Dessert Menu" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Open PDF</span>
                        </div>
                    </div>
                    <h4 class="mt-3 text-base font-semibold text-gray-800">Dessert Menu</h4>
                </a>
            </div>
        </section>


        <!-- Review Section -->
        <section class="p-4 bg-white mt-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-3">Ulasan Pelanggan</h3>

            <div class="space-y-3">
                <div class="flex items-start bg-gray-50 p-3 rounded-lg">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" class="w-10 h-10 rounded-full mr-3" alt="Budi">
                    <div class="flex-1">
                        <p class="font-medium">Budi</p>
                        <p class="text-gray-600 text-sm">Tempat nyaman dan makanannya lezat!</p>
                    </div>
                    <div class="text-yellow-500 text-sm"><i class="fa-solid fa-star"></i> 4.7</div>
                </div>

                <div class="flex items-start bg-gray-50 p-3 rounded-lg">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" class="w-10 h-10 rounded-full mr-3" alt="Sinta">
                    <div class="flex-1">
                        <p class="font-medium">Sinta</p>
                        <p class="text-gray-600 text-sm">Pelayanan cepat dan harga terjangkau.</p>
                    </div>
                    <div class="text-yellow-500 text-sm"><i class="fa-solid fa-star"></i> 4.8</div>
                </div>
            </div>

            <p class="text-center text-gray-400 text-sm mt-4">
                <a href="#semua-review" class="hover:underline">Lihat semua ulasan</a>
            </p>
        </section>

        <!-- Tombol Reservasi -->
        <button
            @click="window.location.href='{{ route('reservations') }}'"
            class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold 
                    hover:bg-red-700 active:scale-95 focus:outline-none 
                    focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out 
                    shadow-md hover:shadow-lg my-6">
            Reservasi Sekarang
        </button>
    </div>
</div>

{{-- Sidebar Control Script --}}
@push('scripts')
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const closeBtn = document.getElementById('closeSidebar');
    const openBtn = document.querySelector('.fa-bars'); // bisa kamu tambahkan di navbar user

    if (openBtn && sidebar && overlay && closeBtn) {
        openBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });
        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    }
</script>
@endpush
@endsection