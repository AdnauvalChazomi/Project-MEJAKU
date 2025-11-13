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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <h1 class="text-xl md:text-2xl font-semibold text-gray-900 my-3">Analitik Pelanggan</h1>
                <span class="ml-2 text-xs bg-[#9D3935] text-white px-2 py-0.5 rounded-full font-semibold">PRO</span>
            </div>

            <div>
                <select onchange="window.location.href='?filter=' + this.value"
                    class="text-xs border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-1 focus:ring-red-500 text-gray-700">
                    <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="today" {{ $filter === 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ $filter === 'week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="month" {{ $filter === 'month' ? 'selected' : '' }}>Bulan Ini</option>
                </select>
            </div>
        </header>

        {{-- === Grafik Total Reservasi === --}}
        <section class="bg-white border border-gray-100 lg:rounded-2xl p-5 shadow-sm space-y-3 mb-3">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Total Reservasi</h2>
            </div>
            <div class="relative">
                <canvas id="chartReservasi" height="120"></canvas>
            </div>
        </section>

        {{-- === Grafik Jam Sibuk === --}}
        <section class="bg-white border border-gray-100 lg:rounded-2xl p-5 shadow-sm space-y-3 mb-3">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-gray-800 text-sm">Jam Sibuk</h2>
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
        const chartReservasi = new Chart(document.getElementById('chartReservasi'), {
            type: 'bar',
            data: {
                labels: @json($reservasi_labels),
                datasets: [{
                    data: @json($reservasi_data),
                    backgroundColor: '#8B1E1E',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const chartJam = new Chart(document.getElementById('chartJamSibuk'), {
            type: 'bar',
            data: {
                labels: @json($jam_labels),
                datasets: [{
                    data: @json($jam_data),
                    backgroundColor: '#2563EB',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const chartMenu = new Chart(document.getElementById('chartMenuFavorit'), {
            type: 'bar',
            data: {
                labels: @json($menu_labels),
                datasets: [{
                    data: @json($menu_data),
                    backgroundColor: '#FACC15',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
