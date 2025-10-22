@extends('layouts.app')
@section('title', 'Jelajahi Restoran | MejaKu')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <section class="min-h-screen bg-[#FDEEDC] px-6 lg:px-20 py-16">

        {{-- Judul Halaman --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Jelajahi Restoran</h1>
            <p class="text-gray-700 text-sm lg:text-base max-w-2xl mx-auto">
                Temukan restoran, kafe, dan tempat makan terbaik di sekitarmu
            </p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-14 max-w-2xl mx-auto">
            <form action="{{ route('search') }}" method="GET"
                class="flex flex-col sm:flex-row items-stretch gap-4 w-full sm:w-auto">

                {{-- Input Pencarian --}}
                <div class="relative w-full sm:w-80">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari berdasarkan nama atau lokasi..."
                        class="w-full px-4 py-2 pr-10 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-600 focus:outline-none">

                    {{-- Tombol Search --}}
                    <button type="submit"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                {{-- Dropdown Wilayah --}}
                <div class="relative">
                    <select name="lokasi" onchange="this.form.submit()"
                        class="px-4 py-2 rounded-full border border-gray-300 bg-white focus:ring-2 focus:ring-red-600 text-gray-700 hover:border-red-600 transition w-full sm:w-48">
                        <option value="">Semua Wilayah</option>
                        @foreach ($wilayah as $w)
                            <option value="{{ $w }}" {{ request('lokasi') == $w ? 'selected' : '' }}>
                                {{ $w }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 max-w-7xl mx-auto">
            @forelse ($restoran as $r)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:scale-[1.02] transition">
                    <img src="{{ $r->foto_restoran ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjw4ZFGKu7QiaF1gfIPuKsmxOEctEVO8WJ-w&s' }}"
                        alt="{{ $r->nama_restoran }}" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 text-lg">{{ $r->nama_restoran }}</h3>
                        <p class="text-sm text-gray-500">{{ $r->alamat_restoran }}</p>

                        @php
                            $avgRating = $r->reviews->avg('rating') ?? 0; // default 0 jika tidak ada review
                            $fullStars = floor($avgRating);
                        @endphp

                        <div class="flex items-center mt-2 text-yellow-500">
                            @for ($i = 0; $i < $fullStars; $i++)
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                                </svg>
                            @endfor

                            @if ($avgRating == 0)
                                <span class="ml-1 text-sm text-gray-500">Belum ada review</span>
                            @else
                                <span class="ml-1 text-sm text-gray-700">{{ number_format($avgRating, 1) }}</span>
                            @endif
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('detail', ['id' => $r->id]) }}"
                                class="block text-center py-2 rounded-full bg-red-600 text-white font-medium text-sm hover:bg-red-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    @if ($keyword)
                        Tidak ditemukan restoran dengan kata kunci <span
                            class="font-semibold">"{{ $keyword }}"</span>.
                    @else
                        Belum ada data restoran.
                    @endif
                </p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $restoran->links() }}
        </div>
    </section>

    {{-- Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
