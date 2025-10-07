<header class="w-full bg-white shadow-sm">
    <div class="flex items-center justify-between px-4 py-3 relative">

        {{-- Tombol Back --}}
        <button onclick="window.history.back()"
            class="flex items-center gap-1 text-gray-700 hover:text-[#A63232] transition absolute left-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            <span class="hidden sm:inline text-sm font-medium">Kembali</span>
        </button>

        {{-- Logo Tengah --}}
        <div class="flex-1 flex justify-center">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-[#A63232] tracking-tight">
                MejaKu
            </a>
        </div>

        {{-- Dropdown Profile --}}
        <div x-data="{ open: false }" class="absolute right-4">
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
    </div>
</header>
