<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MejaKu - reservasi Saya</title>
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
                            <a href="#">Reservasi Saya</a>
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
    <!-- Breadcrumb -->
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <i class="fas fa-chevron-left mr-2"></i>
        <span>Dashboard /</span>
        <span class="font-medium ml-1">Reservasi Saya</span>
    </div>

    <!-- Reservation Card 1 -->
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <div class="flex justify-between items-start mb-3">
            <div>
                <h3 class="font-bold text-lg text-gray-800">Cafe Lorem</h3>
                <p class="text-sm text-gray-500">Senin, 11 Januari 2025 | 15:30</p>
                <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full mt-1">Reservasi</span>
            </div>
            <div class="bg-gray-100 rounded-lg px-3 py-2 text-center">
                <span class="block text-xs text-gray-600">Nomor Meja</span>
                <span class="font-bold text-lg">2</span>
            </div>
        </div>

        <div class="mb-4">
            <p class="font-medium text-gray-800">Budi Budiman</p>
            <p class="text-sm text-gray-600">1x Pizza</p>
            <p class="text-sm text-gray-600">1x Es Kopi Susu</p>
            <p class="font-semibold mt-2">Rp 50.000</p>
        </div>

        <div class="flex space-x-3">
            <button class="flex-1 bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition-colors">
                Batalkan Reservasi
            </button>
            <button class="flex-1 bg-gray-800 text-white py-2 rounded-lg font-medium hover:bg-gray-900 transition-colors">
                Hubungi Cafe
            </button>
        </div>
    </div>

    <!-- Reservation Card 2 -->
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <div class="flex justify-between items-start mb-3">
            <div>
                <h3 class="font-bold text-lg text-gray-800">Cafe Lorem</h3>
                <p class="text-sm text-gray-500">Senin, 10 Januari 2025 | 15:30</p>
                <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full mt-1">Reservasi</span>
            </div>
            <div class="bg-gray-100 rounded-lg px-3 py-2 text-center">
                <span class="block text-xs text-gray-600">Nomor Meja</span>
                <span class="font-bold text-lg">2</span>
            </div>
        </div>

        <div class="mb-4">
            <p class="font-medium text-gray-800">Budi Budiman</p>
            <p class="text-sm text-gray-600">1x Pizza</p>
            <p class="text-sm text-gray-600">1x Es Kopi Susu</p>
            <p class="font-semibold mt-2">Rp 50.000</p>
        </div>

        <button class="w-full border border-gray-300 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-50 transition-colors">
            Beri Rating
        </button>
    </div>

    <!-- Reservation Card 3 -->
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <div class="flex justify-between items-start mb-3">
            <div>
                <h3 class="font-bold text-lg text-gray-800">Cafe Lorem</h3>
                <p class="text-sm text-gray-500">Senin, 10 Januari 2025 | 15:30</p>
                <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full mt-1">Reservasi Individu</span>
            </div>
            <div class="bg-gray-100 rounded-lg px-3 py-2 text-center">
                <span class="block text-xs text-gray-600">Nomor Meja</span>
                <span class="font-bold text-lg">2</span>
            </div>
        </div>

        <div class="mb-4">
            <p class="font-medium text-gray-800">Budi Budiman</p>
            <p class="text-sm text-gray-600">1x Pizza</p>
            <p class="text-sm text-gray-600">1x Es Kopi Susu</p>
            <p class="font-semibold mt-2">Rp 50.000</p>
        </div>

        <button class="w-full border border-gray-300 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-50 transition-colors">
            Beri Rating
        </button>
    </div>
</div>
</body>
</html>
