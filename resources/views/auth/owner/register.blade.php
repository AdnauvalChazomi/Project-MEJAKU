<x-guest-layout>
    <form method="POST" action="{{ route('register.owner') }}" class="max-w-2xl mx-auto space-y-6 py-8">
        @csrf

        <!-- Header -->
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-bold text-red-600">MejaKu Partner</h1>
            <h2 class="text-xl font-semibold text-gray-900">Daftarkan Restoran Anda</h2>
            <p class="text-gray-600">Jangkau lebih banyak pelanggan dan kelola reservasi dengan mudah.</p>
        </div>

        <!-- Nama Lengkap Pemilik -->
        <div class="space-y-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Pemilik</label>
            <input id="name" name="name" type="text" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Masukkan nama lengkap pemilik" value="{{ old('name') }}">
            @error('name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Masukkan email" value="{{ old('email') }}">
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nomor Telepon -->
        <div class="space-y-2">
            <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input id="no_hp" name="no_hp" type="tel" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Masukkan nomor telepon" value="{{ old('no_hp') }}" inputmode="numeric" pattern="[0-9]*"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            @error('no_hp')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Masukkan password">
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Ulangi password">
        </div>

        <!-- Checkbox -->
        <div class="flex items-start space-x-2">
            <input id="terms" name="terms" type="checkbox" required
                class="mt-1 h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-2 focus:ring-red-500">
            <label for="terms" class="text-sm text-gray-700">
                Dengan mengklik "Daftar" Anda menerima syarat dan ketentuan kami
            </label>
        </div>

        <!-- Tombol -->
        <button type="submit"
            class="w-full py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
            Daftar
        </button>

        <!-- Link ke Login -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-medium">Masuk</a>
            </p>
        </div>
    </form>
</x-guest-layout>
