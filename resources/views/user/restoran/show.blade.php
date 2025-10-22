@extends('layouts.app')

@section('title', $restoran->nama_restoran . ' | Mejaku')

{{-- Navbar --}}
@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div x-data="{ open: false }" class="relative max-w-lg mx-auto min-h-screen">
        <div class="max-w-5xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="px-4 py-3 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">{{ $restoran->nama_restoran }}</span>
            </nav>

            <!-- Banner -->
            <div class="relative mt-2">
                <img src="{{ $restoran->foto_restoran ? asset('storage/' . $restoran->foto_restoran) : 'https://via.placeholder.com/1200x400' }}"
                    alt="{{ $restoran->nama_restoran }}" class="w-full h-64 md:h-96 object-cover lg:rounded-lg shadow">
            </div>

            <!-- Detail Restoran -->
            <section class="p-4 bg-white shadow mt-4 lg:rounded-lg">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-3">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $restoran->nama_restoran }}</h2>
                        <p class="text-gray-500 text-sm">{{ $restoran->alamat_restoran }}</p>
                        <div class="flex items-center text-yellow-500 text-sm mt-1">
                            <i class="fa-solid fa-star text-sm"></i>
                            <span class="ml-1">{{ number_format($restoran->reviews->avg('rating') ?? 0, 1) }}</span>
                            <span class="ml-1 text-gray-400 text-xs">({{ $restoran->reviews->count() }} ulasan)</span>
                        </div>
                    </div>
                    <a href="{{ route('reservations.create', ['id' => $restoran->id]) }}"
                        class="mt-3 md:mt-0 px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 active:scale-95 focus:outline-none
                    focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out shadow-md hover:shadow-lg">
                        Reservasi
                    </a>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $restoran->summary ?? 'Belum ada deskripsi restoran.' }}
                </p>
            </section>

            <!-- Foto Menu -->
            @if ($restoran->fotoMenus && $restoran->fotoMenus->count())
                <section x-data="{ openImage: null }" class="p-4 bg-white mt-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-5">Foto Menu</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
                        @foreach ($restoran->fotoMenus as $foto)
                            <div class="group block cursor-pointer"
                                @click="openImage = '{{ asset('storage/' . $foto->url) }}'">
                                <div
                                    class="aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition relative">
                                    <img src="{{ asset('storage/' . $foto->url) }}" alt="Foto Menu"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div x-show="openImage" style="display: none;"
                        class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                        @click.self="openImage = null">
                        <div class="relative max-w-3xl max-h-[90vh] overflow-auto">
                            <img :src="openImage" class="w-full h-auto rounded-lg shadow-lg cursor-zoom-in"
                                @click="$el.classList.toggle('scale-150')">
                            <button @click="openImage = null"
                                class="absolute top-2 right-2 text-white text-2xl font-bold">&times;</button>
                        </div>
                    </div>
                </section>
            @endif

            <!-- Review Section -->
            <section class="p-4 bg-white mt-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3">Ulasan Pelanggan</h3>
                <div class="space-y-3">
                    @forelse($restoran->reviews as $review)
                        <div class="flex items-start bg-gray-50 p-3 rounded-lg">
                            <img src="{{ $review->user->avatar ?? 'https://cdn-icons-png.flaticon.com/512/2922/2922506.png' }}"
                                class="w-10 h-10 rounded-full mr-3" alt="{{ $review->user->name ?? 'User' }}">
                            <div class="flex-1">
                                <p class="font-medium">{{ $review->user->name ?? 'Anonymous' }}</p>
                                <p class="text-gray-600 text-sm">{{ $review->comment }}</p>
                            </div>
                            <div class="text-yellow-500 text-sm">
                                <i class="fa-solid fa-star"></i> {{ $review->rating }}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center">Belum ada ulasan untuk restoran ini.</p>
                    @endforelse
                </div>
                @if ($restoran->reviews->count() > 0)
                    <p class="text-center text-gray-400 text-sm mt-4">
                        <a href="#semua-review" class="hover:underline">Lihat semua ulasan</a>
                    </p>
                @endif
            </section>

            <!-- Tombol Reservasi -->
            <button @click="window.location.href='{{ route('reservations.create', ['id' => $restoran->id]) }}'"
                class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold
            hover:bg-red-700 active:scale-95 focus:outline-none
            focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out
            shadow-md hover:shadow-lg my-6">
                Reservasi Sekarang
            </button>
        </div>
    </div>

    @push('scripts')
        <script>
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const closeBtn = document.getElementById('closeSidebar');
            const openBtn = document.querySelector('.fa-bars');

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
