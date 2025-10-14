@extends('layouts.app')
@section('title', 'MejaKu')


@section('navbar')
<header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
    <button onclick="window.history.back()" class="hover:text-red-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <h1 class="text-lg font-bold text-red-600 tracking-tight">Pre-Order</h1>
    <div class="w-5"></div>
    <a href="{{ route('order') }}"
        class="flex items-center gap-1 text-gray-700 hover:text-red-600 transition absolute right-4">
        <span class="sm:inline text-sm font-medium">Lewati</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>
</header>
@endsection

@section('content')
<!-- Konten Halaman -->
<div class="p-4 max-w-lg mx-auto">

    <!-- Pilih Menu -->
    <a href="{{ route('select-menu') }}"
        class="block w-full bg-gray-100 rounded-lg p-4 mb-4 justify-between font-semibold transform transition-all duration-300 ease-in-out hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 active:scale-95">
        <span class="text-sm font-medium">Pilih Menu</span>
        <span>›</span>
    </a>


    <!-- Menu Rekomendasi -->
    <section class="p-4 bg-white mt-6 lg:rounded-lg shadow mb-6 ">
        <h2 class="font-semibold mb-3">Menu Rekomendasi</h2>

        <div
            x-data="{
        cart: {},
        total: 0,
        increase(id, price) {
            this.cart[id] = (this.cart[id] || 0) + 1;
            this.calculateTotal();
        },
        decrease(id) {
            if (this.cart[id] > 0) {
                this.cart[id]--;
                this.calculateTotal();
            }
        },
        calculateTotal() {
            let sum = 0;
            for (const [key, qty] of Object.entries(this.cart)) {
                const item = this.menuList.find(m => m.id == key);
                if (item) sum += qty * item.price;
            }
            this.total = sum;
        },
        menuList: [
            { id: 1, name: 'Cappuccino', price: 25000, desc: 'Kopi espresso dengan susu panas dan buih lembut.', img: 'https://api.omela.com/storage/content-editor-images/1pH0nroeojxC0IRR9NkEaY0YCzz0vPnMzD3Mbegx.jpg' },
            { id: 2, name: 'Croissant', price: 18000, desc: 'Roti kering berlapis mentega dengan tekstur renyah.', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiDtkdyRh2yjlRKvzCN-zboBk2zQt-AqGKzg&s' },
            { id: 3, name: 'Latte', price: 27000, desc: 'Kopi espresso lembut dengan campuran susu panas.', img: 'https://www.drinksupercoffee.com/cdn/shop/articles/fae84ed5-a18c-4da8-95d8-d38d576fa3b1_latte_2a0c8c48-b26b-48a0-8079-f999ed9fa3fd.jpg?v=1746120400&width=2048' },
            { id: 4, name: 'Blueberry Muffin', price: 22000, desc: 'Muffin lembut dengan isian blueberry segar.', img: 'https://www.kingarthurbaking.com/sites/default/files/2022-12/KABC_Quick-Breads_Blueberry-Muffin_08304.jpg' }
        ]
    }"
            class="space-y-3">

            <template x-for="menu in menuList" :key="menu.id">
                <div class="flex items-center justify-between bg-white rounded-lg shadow-sm p-3 transition hover:shadow-md cursor-pointer">

                    <!-- Kiri: Gambar dan Info -->
                    <div class="flex gap-3 items-center">
                        <div class="relative overflow-hidden rounded-lg">
                            <img :src="menu.img" :alt="menu.name" class="w-16 h-16 object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div>
                            <p class="font-medium text-sm text-gray-800" x-text="menu.name"></p>
                            <p class="text-xs text-gray-500">Rp <span x-text="menu.price.toLocaleString('id-ID')"></span></p>
                        </div>
                    </div>

                    <!-- Kanan: Tombol Tambah / Kurang -->
                    <div class="flex items-center gap-2 bg-gray-50 rounded-lg px-2 py-1 shadow-sm">
                        <button
                            @click="decrease(menu.id)"
                            :class="cart[menu.id] && cart[menu.id] > 0
                            ? 'hover:bg-red-100 active:scale-95'
                            : 'opacity-40 cursor-not-allowed'"
                            class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 transition-all duration-200"
                            :disabled="!cart[menu.id] || cart[menu.id] === 0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>

                        <span x-text="cart[menu.id] || 0" class="w-6 text-center font-medium text-gray-700 select-none"></span>

                        <button
                            @click="increase(menu.id, menu.price)"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-400 text-white hover:bg-yellow-500 active:scale-95 transition-all duration-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
            </template>

            <!-- Total -->
            <div class="flex items-center justify-between border-t pt-3 mt-3">
                <p class="text-sm text-gray-600 font-medium">Total Pesanan</p>
                <p class="text-lg font-semibold text-gray-800">
                    Rp <span x-text="total.toLocaleString('id-ID')"></span>
                </p>
            </div>
        </div>

    </section>

    <div class="sticky bottom-0 p-4 bg-white rounded">
        <button
            class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold transform transition-all duration-300 ease-in-out hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 active:scale-95">
            Pesan
        </button>
    </div>
</div>
@endsection
