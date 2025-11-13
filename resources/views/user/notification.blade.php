@extends('layouts.app')
@section('title', 'Notifikasi | MejaKu')

@section('content')
    <div class="min-h-screen bg-gray-50 px-5 md:px-10 py-8">

        {{-- Header --}}
        <header class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <h1 class="text-xl md:text-2xl font-semibold text-gray-900">Notifikasi</h1>
            </div>
        </header>

        {{-- Search & Sort --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-8">
            <div class="relative w-full md:w-1/2">
                <input type="text" placeholder="Cari di sini..."
                    class="w-full rounded-full border border-gray-200 bg-white pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm placeholder-gray-400" />
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3.5 top-2.5 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        {{-- Group by date --}}
        @php
            use Carbon\Carbon;
            $grouped = $notifications->groupBy(function ($item) {
                $date = Carbon::parse($item->created_at);
                if ($date->isToday()) {
                    return 'Hari Ini';
                }
                if ($date->isYesterday()) {
                    return 'Kemarin';
                }
                return $date->format('d M Y');
            });

            $colors = [
                'info' => 'bg-blue-500',
                'success' => 'bg-green-500',
                'warning' => 'bg-yellow-400',
                'error' => 'bg-red-500',
            ];
        @endphp

        @foreach ($grouped as $label => $notifs)
            <section class="space-y-4 mb-8">
                <h2 class="text-gray-800 font-semibold text-sm uppercase tracking-wide">{{ $label }}</h2>

                @foreach ($notifs as $notif)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex justify-between items-start hover:shadow-md transition">
                        <div class="flex items-start gap-3">
                            <div class="w-1.5 h-14 {{ $colors[$notif->type] ?? 'bg-gray-400' }} rounded-full"></div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">{{ $notif->title }}</h3>
                                <p class="text-sm text-gray-600 leading-snug">
                                    {{ $notif->message }}
                                    @if ($notif->reservation)
                                        (Reservasi #{{ $notif->reservation->nomor_pesanan }})
                                    @endif
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </section>
        @endforeach
    </div>
@endsection
