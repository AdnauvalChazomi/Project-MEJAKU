<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | MejaKu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* Gaya kustom untuk memastikan progress bar terlihat baik di Tailwind */
        .progress-bar {
            background-color: #f3f4f6;
            /* bg-gray-200 */
            height: 4px;
            width: 100%;
            border-radius: 9999px;
            /* rounded-full */
            overflow: hidden;
        }

        .progress-fill {
            background-color: #A63232;
            /* Warna merah sesuai tema MejaKu */
            height: 100%;
            transition: width 0.5s ease;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="min-h-screen bg-white flex flex-col">
        <div x-data="{ open: false }" class="relative">
            <header>
                <div class="flex justify-between items-center px-4 py-3 bg-white shadow-sm border-b">
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
                </div>
                <div class="flex items-center px-4 py-3 bg-white shadow-sm border-b">
                    <a href="#" class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="text-gray-900 font-semibold text-lg flex-1">Profil Saya</h1>
                </div>
            </header>

            <div class="max-w-lg mx-auto px-0 pt-4 pb-16">

                <div class="px-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://i.pravatar.cc/150?img=68" alt="Budi Budiman"
                                class="w-16 h-16 rounded-full object-cover mr-4 border-2 border-white shadow-md">
                            <div>
                                <p class="text-lg font-bold text-gray-800">Budi Budiman</p>
                                <p class="text-sm text-gray-500">budibudiman@gmail.com</p>
                            </div>
                        </div>
                        <a href="#" class="text-[#A63232] p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-pencil-alt w-5 h-5"></i>
                        </a>
                    </div>

                    <div class="mt-4">
                        <div class="flex justify-between items-center text-xs text-gray-600 mb-1">
                            <span class="font-semibold">90%</span>
                            <span class="text-right">9 / 10 profile data filled</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 90%;"></div>
                        </div>
                    </div>
                </div>

                <nav class="border-t border-gray-200">
                    <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Profil</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 border-t border-gray-100 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Riwayat Reservasi</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 border-t border-gray-100 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Poin Saya</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 border-t border-gray-100 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Metode Pembayaran</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Settings</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Bahasa</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 border-t border-gray-100 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Notifikasi</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 border-t border-gray-100 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Kebijakan Privasi</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 border-t border-gray-100 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Bantuan & Dukungan</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    <a href="#" class="flex justify-between items-center p-4 border-t border-gray-100 hover:bg-gray-50 transition duration-150">
                        <span class="text-gray-700 font-medium">Tentang Website</span>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                </nav>

                <div class="mt-4 border-t border-gray-200">
                    <form method="POST" action="/logout"> @csrf
                        <button type="submit" class="w-full text-left p-4 text-gray-700 font-medium hover:bg-red-50 hover:text-red-700 transition duration-150 text-center">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.querySelector('button'); // tombol hamburger
        const closeBtn = document.getElementById('closeSidebar');

        if (openBtn && sidebar && overlay && closeBtn) {
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
        }
    </script>
</body>

</html>