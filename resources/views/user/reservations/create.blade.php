@extends('layouts.app')

@section('title', $restoran->nama_restoran . ' | Mejaku')

@section('navbar')
    <header class="flex items-center justify-between px-4 py-3 border-b sticky top-0 bg-white z-30">
        <button onclick="window.history.back()" class="hover:text-red-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <h1 class="text-lg font-bold text-red-600 tracking-tight">Reservasi</h1>
        <div class="w-6"></div>
    </header>
@endsection

@section('content')
    <div class="relative">
        <div class="max-w-lg mx-auto">
            <nav class="px-4 py-3 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">{{ $restoran->nama_restoran }}</span>
                <span>/</span>
                <span class="text-gray-800 font-medium">Reservasi</span>
            </nav>

            <form action="{{ route('user.reservations.store') }}" method="POST"
                class="mx-auto bg-white p-6 lg:rounded-lg shadow">
                @csrf
                <input type="hidden" name="owner_id" value="{{ $restoran->id }}">

                <h3 class="font-semibold text-lg mb-3">Reservasi</h3>

                <!-- Input Tanggal & Jumlah Tamu -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <input type="date" name="tanggal_reservasi" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-200 text-gray-700"
                        value="{{ old('tanggal_reservasi') }}">

                    <div class="relative">
                        <select name="jumlah_tamu" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 text-gray-700 appearance-none">
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ old('jumlah_tamu') == $i ? 'selected' : '' }}>
                                    {{ $i }} Tamu
                                </option>
                            @endfor
                        </select>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="mb-4">
                    <h4 class="font-semibold text-base mb-2">Jam Operasional</h4>
                    <div class="flex items-center gap-6 text-gray-700">
                        <div>
                            <span class="block text-sm text-gray-500 mb-1">Jam Buka</span>
                            <span class="font-semibold text-lg">
                                {{ $restoran->operational?->jam_buka ?? 'Belum diatur' }}
                            </span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-500 mb-1">Jam Tutup</span>
                            <span class="font-semibold text-lg">
                                {{ $restoran->operational?->jam_tutup ?? 'Belum diatur' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="font-semibold text-base mb-2">Pilih Jam Reservasi</h4>
                    <input type="time" name="jam_reservasi" required
                        class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:outline-none text-gray-800 font-semibold text-lg"
                        value="{{ old('jam_reservasi') }}">
                </div>

                <h4 class="font-semibold text-base mb-2">Pilih Area</h4>
                <div id="area-container" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-8" x-data="{ selectedArea: '{{ old('area') }}' }">
                    @php
                        $areas = $restoran->operational?->area ?? [];
                    @endphp

                    @foreach ($areas as $area)
                        <input type="radio" id="area_{{ str_replace(' ', '_', $area) }}" name="area"
                            value="{{ $area }}" class="sr-only peer" required x-model="selectedArea"
                            {{ old('area') == $area ? 'checked' : '' }}>

                        <label for="area_{{ str_replace(' ', '_', $area) }}"
                            class="block w-full py-3 rounded-xl bg-gray-100 text-gray-800 text-lg font-semibold text-center cursor-pointer border-2 transition hover:bg-gray-200"
                            :class="{
                                'border-gray-100': selectedArea !== '{{ $area }}',
                                ' border-red-600 ring-4 ring-red-500 ring-offset-2': selectedArea === '{{ $area }}'
                            }">
                            {{ $area }}
                        </label>
                    @endforeach
                </div>

                <button type="button" id="confirmReservationBtn"
                    class="w-full py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition">
                    Lanjut Pilih Menu
                </button>
            </form>

            <section class="p-4 bg-white mt-6 lg:rounded-lg shadow mb-12">
                <h3 class="text-lg font-semibold mb-3">Menu Unggulan</h3>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($restoran->menuUnggulan as $unggulan)
                        <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                            class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden cursor-pointer group">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $unggulan->menu->foto) }}"
                                    alt="{{ $unggulan->menu->nama }}"
                                    class="w-full h-32 object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div x-show="hover" x-transition
                                    class="absolute inset-0 bg-black/40 flex items-center justify-center p-3">
                                    <p class="text-white text-sm leading-snug text-center">
                                        {{ $unggulan->menu->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-2 text-center transition-all duration-300">
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-red-600">
                                    {{ $unggulan->menu->nama }}
                                </h4>
                                <p class="text-xs text-gray-500">
                                    Rp{{ number_format($unggulan->menu->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm col-span-full text-center">Belum ada menu unggulan.</p>
                    @endforelse
                </div>

                <p class="text-center text-gray-400 text-sm mt-4">
                    <a href="{{ route('user.menu.index', ['id' => $restoran->id]) }}" class="hover:underline">Lihat semua
                        menu</a>
                </p>
            </section>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const confirmBtn = document.getElementById('confirmReservationBtn');
                const form = document.querySelector('form[action="{{ route('user.reservations.store') }}"]');
                const tanggalInput = form.querySelector('input[name="tanggal_reservasi"]');
                const jamInput = form.querySelector('input[name="jam_reservasi"]');

                // Ambil jam operasional dari Blade (pastikan tersedia)
                const jamBukaStr = '{{ $restoran->operational?->jam_buka ?? '' }}';
                const jamTutupStr = '{{ $restoran->operational?->jam_tutup ?? '' }}';

                // Jika jam operasional tidak diatur, blokir submit
                if (!jamBukaStr || !jamTutupStr) {
                    confirmBtn.disabled = true;
                    confirmBtn.innerText = 'Jam Operasional Belum Diatur';
                    return;
                }

                const [bukaHour, bukaMinute] = jamBukaStr.split(':').map(Number);
                const [tutupHour, tutupMinute] = jamTutupStr.split(':').map(Number);

                confirmBtn.addEventListener('click', (e) => {
                    const tanggal = tanggalInput.value;
                    const jam = jamInput.value;
                    const area = form.querySelector('input[name="area"]:checked');

                    // Validasi wajib diisi
                    if (!tanggal || !jam || !area) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Form Belum Lengkap',
                            text: 'Pastikan tanggal, jam, dan area telah dipilih.',
                            confirmButtonColor: '#dc2626',
                        });
                        return;
                    }

                    // Validasi tanggal tidak masa lalu
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const selectedDate = new Date(tanggal);
                    if (selectedDate < today) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tanggal Tidak Valid',
                            text: 'Tidak bisa reservasi di masa lalu. Pilih hari ini atau setelahnya.',
                            confirmButtonColor: '#dc2626',
                        });
                        return;
                    }

                    const [jamHour, jamMinute] = jam.split(':').map(Number);

                    const bukaTotal = bukaHour * 60 + bukaMinute;
                    const tutupTotal = tutupHour * 60 + tutupMinute;
                    const reservasiTotal = jamHour * 60 + jamMinute;

                    if (reservasiTotal < bukaTotal || reservasiTotal > tutupTotal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Jam Reservasi Tidak Tersedia',
                            html: `
                            <p class="text-sm">Jam operasional restoran:</p>
                            <p class="font-bold text-lg">${jamBukaStr} - ${jamTutupStr}</p>
                            <p class="text-sm mt-2">Silakan pilih jam di antara rentang tersebut.</p>
                        `,
                            confirmButtonColor: '#dc2626',
                        });
                        return;
                    }

                    const now = new Date();
                    if (selectedDate.toDateString() === now.toDateString()) {
                        const nowTotal = now.getHours() * 60 + now.getMinutes();
                        if (reservasiTotal < nowTotal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Jam Sudah Lewat',
                                text: 'Untuk reservasi hari ini, jam tidak boleh kurang dari waktu sekarang.',
                                confirmButtonColor: '#dc2626',
                            });
                            return;
                        }
                    }

                    // Semua validasi lolos → konfirmasi
                    Swal.fire({
                        title: 'Konfirmasi Reservasi',
                        html: `
                        <div class="text-left text-sm space-y-1">
                            <p><strong>Tanggal:</strong> ${new Date(tanggal).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })}</p>
                            <p><strong>Jam:</strong> ${jam}</p>
                            <p><strong>Jumlah Tamu:</strong> ${form.querySelector('select[name="jumlah_tamu"]').value} orang</p>
                            <p><strong>Area:</strong> ${area.value}</p>
                        </div>
                    `,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Reservasi!',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
