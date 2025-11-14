@extends('layouts.app')
@section('title', 'Dashboard Owner | MejaKu')

@php
    $owner = $user->owner;
@endphp

@section('content')
    <div class="max-w-lg mx-auto min-h-screen bg-gray-50 px-5 md:px-10 py-8 space-y-10">
        <section class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $owner->nama_restoran }}</p>
            </div>

            <div class="w-full md:w-1/3 relative">
                <input type="text" placeholder="Cari di sini..."
                    class="w-full rounded-full border border-gray-200 bg-white pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm placeholder-gray-400 transition" />
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3.5 top-2.5 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </section>

        <section>
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Manajemen Restoran</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ([['icon' => 'https://cdn-icons-png.flaticon.com/512/2890/2890793.png', 'label' => 'Manajemen Reservasi', 'route' => route('reservations.index', ['ownerId' => $owner->id])], ['icon' => 'https://cdn-icons-png.flaticon.com/512/857/857681.png', 'label' => 'Kelola Menu', 'route' => route('menu.index')], ['icon' => 'https://cdn-icons-png.flaticon.com/512/921/921594.png', 'label' => 'Kelola Pesanan', 'route' => route('orders.index', ['id' => $owner->id])], ['icon' => 'https://cdn-icons-png.flaticon.com/512/833/833524.png', 'label' => 'Kelola Promo', 'route' => route('owner.promos.index')]] as $item)
                    <a href="{{ $item['route'] }}"
                        class="group bg-white hover:bg-[#FDEEDC] transition-all duration-300 border border-gray-100 p-5 rounded-2xl shadow-sm hover:shadow-md flex flex-col items-center justify-center space-y-2">
                        <img src="{{ $item['icon'] }}"
                            class="w-10 h-10 opacity-90 group-hover:scale-110 transition-transform" alt="">
                        <p class="text-sm font-medium text-gray-800 group-hover:text-[#9D3935]">{{ $item['label'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-3">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Statistik</h2>
                <form method="GET" class="mb-4">
                    <label class="text-sm font-semibold text-gray-700">Filter:</label>
                    <select name="filter" onchange="this.form.submit()"
                        class="text-sm border border-gray-300 rounded-lg px-5 py-1.5 focus:outline-none focus:ring-1 focus:ring-red-500 bg-gray-50">
                        <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>
                            Semua
                        </option>
                        <option value="month" {{ $filter === 'month' ? 'selected' : '' }}>
                            Bulan Ini
                        </option>
                        <option value="week" {{ $filter === 'week' ? 'selected' : '' }}>
                            Minggu Ini
                        </option>
                    </select>
                </form>
            </div>

            <canvas id="statsChart" height="130"></canvas>
        </section>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const ctx = document.getElementById('statsChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Tamu', 'Reservasi', 'Pesanan'],
                    datasets: [{
                        label: 'Total',
                        data: [
                            {{ $totalTamu }},
                            {{ $totalReservasi }},
                            {{ $totalPesanan }}
                        ],
                        backgroundColor: [
                            'rgba(157, 57, 53, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(251, 191, 36, 0.7)'
                        ],
                        borderColor: [
                            'rgba(157, 57, 53, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(251, 191, 36, 1)'
                        ],
                        borderWidth: 1,
                        borderRadius: 8,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

        });
    </script>
@endsection
