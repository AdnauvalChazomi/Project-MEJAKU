@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Beri Review untuk Toko {{ $owner->nama_restoran }}</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!$userReview)
            <form action="{{ route('user.restoran.review.store', $owner->id) }}" method="POST"
                class="bg-white p-6 rounded-lg shadow-md">
                @csrf

                <div class="mb-6">
                    <label class="block font-medium mb-2">Rating</label>
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                                class="hidden" {{ old('rating') == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}"
                                class="cursor-pointer text-gray-300 text-3xl hover:text-yellow-400 transition-colors duration-200">
                                ★
                            </label>
                        @endfor
                    </div>
                </div>

                <div class="mb-6">
                    <label for="comment" class="block font-medium mb-2">Komentar (opsional)</label>
                    <textarea name="comment" id="comment" rows="4"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#9D3935] focus:border-red-500 transition duration-150"
                        placeholder="Tulis pengalaman Anda...">{{ old('comment') }}</textarea>
                </div>

                <button type="submit"
                    class="w-full bg-[#9D3935] hover:bg-red-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                    Kirim Review
                </button>
            </form>
        @else
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-lg text-center mb-6">
                <h3 class="font-bold text-lg">Terima kasih telah memberikan review 🙌</h3>
                <p class="text-green-700 text-sm">Anda sudah memberikan review untuk restoran ini.</p>
            </div>
        @endif


        <div class="mt-8">

            @php
                $reviews = \App\Models\Review::where('owner_id', $owner->id)->latest()->with('user')->get();
            @endphp

            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Ulasan untuk {{ $owner->nama_restoran }}</h3>

                @forelse($reviews as $review)
                    <div class="bg-gray-50 p-4 rounded-lg mb-4 shadow-sm flex space-x-4">

                        <img src="{{ $review->user->avatar ?? 'https://cdn-icons-png.flaticon.com/512/2922/2922506.png' }}"
                            class="w-12 h-12 rounded-full" alt="{{ $review->user->name ?? 'User' }}">

                        <div class="flex-1 flex flex-col">

                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold">{{ $review->user->name ?? 'Anonymous' }}</span>
                                <span class="text-yellow-500 text-sm">
                                    <i class="fa-solid fa-star"></i> {{ $review->rating }}
                                </span>
                            </div>

                            <p class="text-gray-700">{{ $review->comment ?? '-' }}</p>

                            <div class="flex justify-between items-end">

                                <p class="text-gray-400 text-xs">
                                    {{ $review->created_at?->format('d M Y') ?? 'Tanggal tidak tersedia' }}
                                </p>

                                @if ($review->user_id === auth()->id())
                                    <form action="{{ route('user.restoran.review.destroy', $review->id) }}" method="POST"
                                        class="delete-review-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="text-red-600 hover:text-red-800 text-xs font-medium delete-review-btn">
                                            Hapus Review
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center">Belum ada ulasan untuk restoran ini.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('label[for^="star"]');
        const radios = document.querySelectorAll('input[name="rating"]');

        function updateStars() {
            const checkedValue = document.querySelector('input[name="rating"]:checked')?.value;
            stars.forEach(star => {
                const starValue = star.htmlFor.replace('star', '');
                if (checkedValue) {
                    star.classList.toggle('text-yellow-400', starValue <= checkedValue);
                } else {
                    star.classList.remove('text-yellow-400');
                }
            });
        }

        stars.forEach(star => {
            star.addEventListener('mouseover', () => {
                const hoverValue = star.htmlFor.replace('star', '');
                stars.forEach(s => {
                    const sValue = s.htmlFor.replace('star', '');
                    s.classList.toggle('text-yellow-400', sValue <= hoverValue);
                });
            });

            star.addEventListener('mouseout', () => {
                updateStars();
            });
        });

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                updateStars();
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            updateStars();
        });
    </script>

    <script>
        document.querySelectorAll('.delete-review-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.delete-review-form');

                Swal.fire({
                    title: 'Hapus Review?',
                    text: "Yakin ingin menghapus Review?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>


@endsection
