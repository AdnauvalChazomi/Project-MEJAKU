@php
    $user = Auth::user();
    $role = $user->role ?? null;
@endphp

<div x-data="{ open: false }" class="relative">
    <header class="flex items-center justify-between px-4 py-3">
        <button @click="open = true" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @if (Auth::check())
                @switch($role)
                    @case('customer')
                        <x-button-search placeholder="Cari Makanan..." />
                    @break

                    @default
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-black transition">
                            Dashboard
                        </a>
                @endswitch
            @else
                <a href="{{ route('login') }}"
                    class="px-5 py-2 rounded-full bg-black text-white font-medium text-sm shadow-md hover:bg-gray-800 transition">
                    Log In
                </a>
            @endif
        </div>
    </header>

    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="open = false"></div>

    <aside x-show="open" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg z-50 p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold">MejaKu</h2>
            <button @click="open = false" class="text-gray-600 hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="space-y-4 text-gray-700">
            @switch($role)
                @case('owner')
                    <a href="{{ url('/owner/dashboard') }}" class="block hover:text-[#A63232]">Dashboard Owner</a>
                    <a href="#" class="block hover:text-[#A63232]">Kelola Meja</a>
                    <a href="#" class="block hover:text-[#A63232]">Laporan</a>
                @break

                @case('customer')
                    <h3 class="font-bold mb-2">Menu</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                            <i class="ri-home-4-line text-lg"></i>
                            <a href="{{ url('/customer/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                            <i class="ri-calendar-line text-lg"></i>
                            <a href="#">Reservasi Saya</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                            <i class="ri-star-line text-lg"></i>
                            <a href="#">Poin & Reward</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                            <i class="ri-notification-3-line text-lg"></i>
                            <a href="#">Notifikasi</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                            <i class="ri-heart-3-line text-lg"></i>
                            <a href="#">Resto Favorit</a>
                        </li>
                    </ul>

                    <h3 class="font-bold mt-6 mb-2">Account</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                            <i class="ri-user-line text-lg"></i>
                            <a href="#">Tentang MejaKu</a>
                        </li>
                        <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                            <i class="ri-settings-3-line text-lg"></i>
                            <a href="#">Kebijakan Privasi</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                                    <i class="ri-logout-box-line text-lg"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                @break

                @default
                    <a href="#" class="block hover:text-[#A63232]">Tentang MejaKu</a>
                    <a href="#" class="block hover:text-[#A63232]">Kebijakan Privasi</a>
            @endswitch
        </nav>
    </aside>
</div>
