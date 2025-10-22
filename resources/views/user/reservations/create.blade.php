@extends('layouts.app')

@section('title', '{{ $restoran->nama_restoran }} | Mejaku')

@section('navbar')
    <header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
        <button onclick="window.history.back()" class="hover:text-red-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-lg font-bold text-red-600 tracking-tight">Reservasi</h1>
        <div class="w-6"></div>
    </header>
@endsection

@section('content')
    <div x-data="{ open: false }" class="relative">
        <div class="max-w-lg mx-auto">
            <!-- Breadcrumb -->
            <nav class="px-4 py-3 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">{{ $restoran->nama_restoran }}</span>
                <span>/</span>
                <span class="text-gray-800 font-medium">reservasi</span>
            </nav>

            <!-- Section Reservasi -->
            <section class="mx-auto bg-white p-6 lg:rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-3">Reservasi</h3>

                <!-- Input Tanggal & Jumlah Tamu -->
                <div class="max-w-80 grid grid-cols-2 gap-3 mb-4">
                    <input type="date" class="w-full px-4 py-2 rounded-lg border border-gray-200 text-gray-700"
                        placeholder="Tanggal">

                    <div class="relative">
                        <select class="w-full px-4 py-2 rounded-lg border border-gray-200 text-gray-700 appearance-none">
                            <option>1 Tamu</option>
                            <option>2 Tamu</option>
                            <option selected>3 Tamu</option>
                            <option>4 Tamu</option>
                        </select>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Pilih Jam -->
                <h4 class="font-semibold text-base mb-2">Pilih Jam</h4>
                <div id="jam-container" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mb-6 w-full">
                    @foreach (['08:00', '09:00', '10:00', '11:00', '15:00', '21:00', '22:00', '23:00'] as $jam)
                        <button
                            class="jam-btn w-full py-3 rounded-xl bg-gray-100 text-gray-800 text-lg font-semibold transition hover:bg-gray-200">
                            {{ $jam }}
                        </button>
                    @endforeach
                </div>

                <!-- Pilih Area -->
                <h4 class="font-semibold text-base mb-2">Pilih Area</h4>
                <div id="area-container" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-8">
                    @foreach (['Indoor', 'Outdoor', 'Semi Outdoor'] as $area)
                        <button
                            class="area-btn w-full py-3 rounded-xl bg-gray-100 text-gray-800 text-lg font-semibold transition hover:bg-gray-200 ">
                            {{ $area }}
                        </button>
                    @endforeach
                </div>

                <button @click="window.location.href='{{ route('preorder') }}'"
                    class="w-full py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition">
                    Lanjut Reservasi
                </button>
            </section>

            <section class="p-4 bg-white mt-6 lg:rounded-lg shadow mb-12">
                <h3 class="text-lg font-semibold mb-3">Menu Unggulan</h3>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($menus as $menu)
                        <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                            class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden cursor-pointer group">

                            <!-- Gambar -->
                            <div class="relative overflow-hidden">
                                <img src="{{ asset($menu->foto ?? 'images/menu/placeholder.png') }}"
                                    alt="{{ $menu->nama }}"
                                    class="w-full h-32 object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div x-show="hover" x-transition
                                    class="absolute inset-0 bg-black/40 flex items-center justify-center p-3">
                                    <p class="text-white text-sm leading-snug text-center">
                                        {{ $menu->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Detail -->
                            <div class="p-2 text-center transition-all duration-300">
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-red-600">
                                    {{ $menu->nama }}
                                </h4>
                                <p class="text-xs text-gray-500">
                                    Rp{{ number_format($menu->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm col-span-full text-center">Belum ada menu unggulan.</p>
                    @endforelse
                </div>

                <p class="text-center text-gray-400 text-sm mt-4">
                    <a href="{{ route('select-menu') }}" class="hover:underline">Lihat semua menu</a>
                </p>
            </section>
        </div>
    </div>

    <script>
        // ====== LOGIKA PILIH JAM ======
        const jamButtons = document.querySelectorAll('#jam-container .jam-btn');
        jamButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                jamButtons.forEach(b => b.classList.remove('ring-2', 'ring-inset', 'ring-red-600',
                    'bg-gray-200'));
                btn.classList.add('ring-2', 'ring-inset', 'ring-red-600', 'bg-gray-200');
            });
        });

        // ====== LOGIKA PILIH AREA ======
        const areaButtons = document.querySelectorAll('#area-container .area-btn');
        areaButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                areaButtons.forEach(b => b.classList.remove('ring-2', 'ring-inset', 'ring-red-600',
                    'bg-gray-200'));
                btn.classList.add('ring-2', 'ring-inset', 'ring-red-600', 'bg-gray-200');
            });
        });
    </script>
@endsection
