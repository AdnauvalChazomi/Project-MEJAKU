@extends('layouts.app')
@section('title', 'Profil Restoran | MejaKu')

@section('content')
    <div x-data="{ activeTab: 'tentang' }" class="relative max-w-lg mx-auto min-h-screen px-10 py-8">

        <div class="border-b border-gray-300">
            <nav class="flex space-x-8">
                @foreach (['tentang' => 'Tentang', 'menu' => 'Unggulan', 'operasional' => 'Operasional', 'ulasan' => 'Ulasan'] as $key => $label)
                    <button @click="activeTab = '{{ $key }}'"
                        :class="{
                            'border-red-600 text-[#9D3935]': activeTab === '{{ $key }}',
                            'text-gray-500 hover:text-gray-700': activeTab !== '{{ $key }}'
                        }"
                        class="py-3 px-1 border-b-2 font-medium text-sm focus:outline-none">
                        {{ $label }}
                    </button>
                @endforeach
            </nav>
        </div>

        <div x-show="activeTab === 'tentang'" x-cloak class="space-y-8">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Restoran</label>

                @if ($owner->foto_restoran)
                    <div
                        class="w-full max-w-md rounded-lg overflow-hidden border-dashed border-2 border-gray-300 shadow flex justify-center items-center bg-gray-50 mx-auto p-2">
                        <img src="{{ asset('storage/' . $owner->foto_restoran) }}" alt="Foto Restoran"
                            class="w-auto max-w-full h-auto max-h-80 object-contain rounded-lg transition-all duration-300 hover:scale-105">
                    </div>

                    <div class="mt-3 flex justify-center items-center gap-3">
                        <form method="POST" action="{{ route('owner.restoran.foto.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="foto_restoran" id="gantiFotoRestoran" class="hidden"
                                onchange="this.form.submit()">
                            <label for="gantiFotoRestoran"
                                class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-[#9D3935] text-white text-sm rounded-lg hover:bg-red-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Ganti Foto
                            </label>
                        </form>

                        <form method="POST" action="{{ route('owner.restoran.foto.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus foto restoran ini?')"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-[#9D3935] text-white text-sm rounded-lg hover:bg-red-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Hapus Foto
                            </button>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('owner.restoran.foto.store') }}" enctype="multipart/form-data"
                        class="border-dashed border-2 border-gray-300 p-6 rounded-lg text-center h-56 flex flex-col justify-center items-center bg-gray-50">
                        @csrf
                        <p class="text-gray-500 mb-3">Belum ada foto restoran</p>
                        <input type="file" name="foto_restoran" id="uploadFotoRestoran" class="hidden"
                            onchange="this.form.submit()">
                        <label for="uploadFotoRestoran"
                            class="cursor-pointer px-4 py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700 transition">
                            Upload Foto Restoran
                        </label>
                    </form>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Galeri Foto Menu</label>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 my-6">
                    @forelse ($fotoMenus as $foto)
                        <div class="flex flex-col items-center space-y-2 cursor-pointer"
                            @click="openImage = '{{ asset('storage/' . $foto->url) }}'">
                            <img src="{{ asset('storage/' . $foto->url) }}" alt="Foto Menu"
                                class="w-24 h-24 object-cover rounded-lg border border-gray-200 shadow-sm hover:scale-105 transition-transform duration-300">

                            <form action="{{ route('owner.restoran.foto.menu.destroy', $foto->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center justify-center space-x-1 px-3 py-1 text-sm bg-[#9D3935] hover:bg-red-700 text-white rounded-md shadow-sm transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="col-span-full text-gray-500 text-sm text-center">Belum ada foto menu.</p>
                    @endforelse

                    <!-- Tombol Tambah -->
                    <form action="{{ route('owner.restoran.foto.menu.store') }}" method="POST"
                        enctype="multipart/form-data"
                        class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center cursor-pointer hover:bg-gray-300 transition">
                        @csrf
                        <input type="file" name="foto" id="uploadMenuFoto" class="hidden"
                            onchange="this.form.submit()">
                        <label for="uploadMenuFoto" class="cursor-pointer flex items-center justify-center w-full h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </label>
                    </form>
                </div>
            </div>

            <form method="POST" action="{{ route('owner.restoran.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-[#9D3935]">Nama Restoran</label>
                    <input type="text" name="nama_restoran" value="{{ old('nama_restoran', $owner->nama_restoran) }}"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#9D3935]">Alamat Restoran</label>
                    <textarea name="alamat_restoran" rows="2" class="w-full border rounded-lg px-3 py-2">{{ old('alamat_restoran', $owner->alamat_restoran) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#9D3935]">Summary</label>
                    <textarea name="summary" rows="2" class="w-full border rounded-lg px-3 py-2">{{ old('summary', $owner->summary) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#9D3935]">Lokasi Restoran (Link Google Maps)</label>
                    <input type="text" name="lokasi_restoran"
                        value="{{ old('lokasi_restoran', $owner->lokasi_restoran) }}"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#9D3935]">Nomor Induk Berusaha (NIB)</label>
                    <input type="text" name="nib" value="{{ old('nib', $owner->nib) }}"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <button type="submit" class="px-4 py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700 transition">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <div x-data="{ openModal: false }" x-show="activeTab === 'menu'" x-cloak class="space-y-6">
            @if ($menuUnggulan->isEmpty())
                <div class="text-center py-10 text-gray-500">
                    <p>Belum ada menu unggulan yang ditambahkan.</p>
                    <button @click="openModal = true"
                        class="mt-4 px-4 py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700">
                        Tambah Menu Unggulan
                    </button>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($menuUnggulan as $unggulan)
                        <div
                            class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden group flex flex-col justify-between">

                            <div class="relative w-full aspect-[4/3] overflow-hidden">
                                <img src="{{ asset('storage/' . $unggulan->menu->foto) }}"
                                    alt="{{ $unggulan->menu->nama }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">

                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-center p-4 z-10">
                                    <p class="text-white text-sm leading-snug">
                                        {{ $unggulan->menu->deskripsi ?? 'Tidak ada deskripsi.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-4 flex-1 flex flex-col">
                                <h4 class="font-semibold text-gray-800 mb-2 text-center">
                                    {{ $unggulan->menu->nama ?? 'Menu Tidak Ditemukan' }}
                                </h4>

                                <form action="{{ route('owner.restoran.unggulan.destroy') }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus menu unggulan ini?')" class="mt-auto">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $unggulan->id }}">
                                    <button type="submit"
                                        class="w-full py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                        Hapus Menu
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center my-12">
                    <button @click="openModal = true" class="px-4 py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700">
                        Tambah Menu Unggulan
                    </button>
                </div>
            @endif

            <div x-show="openModal" x-cloak
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div @click.away="openModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Tambah Menu Unggulan</h3>
                    <form action="{{ route('owner.restoran.unggulan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $owner->id }}">

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Pilih Menu</label>
                            <select name="menu_id" required
                                class="w-full border rounded-lg p-2 focus:ring-red-500 focus:border-red-500">
                                <option value="">-- Pilih Menu --</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" @click="openModal = false"
                                class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'operasional'" x-cloak class="space-y-8">
            <form method="POST" action="{{ route('owner.restoran.operational.store') }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Jam Operasional --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[#9D3935]">Jam Buka</label>
                        <input type="time" name="jam_buka"
                            value="{{ old('jam_buka', $operational->first()->jam_buka ?? '') }}"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9D3935]">Jam Tutup</label>
                        <input type="time" name="jam_tutup"
                            value="{{ old('jam_tutup', $operational->first()->jam_tutup ?? '') }}"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                {{-- Area Pilihan --}}
                <div>
                    <label class="block text-sm font-medium text-[#9D3935] mb-2">Area</label>
                    @php
                        $selectedAreas = old('area', $operational->first()->area ?? []);
                        $areaOptions = ['Indoor', 'Outdoor', 'Semi Outdoor'];
                    @endphp
                    <div class="flex flex-wrap gap-4">
                        @foreach ($areaOptions as $area)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="area[]" value="{{ $area }}"
                                    @checked(in_array($area, $selectedAreas))
                                    class="rounded border-gray-300 text-[#9D3935] focus:ring-red-500">
                                <span>{{ $area }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Kategori Layanan --}}
                <div>
                    <label class="block text-sm font-medium text-[#9D3935] mb-2">Kategori Layanan</label>
                    @php
                        $selectedKategori = old('kategori_layanan', $operational->first()->kategori_layanan ?? []);
                        $kategoriOptions = ['Dine In', 'Take Away', 'Delivery', 'Reservasi', 'Catering'];
                    @endphp
                    <div class="flex flex-wrap gap-4">
                        @foreach ($kategoriOptions as $kategori)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="kategori_layanan[]" value="{{ $kategori }}"
                                    @checked(in_array($kategori, $selectedKategori))
                                    class="rounded border-gray-300 text-[#9D3935] focus:ring-red-500">
                                <span>{{ $kategori }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="pt-4">
                    <button type="submit" class="px-5 py-2 bg-[#9D3935] text-white rounded-lg hover:bg-red-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div x-show="activeTab === 'ulasan'" x-cloak class="space-y-6">
            <div class="space-y-3">
                @forelse($reviews as $review)
                    <div class="flex items-start bg-gray-50 p-3 rounded-lg">
                        <img src="{{ $review->user->avatar ?? 'https://cdn-icons-png.flaticon.com/512/2922/2922506.png' }}"
                            class="w-10 h-10 rounded-full mr-3" alt="{{ $review->user->name ?? 'User' }}">

                        <div class="flex-1">
                            <p class="font-medium">{{ $review->user->name ?? 'Anonymous' }}</p>
                            <p class="text-gray-600 text-sm mt-1">{{ $review->comment }}</p>
                        </div>

                        <div class="text-yellow-500 text-sm flex items-center gap-1">
                            <i class="fa-solid fa-star"></i>
                            <span>{{ number_format($review->rating, 1) }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center">Belum ada ulasan untuk restoran Anda.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
