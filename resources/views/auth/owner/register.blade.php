<x-guest-layout>
    <form method="POST" action="{{ route('register.owner') }}">
        @csrf

       <div class="max-w-2xl mx-auto space-y-6 py-8">

    <!-- Header -->
    <div class="text-center space-y-2">
        <h1 class="text-2xl font-bold text-red-600">MejaKu Partner</h1>
        <h2 class="text-xl font-semibold text-gray-900">Daftarkan Restoran Anda</h2>
        <p class="text-gray-600">Jangkau lebih banyak pelanggan dan kelola reservasi dengan mudah.</p>
    </div>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Nama Lengkap Pemilik -->
        <div class="space-y-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Pemilik</label>
            <input id="name" name="name" type="text" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                   placeholder="Masukkan nama lengkap pemilik" value="{{ old('name') }}">
            @error('name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                   placeholder="Masukkan email" value="{{ old('email') }}">
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nomor Telepon -->
        <div class="space-y-2">
            <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input id="no_hp" name="no_hp" type="tel" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                   placeholder="Masukkan nomor telepon" value="{{ old('no_hp') }}"
                   inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            @error('no_hp')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input id="password" name="password" type="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                       placeholder="Masukkan password">
                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Terms Checkbox -->
        <div class="flex items-start space-x-2">
            <input id="terms" name="terms" type="checkbox" required
                   class="mt-1 h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-2 focus:ring-red-500">
            <label for="terms" class="text-sm text-gray-700">
                Dengan mengklik "Daftar" Anda menerima syarat dan ketentuan kami
            </label>
        </div>

        <!-- Register Button -->
        <button type="submit" class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Daftar
        </button>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="px-4 text-sm text-gray-500">Atau Daftar Dengan</span>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>

        <!-- Social Login Buttons -->
        <div class="grid grid-cols-2 gap-4">
            <button type="button" class="flex items-center justify-center py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                    <path d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866.549 3.921 1.453L15.5 5.725H12.545v3.821z" fill="#4285F4"/>
                    <path d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866.549 3.921 1.453L15.5 5.725H12.545v3.821z" fill="#34A853"/>
                    <path d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866.549 3.921 1.453L15.5 5.725H12.545v3.821z" fill="#FBBC05"/>
                    <path d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866.549 3.921 1.453L15.5 5.725H12.545v3.821z" fill="#EA4335"/>
                </svg>
                Google
            </button>
            <button type="button" class="flex items-center justify-center py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="#1877F2" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.991 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-medium">
                    Masuk
                </a>
            </p>
        </div>

    </form>
</div>
</x-guest-layout>
