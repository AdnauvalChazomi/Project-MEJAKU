<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MejaKu - Pilih Jam</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-50">

    <div class="min-h-screen bg-[#FDEEDC] flex flex-col">
        <div x-data="{ open: false }" class="relative">

            <!-- Navbar -->
            <header class="flex justify-between items-center px-4 py-3 bg-white shadow">
                <!-- Hamburger -->
                <button @click="open = true" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-700" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <!-- Brand -->
                <span class="text-[#A63232] font-bold text-lg">MejaKu</span>
                <!-- Search -->
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </header>

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
                            <a href="{{ route('dasboard') }}">Dashboard</a>
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
            <div class="max-w-lg mx-auto">

                <!-- Breadcrumb -->
                <nav class="px-4 py-2 text-sm text-gray-500 flex items-center space-x-2">
                    <a href="#" class="hover:underline">Dashboard</a>
                    <span>/</span>
                    <span class="text-gray-800 font-medium">Cafe Lorem</span>
                </nav>

                <!-- Banner Image -->
                <div class="relative">
                    <img src="{{ asset('images/cafe-banner.jpg') }}" alt="Cafe Lorem"
                        class="w-full h-56 object-cover">

                    <!-- Tombol kiri -->
                    <button
                        class="absolute top-1/2 left-3 transform -translate-y-1/2 bg-black bg-opacity-40 text-white rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Tombol kanan -->
                    <button
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 bg-black bg-opacity-40 text-white rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Detail Cafe -->
                <section class="p-4 bg-white shadow mt-2">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <h2 class="text-lg font-bold">Cafe Lorem</h2>
                            <p class="text-gray-500 text-sm">Jakarta</p>
                            <div class="flex items-center text-yellow-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.173c.969 0 1.371 1.24.588 1.81l-3.376 2.455a1 1 0 00-.364 1.118l1.287 3.967c.3.921-.755 1.688-1.54 1.118l-3.376-2.455a1 1 0 00-1.176 0l-3.376 2.455c-.785.57-1.84-.197-1.54-1.118l1.287-3.967a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.173a1 1 0 00.95-.69l1.286-3.967z" />
                                </svg>
                                <span class="ml-1">4.5</span>
                            </div>
                        </div>
                        <a href="#reservasi"
                            class="px-4 py-2 bg-[#A63232] text-white rounded-lg text-sm font-semibold hover:bg-[#8B2B2B] transition">
                            Reservasi
                        </a>
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                </section>

                <!-- Section Reservasi -->
                <section class="mx-auto bg-white p-6">
                    <h3 class="font-semibold text-lg mb-3">Reservasi</h3>

                    <!-- Input Tanggal & Jumlah Tamu -->
                    <div class="max-w-80 grid grid-cols-2 gap-3 mb-4">
                        <input type="date"
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-red-400 focus:outline-none text-gray-700"
                            placeholder="Tanggal">

                        <div class="relative">
                            <select
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-red-400 focus:outline-none text-gray-700 appearance-none">
                                <option>1 Tamu</option>
                                <option>2 Tamu</option>
                                <option selected>3 Tamu</option>
                                <option>4 Tamu</option>
                            </select>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">▼</span>
                        </div>
                    </div>

                    <!-- Pilih Jam -->
                    <h4 class="font-semibold text-base mb-2">Pilih Jam</h4>
                    <div id="jam-container" class="flex flex-wrap gap-3 mb-4 w-full">
                        <button class="jam-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">08:00</button>
                        <button class="jam-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">09:00</button>
                        <button class="jam-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">10:00</button>
                        <button class="jam-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">11:00</button>
                        <button class="jam-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">15:00</button>
                        <button class="jam-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">21:00</button>
                        <button class="jam-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">21:00</button>
                    </div>

                    <!-- Pilih Area -->
                    <h4 class="font-semibold text-base mb-2">Area</h4>
                    <div id="area-container" class="flex flex-wrap gap-3 mb-6">
                        <button class="area-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">Indoor</button>
                        <button class="area-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">Outdoor</button>
                        <button class="area-btn px-4 py-2 rounded-lg bg-gray-100 text-gray-800">Semi Outdoor</button>
                    </div>

                    <!-- Tombol Lanjut -->
                    <button
                        class="w-full py-3 bg-[#A63232] text-white font-semibold rounded-lg shadow-md hover:bg-[#8B2B2B] transition">
                        Lanjut Reservasi
                    </button>
                </section>

                <footer class="bg-white border-t">
                    <!-- Main Footer -->
                    <div class="text-center py-8 border-t">
                        <h3 class="text-lg font-semibold text-[#A63232]">MejaKu</h3>
                        <ul class="mt-3 space-y-1 text-gray-700">
                            <li><a href="#" class="hover:text-[#A63232]">Partner Resto & Cafe</a></li>
                            <li><a href="#" class="hover:text-[#A63232]">Kontak</a></li>
                            <li><a href="#" class="hover:text-[#A63232]">Tentang</a></li>
                        </ul>

                        <!-- Social Icons -->
                        <div class="flex justify-center space-x-5 mt-5 text-gray-600">
                            <a href="#"><i class="fab fa-facebook text-xl hover:text-[#A63232]"></i></a>
                            <a href="#"><i class="fab fa-instagram text-xl hover:text-[#A63232]"></i></a>
                            <a href="#"><i class="fab fa-twitter text-xl hover:text-[#A63232]"></i></a>
                            <a href="#"><i class="fab fa-linkedin text-xl hover:text-[#A63232]"></i></a>
                        </div>
                    </div>

                    <!-- Bottom Bar -->
                    <div class="border-t text-center py-4 text-sm text-gray-500">
                        <div class="flex justify-center space-x-6 mb-2">
                            <a href="#" class="hover:text-[#A63232]">Indonesia</a>
                            <a href="#" class="hover:text-[#A63232]">Privacy</a>
                            <a href="#" class="hover:text-[#A63232]">Legal</a>
                        </div>
                        <p>© 2025 MejaKu. All Rights Reserved.</p>
                    </div>
                </footer>
            </div>
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

            // ========== LOGIKA PILIH JAM ==========
            const jamButtons = document.querySelectorAll('#jam-container .jam-btn');
            jamButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    jamButtons.forEach(b => b.classList.remove('ring-2', 'ring-inset', 'ring-[#A63232]'));
                    btn.classList.add('ring-2', 'ring-inset', 'ring-[#A63232]');
                });
            });

            // ========== LOGIKA PILIH AREA ==========
            const areaButtons = document.querySelectorAll('#area-container .area-btn');
            areaButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    areaButtons.forEach(b => b.classList.remove('ring-2', 'ring-inset', 'ring-[#A63232]'));
                    btn.classList.add('ring-2', 'ring-inset', 'ring-[#A63232]');
                });
            });
        </script>
</body>

</html>