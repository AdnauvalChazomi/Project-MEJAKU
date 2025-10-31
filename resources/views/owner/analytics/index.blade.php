@extends('layouts.app')
@section('title', 'Analitik Pelanggan | MejaKu')

@section('content')
<div class="relative max-w-lg mx-auto min-h-screen">

    {{-- Header --}}
    <header class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 my-3">Analitik Pelanggan</h1>
            <span class="ml-2 text-xs bg-red-600 text-white px-2 py-0.5 rounded-full font-semibold">PRO</span>
        </div>
    </header>

    {{-- === Grafik Total Reservasi === --}}
    <section class="bg-white border border-gray-100 lg:rounded-2xl p-5 shadow-sm space-y-3 mb-3">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800 text-sm">Total Reservasi</h2>
            <select
                class="text-xs border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-1 focus:ring-red-500 text-gray-700">
                <option>Bulan</option>
                <option>Minggu</option>
                <option>Hari</option>
            </select>
        </div>
        <div class="relative">
            <canvas id="chartReservasi" height="120"></canvas>
        </div>
    </section>

    {{-- === Grafik Jam Sibuk === --}}
    <section class="bg-white border border-gray-100 lg:rounded-2xl p-5 shadow-sm space-y-3 mb-3">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800 text-sm">Jam Sibuk</h2>
            <select
                class="text-xs border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-1 focus:ring-red-500 text-gray-700">
                <option>Hari Ini</option>
                <option>Minggu Ini</option>
                <option>Bulan Ini</option>
            </select>
        </div>
        <div class="relative">
            <canvas id="chartJamSibuk" height="120"></canvas>
        </div>
    </section>

    {{-- === Grafik Menu Favorit === --}}
    <section class="bg-white border border-gray-100 lg:rounded-2xl p-5 shadow-sm space-y-3 mb-3">
        <h2 class="font-semibold text-gray-800 text-sm">Menu Favorit Pelanggan</h2>
        <div class="relative">
            <canvas id="chartMenuFavorit" height="120"></canvas>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // === TOTAL RESERVASI ===
    const ctx1 = document.getElementById('chartReservasi');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['19', '21', '23', '25', '27', '29'],
            datasets: [{
                label: 'Reservasi',
                data: [420, 460, 430, 390, 370, 410],
                backgroundColor: '#8B1E1E',
                borderRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: '#f3f4f6' }, ticks: { stepSize: 100 } }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // === JAM SIBUK ===
    const ctx2 = document.getElementById('chartJamSibuk');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['11', '12', '13', '14', '15', '16'],
            datasets: [{
                label: 'Reservasi',
                data: [500, 450, 420, 380, 460, 430],
                backgroundColor: '#2563EB',
                borderRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: '#f3f4f6' }, ticks: { stepSize: 100 } }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // === MENU FAVORIT ===
    const ctx3 = document.getElementById('chartMenuFavorit');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Pizza', 'Kopi', 'Nasi Goreng', 'Tahu', 'Ayam Bakar', 'Teh', 'Mie Goreng'],
            datasets: [{
                label: 'Penjualan',
                data: [120, 140, 200, 160, 180, 130, 150],
                backgroundColor: '#FACC15',
                borderRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: '#f3f4f6' }, ticks: { stepSize: 50 } }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush
