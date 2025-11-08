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
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </header>
@endsection

@section('content')
    <div class="p-4 max-w-lg mx-auto" x-data="preOrderApp()">

        <!-- Tombol Pilih Menu Manual -->
        <a href="{{ route('select-menu') }}"
            class="block w-full bg-gray-100 rounded-lg p-4 mb-4 justify-between items-center font-semibold transform transition-all duration-300 ease-in-out hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 active:scale-95">
            <span class="text-sm font-medium">Pilih Menu Manual</span>
            <span></span>
        </a>

        <!-- Tabs -->
        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
            <div class="flex border-b">
                <button @click="activeTab = 'unggulan'"
                    :class="activeTab === 'unggulan' ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-gray-900'"
                    class="flex-1 py-3 text-sm font-semibold transition">
                    Menu Unggulan
                </button>
                <button @click="activeTab = 'semua'"
                    :class="activeTab === 'semua' ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-gray-900'"
                    class="flex-1 py-3 text-sm font-semibold transition">
                    Semua Menu
                </button>
            </div>

            <div class="p-4">
                <div x-show="activeTab === 'unggulan'" x-transition>
                    <template x-for="menu in menuUnggulan" :key="menu.id">
                        <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3 mb-3 shadow-sm">
                            <div class="flex gap-3 items-center">
                                <div class="relative overflow-hidden rounded-lg w-16 h-16">
                                    <img :src="menu.foto_url" :alt="menu.nama" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-medium text-sm text-gray-800" x-text="menu.nama"></p>
                                    <p class="text-xs text-gray-500">Rp <span
                                            x-text="menu.harga.toLocaleString('id-ID')"></span></p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 bg-white rounded-lg px-2 py-1 shadow-sm">
                                <button @click="decrease(menu.id)" :disabled="!cart[menu.id] || cart[menu.id] === 0"
                                    :class="cart[menu.id] > 0 ? 'hover:bg-red-100' : 'opacity-40 cursor-not-allowed'"
                                    class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg>
                                </button>
                                <span x-text="cart[menu.id] || 0" class="w-6 text-center font-medium text-gray-700"></span>
                                <button @click="increase(menu.id, menu.harga)"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-400 text-white hover:bg-yellow-500 transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <p x-show="menuUnggulan.length === 0" class="text-center text-gray-500 text-sm py-4">
                        Belum ada menu unggulan.
                    </p>
                </div>

                <div x-show="activeTab === 'semua'" x-transition>
                    <template x-for="menu in semuaMenu" :key="menu.id">
                        <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3 mb-3 shadow-sm">
                            <div class="flex gap-3 items-center">
                                <div class="relative overflow-hidden rounded-lg w-16 h-16">
                                    <img :src="menu.foto_url" :alt="menu.nama" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-medium text-sm text-gray-800" x-text="menu.nama"></p>
                                    <p class="text-xs text-gray-500">Rp <span
                                            x-text="menu.harga.toLocaleString('id-ID')"></span></p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 bg-white rounded-lg px-2 py-1 shadow-sm">
                                <button @click="decrease(menu.id)" :disabled="!cart[menu.id] || cart[menu.id] === 0"
                                    :class="cart[menu.id] > 0 ? 'hover:bg-red-100' : 'opacity-40 cursor-not-allowed'"
                                    class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg>
                                </button>
                                <span x-text="cart[menu.id] || 0" class="w-6 text-center font-medium text-gray-700"></span>
                                <button @click="increase(menu.id, menu.harga)"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-400 text-white hover:bg-yellow-500 transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <p x-show="semuaMenu.length === 0" class="text-center text-gray-500 text-sm py-4">
                        Belum ada menu tersedia.
                    </p>
                </div>
            </div>
        </div>

        <div class="sticky bottom-0 p-4 bg-white rounded shadow-lg border-t">
            <div class="flex justify-between items-center mb-3">
                <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                <p class="text-lg font-bold text-gray-800">
                    Rp <span x-text="total.toLocaleString('id-ID')"></span>
                </p>
            </div>
            <button @click="pesanSekarang()"
                class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold transform transition-all duration-300 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 active:scale-95">
                <span x-show="total === 0">Lanjutkan tanpa pesanan</span>
                <span x-show="total > 0">Pesan Sekarang</span>
            </button>
        </div>
    </div>
    @push('scripts')
        <script>
            window.reservationId = {{ $reservation->id }};

            function preOrderApp() {
                return {
                    activeTab: 'unggulan',
                    cart: {},
                    total: 0,

                    menuUnggulan: <?php echo json_encode(
                        $restoran->menuUnggulan
                            ->map(function ($item) {
                                return [
                                    'id' => $item->menu->id,
                                    'nama' => $item->menu->nama,
                                    'harga' => $item->menu->harga,
                                    'foto_url' => asset('storage/' . $item->menu->foto),
                                ];
                            })
                            ->toArray(),
                    ); ?>,

                    semuaMenu: <?php echo json_encode(
                        $restoran->menus
                            ->map(function ($menu) {
                                return [
                                    'id' => $menu->id,
                                    'nama' => $menu->nama,
                                    'harga' => $menu->harga,
                                    'foto_url' => asset('storage/' . $menu->foto),
                                ];
                            })
                            ->toArray(),
                    ); ?>,

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
                        for (const [id, qty] of Object.entries(this.cart)) {
                            const menu = [...this.menuUnggulan, ...this.semuaMenu].find(m => m.id == id);
                            if (menu) sum += qty * menu.harga;
                        }
                        this.total = sum;
                    },
                    pesanSekarang() {
                        if (this.total === 0) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Yey!',
                                text: 'Reservasi berhasil!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Lihat detail reservasi'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('history') }}";
                                }
                            });
                            return;
                        }

                        const items = Object.entries(this.cart)
                            .filter(([_, qty]) => qty > 0)
                            .map(([id, qty]) => ({
                                menu_id: id,
                                quantity: qty
                            }));

                        const url = `/preorder/${window.reservationId}`;

                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    items
                                })
                            })
                            .then(res => {
                                if (!res.ok) {
                                    return res.text().then(text => {
                                        throw new Error(text);
                                    });
                                }
                                return res.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    window.location.href = "{{ route('payment.show', ':id') }}".replace(':id',
                                        {{ $reservation->id }});
                                } else {
                                    alert(data.message || 'Gagal menyimpan');
                                }
                            })
                            .catch(err => {
                                console.error('Error:', err);
                                if (err.message.includes('<!DOCTYPE')) {
                                    alert('Terjadi kesalahan server. Cek console.');
                                } else {
                                    alert('Error: ' + err.message);
                                }
                            });
                    }
                };
            }
        </script>
    @endpush
@endsection
