<div class="relative search-container">
    <div class="flex items-center bg-gray-100 rounded-full px-3 py-2 cursor-pointer transition-all duration-300">
        <i class="fas fa-search text-gray-600 text-lg"></i>
        <input 
            type="text" 
            placeholder="{{ $placeholder ?? 'Cari...' }}" 
            class="ml-2 bg-transparent outline-none text-sm text-gray-700 w-0 opacity-0 transition-all duration-300"
            style="width: 0; opacity: 0;"
        >
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchContainer = document.querySelector('.search-container');
    const searchInput = searchContainer.querySelector('input');

    searchContainer.addEventListener('click', function(e) {
        e.stopPropagation();
        if (!this.classList.contains('expanded')) {
            this.classList.add('expanded');
            searchInput.style.width = '120px';
            searchInput.style.opacity = '1';
            searchInput.focus();
        }
    });

    document.addEventListener('click', function(e) {
        if (!searchContainer.contains(e.target)) {
            searchContainer.classList.remove('expanded');
            searchInput.style.width = '0';
            searchInput.style.opacity = '0';
        }
    });

    searchInput.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
@endpush
