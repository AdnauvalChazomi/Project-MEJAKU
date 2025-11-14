@extends('layouts.app')
@section('title', 'MejaKu - Menu Restoran')

@section('navbar')
<header class="flex items-center justify-between px-4 border-b sticky top-0 bg-white z-30">
    <button onclick="window.history.back()" class="hover:text-[#9D3935] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <h1 class="text-lg font-bold text-[#9D3935] tracking-tight">Daftar Menu</h1>
    <div class="w-6"></div>
</header>
@endsection

@section('content')
<div x-data="menuPage()" class="relative max-w-lg mx-auto min-h-screen p-6">
    <main class="p-4 space-y-5 max-w-lg mx-auto bg-white rounded-lg mt-2 mb-10">
        <div class="relative">
            <input type="text" x-model="search" placeholder="Cari makanan atau minuman..."
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-200 focus:outline-none text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 w-5 h-5 text-gray-400"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
            </svg>
        </div>

        <div class="flex gap-2 overflow-x-auto no-scrollbar">
            <template x-for="btn in ['all','makanan','minuman','dessert']">
                <button @click="category = btn"
                    :class="category === btn ? 'bg-[#9D3935] text-white' : 'border text-gray-600 hover:bg-red-100'"
                    class="px-4 py-2 rounded-full text-sm font-medium transition whitespace-nowrap capitalize">
                    <span x-text="btn"></span>
                </button>
            </template>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-10">
            @forelse ($menus as $menu)
            <div x-show="(category === 'all' || category === '{{ $menu->kategori }}') && (search === '' || '{{ strtolower($menu->nama) }}'.includes(search.toLowerCase()))"
                x-transition
                class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition bg-white group p-2 relative mb-6">

                <div class="relative overflow-hidden">
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama }}"
                        class="w-full h-28 object-cover transition-transform duration-300 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition flex items-center justify-center p-3 opacity-0 group-hover:opacity-100">
                        <p class="text-white text-xs text-center leading-snug">
                            {{ $menu->deskripsi ?? 'Deskripsi menu belum tersedia.' }}
                        </p>
                    </div>
                </div>

                <div class="p-2">
                    <h3 class="font-medium text-sm text-gray-800 group-hover:text-[#9D3935]">{{ $menu->nama }}</h3>
                    <p class="text-xs text-gray-500">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                </div>

                <div class="flex justify-end p-2">
                    <div class="flex items-center gap-2 bg-gray-50 rounded-lg px-2 py-1 shadow-sm">
                        <button @click="decrease({{ $menu->id }}, {{ $menu->harga }})"
                            :class="cart['{{ $menu->id }}'] && cart['{{ $menu->id }}'] > 0 ?
                                        'hover:bg-red-100 active:scale-95' :
                                        'opacity-40 cursor-not-allowed'"
                            class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 transition-all duration-200"
                            :disabled="!cart['{{ $menu->id }}'] || cart['{{ $menu->id }}'] === 0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 12H4" />
                            </svg>
                        </button>

                        <span x-text="cart['{{ $menu->id }}'] || 0"
                            class="w-6 text-center font-medium text-gray-700 select-none"></span>

                        <button @click="increase({{ $menu->id }}, {{ $menu->harga }})"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-400 text-white hover:bg-yellow-500 active:scale-95 transition-all duration-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500 col-span-2 py-6">Belum ada menu tersedia.</p>
            @endforelse
        </div>

        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-gray-600 font-medium">Total Pesanan</p>
            <p class="text-lg font-semibold text-gray-800">
                Rp <span x-text="total.toLocaleString('id-ID')"></span>
            </p>
        </div>

        <button @click="window.location.href='{{ route('reservations.create', ['id' => $ownerId]) }}'"
            class="w-full bg-[#9D3935] text-white py-3 rounded-lg font-semibold
                    hover:bg-red-700 active:scale-95 focus:outline-none
                    focus:ring-2 focus:ring-red-300 transition-all duration-300 ease-in-out
                    shadow-md hover:shadow-lg">
            Pesan Sekarang
        </button>
    </main>
</div>

<!-- Alpine.js Component Logic -->
<script>
    function menuPage() {
        return {
            category: 'all',
            search: '',
            cart: {},
            total: 0,

            increase(id, price) {
                if (!this.cart[id]) this.cart[id] = 0;
                this.cart[id]++;
                this.total += Number(price);
            },

            decrease(id, price) {
                if (this.cart[id] && this.cart[id] > 0) {
                    this.cart[id]--;
                    this.total -= Number(price);
                    if (this.cart[id] < 0) this.cart[id] = 0;
                    if (this.total < 0) this.total = 0;
                }
            },
        }
    }
</script>
@endsection