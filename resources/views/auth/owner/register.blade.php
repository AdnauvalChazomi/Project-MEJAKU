<x-guest-layout>
    <form method="POST" action="{{ route('register.owner') }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="nama_restoran" :value="__('Nama Restoran *')" />
            <x-text-input id="nama_restoran" class="block mt-1 w-full" type="text" name="nama_restoran"
                :value="old('nama_restoran')" required />
            <x-input-error :messages="$errors->get('nama_restoran')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="alamat_restoran" :value="__('Alamat Lengkap Restoran *')" />
            <textarea id="alamat_restoran" name="alamat_restoran" required
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('alamat_restoran') }}</textarea>
            <x-input-error :messages="$errors->get('alamat_restoran')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Nama Lengkap *')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email *')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="no_hp" :value="__('Nomor HP *')" />
            <x-text-input id="no_hp" class="block mt-1 w-full" type="tel" name="no_hp" :value="old('no_hp')" required
                inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password *')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password *')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('register') }}" class="text-sm text-red-800 hover:text-indigo-900">
            {{ __('Daftar sebagai Customer?') }}
        </a>
    </div>
</x-guest-layout>