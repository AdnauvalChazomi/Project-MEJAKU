<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MejaKu')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body>
    <div class="min-h-screen bg-[#FDEEDC] flex flex-col">
        <x-topbar />

        <main class="flex-1">
            @yield('content')
        </main>

        <footer class="bg-white border-t">
            <div class="text-center py-8 border-t">
                <h3 class="text-lg font-semibold text-[#A63232]">MejaKu</h3>
                <ul class="mt-3 space-y-1 text-gray-700">
                    <li><a href="#" class="hover:text-[#A63232]">Partner Resto & Cafe</a></li>
                    <li><a href="#" class="hover:text-[#A63232]">Kontak</a></li>
                    <li><a href="#" class="hover:text-[#A63232]">Tentang</a></li>
                </ul>

                <div class="flex justify-center space-x-5 mt-5 text-gray-600">
                    <a href="#"><i class="fab fa-facebook text-xl hover:text-[#A63232]"></i></a>
                    <a href="#"><i class="fab fa-instagram text-xl hover:text-[#A63232]"></i></a>
                    <a href="#"><i class="fab fa-twitter text-xl hover:text-[#A63232]"></i></a>
                    <a href="#"><i class="fab fa-linkedin text-xl hover:text-[#A63232]"></i></a>
                </div>
            </div>

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
    @stack('scripts')
</body>
</html>
