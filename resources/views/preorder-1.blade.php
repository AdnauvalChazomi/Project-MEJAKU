<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order | MejaKu</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-50 max-w-[393px] mx-auto h-[852px] border shadow-lg relative">

    <!-- Navbar -->
    <div class="flex items-center justify-between px-4 py-3 border-b bg-white">
        <div class="flex items-center gap-2">
            <!-- Hamburger button -->
            <button id="openSidebar" class="p-2 bg-gray-100 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-lg font-bold text-red-700">MejaKu</h1>
        </div>
        <!-- Search -->
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </button>
    </div>

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

    <!-- Konten Halaman -->
    <div class="p-4">
        <!-- Header Pre-Order -->
        <div class="flex items-center justify-between mb-4">
            <button class="flex items-center text-sm text-gray-600">
                ← Pre-Order
            </button>
            <span class="text-sm text-gray-500">Lewati</span>
        </div>

        <!-- Pilih Menu -->
        <div class="bg-gray-100 rounded-lg p-4 mb-4 flex justify-between items-center">
            <span class="text-sm font-medium">Pilih Menu</span>
            <span>›</span>
        </div>

        <!-- Menu Rekomendasi -->
        <h2 class="font-semibold mb-3">Menu Rekomendasi</h2>
        <div class="space-y-3">
            <!-- Item 1 -->
            <div class="flex items-center justify-between bg-white rounded-lg shadow-sm p-3">
                <div class="flex gap-3 items-center">
                    <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-lg object-cover">
                    <div>
                        <p class="font-medium text-sm">Tahu cabe garam</p>
                        <p class="text-xs text-gray-500">Rp.24000</p>
                    </div>
                </div>
                <button class="p-2 bg-gray-100 rounded-full">+</button>
            </div>
            <!-- Item 2 -->
            <div class="flex items-center justify-between bg-white rounded-lg shadow-sm p-3">
                <div class="flex gap-3 items-center">
                    <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-lg object-cover">
                    <div>
                        <p class="font-medium text-sm">Es Kopi Susu</p>
                        <p class="text-xs text-gray-500">Rp.28000</p>
                    </div>
                </div>
                <button class="p-2 bg-gray-100 rounded-full">+</button>
            </div>
        </div>

        <!-- Tombol Pesan -->
        <button class="w-full mt-6 py-2 rounded-lg bg-gray-400 text-white font-semibold">
            Pesan
        </button>
    </div>

    <!-- Script Sidebar -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openSidebar');
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
</body>
</html>
