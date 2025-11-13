{{-- Header / Navbar Utama --}}
<header class="w-full bg-white shadow-sm">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="text-2xl font-extrabold text-[#9D3935] tracking-tight">
            MejaKu
        </a>

        {{-- Navigation Menu --}}
        <nav class="hidden md:flex space-x-8 text-[15px] font-medium text-gray-500">
            <a href="{{ url('/search') }}" class="hover:text-[#9D3935] transition">
                Daftar Restoran
            </a>

            {{-- Dropdown Menu --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center hover:text-[#9D3935] transition">
                    Diskon Eksklusif
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 mt-[2px]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Dropdown List --}}
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-150 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-100 transform"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-[#9D3935]">Diskon Member</a>
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-[#9D3935]">Promo Spesial</a>
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-[#9D3935]">Kode Kupon</a>
                </div>
            </div>

            <a href="#" class="hover:text-[#9D3935] transition">Panduan</a>
            <a href="#" class="hover:text-[#9D3935] transition">Hadiah</a>
        </nav>

        {{-- Login Button --}}
        <div class="hidden md:block">
            <a href="{{ route('login') }}"
                class="px-5 py-2 rounded-full bg-[#9D3935] text-white font-medium text-sm shadow-md hover:bg-[#8B2B2B] transition">
                Log In
            </a>
        </div>

        {{-- Hamburger Menu (untuk mobile) --}}
        <div class="md:hidden" x-data="{ open: false }">
            <button @click="open = true" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            {{-- Overlay --}}
            <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="open = false"></div>

            {{-- Sidebar Mobile --}}
            <aside x-show="open"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg z-50 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-[#9D3935]">MejaKu</h2>
                    <button @click="open = false" class="text-gray-600 hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="space-y-4 text-gray-700">
                    <a href="{{ url('/restaurants') }}" class="block hover:text-[#9D3935]">Restaurant Directory</a>
                    <a href="#" class="block hover:text-[#9D3935]">Exclusive Discounts</a>
                    <a href="#" class="block hover:text-[#9D3935]">Guides</a>
                    <a href="#" class="block hover:text-[#9D3935]">Rewards</a>
                    <a href="{{ route('login') }}" class="block text-[#9D3935] font-semibold mt-4">Log In</a>
                </nav>
            </aside>
        </div>
    </div>
</header>
