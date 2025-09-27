<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Mejaku</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <div class="min-h-screen bg-[#FDEEDC] flex flex-col">
        <div x-data="{ open: false }" class="relative">

            {{-- Header --}}
            <header class="flex items-center justify-between px-4 py-3">
                {{-- Hamburger --}}
                <button @click="open = true" class="focus:outline-none">
                    <!-- Ikon Hamburger -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center w-64 bg-white rounded-full border border-gray-300 px-3 py-2 shadow-sm">

                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <!-- Input -->
                    <input type="text" placeholder="Cari resto / cafe..."
                        class="w-full bg-transparent focus:outline-none text-sm text-gray-700" />
                </div>
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


            {{-- Hero Section --}}
            <section class="flex flex-col items-top text-center px-6 py-6">
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">MejaKu</h1>
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Reservasi Cepat, Makan nikmat!</h2>
                <p class="text-sm text-gray-600 max-w-xs mx-auto">
                    Pesan tempat favoritmu tanpa antre, nikmati hidangan tanpa gangguan.
                </p>

                <a href="#reservasi"
                    class="w-48 px-6 py-3 rounded-lg bg-[#A63232] text-white font-semibold text-base shadow-md hover:bg-[#8B2B2B] transition mx-auto my-5">
                    Reservasi Sekarang
                </a>

                <img src="{{ asset('images/image-1.jpg') }}" alt="Gambar 1" class="w-80 h-auto rounded-lg mx-auto">
            </section>

            <section class="px-6 py-6">
                <div class="w-80 mx-auto">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3">
                        Temukan Tempat Disini
                    </h2>
                    <div class="w-80 mx-auto bg-white p-6 rounded-xl shadow-md space-y-4">
                        <!-- Input Search -->
                        <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2">
                            <!-- Icon Search -->
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Cari Resto / Cafe Disini"
                                class="w-full bg-transparent focus:outline-none text-gray-700" />
                        </div>

                        <!-- Input Kota -->
                        <input type="text" placeholder="Kota"
                            class="w-full bg-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400 text-gray-700" />

                        <!-- Button Cari -->
                        <button
                            class="w-full bg-[#A63232] text-white font-semibold py-3 rounded-lg shadow-md hover:bg-[#8B2B2B] transition">
                            Cari
                        </button>
                    </div>

            </section>

            <section class="px-6 py-8 max-w-lg m-auto">
                <!-- Judul Section -->
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Rekomendasi</h2>

                <!-- Grid Card Rekomendasi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <img src="{{ asset('images/cafe1.jpg') }}" alt="Cafe Lorem" class="w-full h-40 object-cover">
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-900">Cafe Lorem</h3>
                            <p class="text-sm text-gray-500">Jakarta</p>
                            <div class="flex items-center mt-1 text-yellow-500">
                                <!-- Icon Bintang -->
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-700">4.5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <img src="{{ asset('images/cafe2.jpg') }}" alt="Cafe Brasserie"
                            class="w-full h-40 object-cover">
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-900">Cafe Brasserie</h3>
                            <p class="text-sm text-gray-500">Jakarta</p>
                            <div class="flex items-center mt-1 text-yellow-500">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-700">4.5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <img src="{{ asset('images/cafe3.jpg') }}" alt="Sushi House" class="w-full h-40 object-cover">
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-900">Sushi House</h3>
                            <p class="text-sm text-gray-500">Bandung</p>
                            <div class="flex items-center mt-1 text-yellow-500">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.383 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.384-2.46a1 1 0 00-1.176 0l-3.383 2.46c-.785.57-1.84-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.288-3.967z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-700">4.5</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Kenapa Harus MejaKu -->
                <div class="mt-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-2">Kenapa harus MejaKu?</h2>
                    <p class="text-gray-700">
                        Reservasi lebih cepat, bebas antre, dan bisa pre-order.
                        Plus, kumpulkan poin untuk reward spesial!
                    </p>
                </div>
            </section>

            <section class="px-6 py-10 max-w-lg m-auto">
                <!-- Item 1 -->
                <div
                    class="bg-[#A63232] text-white p-6 md:p-10 rounded-lg mb-6 flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div class="text-4xl font-bold">1</div>
                    <div class="md:ml-6 mt-3 md:mt-0">
                        <h3 class="text-lg font-semibold">Reservasi Cepat</h3>
                        <p class="text-sm mt-1">
                            Pesan meja dengan mudah dan dapatkan antrian digital otomatis saat restoran penuh.
                        </p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div
                    class="bg-white text-[#A63232] border border-[#A63232] p-6 md:p-10 rounded-lg mb-6 flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div class="text-4xl font-bold">2</div>
                    <div class="md:ml-6 mt-3 md:mt-0">
                        <h3 class="text-lg font-semibold">Pre-Order & Cashless Payment</h3>
                        <p class="text-sm mt-1 text-gray-700">
                            Pesan makanan sebelum tiba dan bayar langsung lewat aplikasi. Hemat waktu, bebas ribet!
                        </p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div
                    class="bg-[#A63232] text-white p-6 md:p-10 rounded-lg mb-6 flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div class="text-4xl font-bold">3</div>
                    <div class="md:ml-6 mt-3 md:mt-0">
                        <h3 class="text-lg font-semibold flex items-center">Kumpulkan Poin & Dapatkan Reward</h3>
                        <p class="text-sm mt-1">
                            Setiap reservasi mengumpulkan poin yang bisa ditukar dengan diskon atau promo eksklusif.
                            Makin sering pesan, makin banyak keuntungan!
                        </p>
                    </div>
                </div>

                <!-- Partner Logos -->
                <div class="flex justify-center space-x-6 py-4">
                    <img src="/public/logo1.png" alt="Partner 1" class="h-6">
                    <img src="/public/logo2.png" alt="Partner 2" class="h-6">
                    <img src="/public/logo3.png" alt="Partner 3" class="h-6">
                    <img src="/public/logo4.png" alt="Partner 4" class="h-6">
                </div>
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

        <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>