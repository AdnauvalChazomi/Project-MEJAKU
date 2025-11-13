@php
$user = Auth::user();
$role = $user->role ?? null;
@endphp

<div x-data="{ open: false }" class="relative z-50">
    <header class="flex items-center justify-between p-4 bg-white shadow-sm">
        {{-- Tombol menu --}}
        <button @click="open = true" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Logo Tengah --}}
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-red-600 tracking-tight">
                MejaKu
            </a>
        </div>


        {{-- Tombol kanan (search atau login) --}}
        <div class="flex items-center gap-3">
            @if (Auth::check())
            @switch($role)
            @case('customer')
            <div x-data="{ open: false }" class="absolute right-4">

                {{-- Dropdown Profile --}}
                <button @click="open = !open" class="focus:outline-none flex items-center space-x-2">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7fy-ZJ4gn-1OP9yXA5PMi-G1eQ7btd8LAm9rl9yxh83Aog2KS_KpzQvbNlskHNOjza7M&usqp=CAU"
                        alt="Profile" class="w-9 h-9 rounded-full border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Menu Dropdown --}}
                <div x-show="open" @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <a href="{{ url('/profile') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @break

            @case('owner')
            {{-- Ikon Notifikasi dan Pengaturan untuk Owner --}}
            <div class="flex items-center gap-4">
                {{-- Notifikasi --}}
                <a href="{{ route('notifikasi') }}" class="relative text-gray-700 hover:text-[#A63232]">
                    <i class="ri-notification-3-line text-2xl"></i>
                    {{-- Badge notifikasi (opsional) --}}
                    <span
                        class="absolute -top-1 -right-1 bg-[#A63232] text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">3</span>
                </a>

                {{-- Pengaturan --}}
                <a href="{{ route('setting.index', ['id' => $ownerId]) }}" class="text-gray-700 hover:text-[#A63232]">
                    <i class="ri-settings-3-line text-2xl"></i>
                </a>
            </div>
            @break

            @default
            <a href="{{ url('/dashboard') }}"
                class="px-4 py-2 rounded-md bg-[#A63232] text-white font-medium text-sm shadow hover:bg-[#8f2c2c] transition">
                Dashboard
            </a>
            @endswitch
            @else
            <a href="{{ route('login') }}"
                class="px-6 h-10 flex items-center justify-center rounded-full bg-red-600 text-white font-semibold text-base shadow-md hover:bg-gray-800 transition">
                Log In
            </a>
            @endif
        </div>

    </header>


    {{-- Overlay --}}
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="open = false"></div>

    {{-- Sidebar --}}
    <aside x-show="open" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg z-50 p-6">

        @switch($role)
        @case('customer')
        @php
        $user = Auth::user();
        $customer = $user->customer;
        @endphp

        <div class="flex justify-between items-center p-4 border-b">
            <div class="flex items-center gap-3">
                <img src="{{ $user->foto_profil ? asset('storage/' . $customer->foto_profil) : 'https://cdn-icons-png.flaticon.com/512/2922/2922506.png' }}"
                    alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover">
                <span class="font-medium text-sm">{{ $user->name }}</span>
            </div>
            <button @click="open = false" class="text-2xl text-gray-700 hover:text-red-600">
                &times;
            </button>
        </div>
        @break

        @case('owner')
        @php
        $user = Auth::user();
        $owner = $user->owner;
        @endphp

        <div class="flex justify-between items-center p-4 border-b">
            <div class="flex items-center gap-3">
                <img src="{{ $owner && $owner->foto_restoran ? asset('storage/' . $owner->foto_restoran) : 'https://cdn-icons-png.flaticon.com/512/2922/2922506.png' }}"
                    alt="{{ $owner?->nama_restoran ?? 'Restoran' }}" class="w-10 h-10 rounded-full object-cover">
                <span class="font-medium text-sm">
                    {{ $owner?->nama_restoran ?? 'Restoran Anda' }}
                </span>
            </div>
            <button @click="open = false" class="text-2xl text-gray-700 hover:text-red-600">
                &times;
            </button>
        </div>
        @break

        @default
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold">MejaKu</h2>
            <button @click="open = false" class="text-gray-600 hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        @endswitch

        <nav class="space-y-4 text-gray-700">
            @switch($role)
            @case('customer')
            <h3 class="font-bold mb-2">Menu</h3>
            <ul class="space-y-4">
                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-home-4-line text-lg"></i>
                    <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-calendar-line text-lg"></i>
                    <a href="{{ route('history') }}">Reservasi Saya</a>
                </li>
                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-notification-3-line text-lg"></i>
                    <a href="{{ route('notifikasi') }}">Notifikasi</a>
                </li>

            </ul>

            <h3 class="font-bold mt-6 mb-2">Account</h3>
            <ul class="space-y-4">
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

            @case('owner')
            <h3 class="font-bold mb-2">Menu</h3>
            <ul class="space-y-4">

                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-home-4-line text-lg"></i>
                    <a href="{{ url('/owner/dashboard') }}">Dashboard</a>
                </li>

                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-calendar-check-line text-lg"></i>
                    <a href="{{ route('reservasi') }}">Manajemen Reservasi</a>
                </li>

                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-restaurant-line text-lg"></i>
                    <a href="{{ route('menu') }}">Kelola Menu</a>
                </li>

                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-shopping-bag-3-line text-lg"></i>
                    <a href="{{ route('pesanan') }}">Kelola Pesanan</a>
                </li>

                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-price-tag-3-line text-lg"></i>
                    <a href="{{ route('promo') }}">Kelola Promo</a>
                </li>

                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-notification-3-line text-lg"></i>
                    <a href="{{ route('notifikasi') }}">Notifikasi</a>
                </li>

            </ul>

            <h3 class="font-bold mt-6 mb-2">Account</h3>
            <ul class="space-y-4">

                <li class="flex items-center gap-3 text-[#B1281D] hover:text-[#A63232]">
                    <i class="ri-settings-3-line text-lg"></i>
                    <a href="{{ route('pengaturan') }}">Pengaturan</a>
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