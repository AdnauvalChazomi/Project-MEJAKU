<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Menu | MejaKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="max-w-sm mx-auto min-h-screen bg-white">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-lg font-bold text-red-600">MejaKu</h1>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
            </button>
        </div>

        <!-- Pilih Menu -->
        <div class="p-4">
            <div class="flex items-center gap-2 mb-4">
                <button onclick="history.back()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <h2 class="font-semibold">Pilih Menu</h2>
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

            <!-- Search -->
            <div class="relative mb-4">
                <input type="text" placeholder="Cari Makanan" class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-2 mb-4">
                <button class="px-4 py-2 border rounded-full">Makanan</button>
                <button class="px-4 py-2 border rounded-full">Minuman</button>
                <button class="px-4 py-2 border rounded-full">Dessert</button>
            </div>

            <!-- Menu Grid -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Card Item -->
                <div class="border rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ asset('images/pizza.jpg') }}" alt="Pizza" class="w-full h-28 object-cover">
                    <div class="p-2">
                        <h3 class="font-semibold">Pizza</h3>
                        <p class="text-sm text-gray-600">Rp 25.000</p>
                    </div>
                    <div class="flex justify-end p-2">
                        <button class="p-2 bg-yellow-100 rounded-lg">
                            🛒
                        </button>
                    </div>
                </div>

                <div class="border rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ asset('images/tahu.jpg') }}" alt="Tahu" class="w-full h-28 object-cover">
                    <div class="p-2">
                        <h3 class="font-semibold">Tahu</h3>
                        <p class="text-sm text-gray-600">Rp 25.000</p>
                    </div>
                    <div class="flex justify-end p-2">
                        <button class="p-2 bg-yellow-100 rounded-lg">
                            🛒
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
