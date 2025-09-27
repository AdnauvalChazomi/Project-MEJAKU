<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MejaKu - Struk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-white font-sans">

<!-- Header -->
    <header class="bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <button class="bg-gray-800 text-white p-2 rounded">
            <i class="fas fa-bars text-lg"></i>
        </button>
        <h1 class="text-xl font-bold text-red-700">MejaKu</h1>
    </div>
    <x-button-search placeholder="Cari Makanan..." />
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchContainer = document.querySelector('.search-container');
    const searchInput = searchContainer.querySelector('input');
    const searchIcon = searchContainer.querySelector('i');
    
    // Toggle search expansion
    searchContainer.addEventListener('click', function(e) {
        e.stopPropagation();
        const isExpanded = this.classList.contains('expanded');
        
        if (!isExpanded) {
            // Expand
            this.classList.add('expanded');
            searchInput.style.width = '120px';
            searchInput.style.opacity = '1';
            searchInput.focus();
        }
    });
    
    // Close when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchContainer.contains(e.target)) {
            searchContainer.classList.remove('expanded');
            searchInput.style.width = '0';
            searchInput.style.opacity = '0';
        }
    });
    
    // Prevent closing when clicking inside input
    searchInput.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>

 <!-- Overlay -->
            <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

            <!-- Sidebar User -->
            <div id="sidebar"
                class="fixed top-0 left-0 h-screen w-[270px] bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50">

                <!-- Header User -->
                <div class="flex justify-between items-center p-4 border-b">
                    <div class="flex items-center gap-3">
                        <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
                        <span class="font-medium text-sm">Budi Budiman</span>
                    </div>
                    <button id="closeSidebar" class="text-2xl text-gray-700 hover:text-red-600">
                        &times;
                    </button>
                </div>

                <!-- Menu -->
                <nav class="p-4 text-sm">
                    <h3 class="font-bold mb-2">Menu</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-[#B1281D]">
                            <i class="ri-home-4-line text-lg"></i>
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D]">
                            <i class="ri-calendar-line text-lg"></i>
                            <a href="{{ route('reservasi-saya') }}">Reservasi Saya</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D]">
                            <i class="ri-star-line text-lg"></i>
                            <a href="#">Poin & Reward</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D]">
                            <i class="ri-notification-3-line text-lg"></i>
                            <a href="#">Notifikasi</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D]">
                            <i class="ri-heart-3-line text-lg"></i>
                            <a href="#">Resto Favorit</a>
                        </li>
                    </ul>

                    <h3 class="font-bold mt-6 mb-2">Account</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-[#B1281D]">
                            <i class="ri-user-line text-lg"></i>
                            <a href="#">Tentang MejaKu</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D]">
                            <i class="ri-settings-3-line text-lg"></i>
                            <a href="#">Kebijakan Privasi</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 text-[#B1281D]">
                                    <i class="ri-logout-box-line text-lg"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>

                    </ul>
                </nav>
            </div>

            <script>
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                const openBtn = document.querySelector('button'); // tombol hamburger
                const closeBtn = document.getElementById('closeSidebar');

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
            </script>

<div class="px-4 py-6 space-y-6">
    <!-- Page Title -->
    <h1 class="text-center font-semibold text-lg">Struk Pembayaran</h1>

    <!-- Receipt Card -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <!-- Cafe Info -->
        <div class="text-center mb-6">
            <h2 class="font-bold text-xl text-gray-800">Cafe Lorem</h2>
            <p class="text-gray-500 text-sm mt-1">Senin, 11 Januari 2025</p>
        </div>

        <!-- Payment Details -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3">Rincian Pembayaran</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>Total Harga</span>
                    <span>Rp 50.000</span>
                </div>
                <div class="flex justify-between">
                    <span>Voucher</span>
                    <span>-Rp 5.000</span>
                </div>
                <div class="flex justify-between">
                    <span>Biaya Reservasi</span>
                    <span>Rp 10.000</span>
                </div>
                <div class="flex justify-between">
                    <span>Pajak</span>
                    <span>Rp 10.000</span>
                </div>
                <hr class="border-gray-200 my-2">
                <div class="flex justify-between font-bold">
                    <span>Total</span>
                    <span>Rp 50.000</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Smart Queue Section -->
<a href="{{ route('smart-queue') }}" class="block bg-white rounded-xl p-4 shadow-sm hover:bg-gray-50 transition-colors">
    <div class="flex justify-between items-center">
        <span class="font-medium">Smart Queue</span>
        <i class="fas fa-chevron-right text-gray-500"></i>
    </div>
</a>

    <!-- Action Button -->
    <div class="px-4 py-6">
        <button class="w-full bg-red-700 text-white font-semibold py-3 rounded-lg hover:bg-red-800 transition-colors">
            Lihat Reservasi Saya
        </button>
    </div>
</div>
</body>
</html>
        