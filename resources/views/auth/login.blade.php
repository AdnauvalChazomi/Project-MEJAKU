<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <p class="text-center text-sm font-medium text-gray-800 mb-4">
        Masuk ke Akun Anda
    </p>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                placeholder="Masukkan email"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 sm:text-sm" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
            <div class="relative mt-1">
                <input id="password" type="password" name="password" required
                    placeholder="Masukkan password"
                    class="block w-full pr-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    aria-describedby="togglePasswordLabel" />
                <button id="togglePassword" type="button"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 focus:outline-none"
                    aria-label="Tampilkan password" aria-pressed="false">
                    <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        <path id="pupil" stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center space-x-2">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                <span>Simpan Login</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-red-600 hover:underline">
                    Lupa Kata Sandi?
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full bg-red-700 text-white py-2 rounded-lg font-semibold hover:bg-red-800 transition">
            Masuk
        </button>

        <div class="flex items-center my-6">
            <hr class="flex-1 border-gray-300">
            <span class="px-2 text-gray-500 text-sm">Atau Masuk Dengan</span>
            <hr class="flex-1 border-gray-300">
        </div>

        <div class="flex justify-center space-x-4">
            <a href="#" class="p-2 rounded-full border border-gray-300 hover:bg-gray-100">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-6 h-6">
            </a>
            <a href="#" class="p-2 rounded-full border border-gray-300 hover:bg-gray-100">
                <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" class="w-6 h-6">
            </a>
        </div>

        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-red-600 hover:underline">Daftar Sekarang</a>
        </p>
    </form>

    <script>
        (function () {
            const pwInput = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePassword');
            const iconEye = document.getElementById('iconEye');

            toggleBtn.addEventListener('click', function () {
                const isPassword = pwInput.type === 'password';
                pwInput.type = isPassword ? 'text' : 'password';
                toggleBtn.setAttribute('aria-pressed', String(isPassword));
                toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');

                if (isPassword) {
                    iconEye.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    `;
                } else {
                    iconEye.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.14 10.14A3 3 0 0113.86 13.86M9.88 5.88C11.48 5.33 13.21 5 15 5c4.478 0 8.268 2.943 9.542 7-0.59 1.88-1.63 3.53-2.95 4.86M6.09 6.09C4.03 7.89 2.73 9.9 2.458 12 3.732 16.057 7.523 19 12 19c1.5 0 2.94-0.3 4.24-0.85"/>
                    `;
                }
            });
        })();
    </script>
</x-guest-layout>
