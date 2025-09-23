<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mejaku Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6">
        <div class="text-center mb-6">
            <img src="{{ asset('images/headerlogin.png') }}" alt="Mejaku" class="rounded-xl mb-4">
            <h1 class="text-3xl font-extrabold text-red-700">MejaKu</h1>
            <p class="text-2xl text-black font-bold">Selamat Datang Kembali</p>
            <p class="text-sm text-black font-medium">Masuk ke Akun Anda</p>
        </div>

        <form method="get" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" placeholder="Masukkan email"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative mt-1">
                    <input id="password" type="password" placeholder="Masukkan password"
                        class="block w-full pr-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 sm:text-sm"
                        aria-describedby="togglePasswordLabel">
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
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" class="rounded border-gray-300">
                    <span>Simpan Login</span>
                </label>
                <a href="#" class="text-red-600 hover:underline">Lupa Kata Sandi?</a>
            </div>

            <button type="submit"
                class="w-full bg-red-700 text-white py-2 rounded-lg font-semibold hover:bg-red-800 transition">
                Masuk
            </button>
        </form>

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
            <a href="#" class="text-red-600 hover:underline">Daftar Sekarang</a>
        </p>
    </div>

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
</body>

</html>