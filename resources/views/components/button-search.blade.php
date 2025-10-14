<div class="relative search-container">
    <div
        class="flex items-center bg-gray-100 px-2 py-2 cursor-pointer transition-all duration-300 border border-gray-300 hover:shadow-sm w-10 h-10 overflow-hidden rounded-lg">
        <i class="fas fa-search text-gray-600 text-lg"></i>
        <input type="text" placeholder="{{ $placeholder ?? 'Cari...' }}"
            class="ml-2 bg-transparent outline-none focus:outline-none focus:ring-0 focus:shadow-none text-sm text-gray-700 flex-shrink-0 transition-all duration-300 w-0 opacity-0" />
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchContainer = document.querySelector('.search-container');
            const wrapper = searchContainer.querySelector('div');
            const searchInput = searchContainer.querySelector('input');
            const searchIcon = searchContainer.querySelector('i');

            function expandSearch() {
                if (!searchContainer.classList.contains('expanded')) {
                    searchContainer.classList.add('expanded');
                    wrapper.style.width = '200px';
                    wrapper.style.borderRadius = '8px'; // sudut lembut, tidak bulat penuh
                    searchInput.style.width = '140px';
                    searchInput.style.opacity = '1';
                    searchInput.focus();
                }
            }

            function collapseSearch() {
                searchContainer.classList.remove('expanded');
                wrapper.style.width = '40px';
                wrapper.style.borderRadius = '8px'; // tetap lembut walau mengecil
                searchInput.style.width = '0';
                searchInput.style.opacity = '0';
                searchInput.blur();
            }

            wrapper.addEventListener('click', function (e) {
                e.stopPropagation();
                expandSearch();
            });

            searchIcon.addEventListener('click', function (e) {
                e.stopPropagation();
                expandSearch();
            });

            document.addEventListener('click', function (e) {
                if (!searchContainer.contains(e.target)) {
                    collapseSearch();
                }
            });

            searchInput.addEventListener('click', e => e.stopPropagation());
        });
    </script>
@endpush
