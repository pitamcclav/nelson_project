@extends('layouts.guest')

@section('title', 'Marketplace')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            @if(request('query'))
                Search Results for "{{ request('query') }}"
            @else
                Marketplace
            @endif
        </h1>
        
        <!-- Search Form -->
        <form action="{{ route('guest.search') }}" method="GET" class="w-full max-w-md">
            <div class="relative">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" name="query" 
                       placeholder="Search products..." 
                       value="{{ request('query') }}"
                       class="w-full pl-10 pr-12 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-emerald-700 text-white p-2 rounded-lg hover:bg-emerald-800 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filters -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 lg:sticky lg:top-[calc(64px+48px+40px+2rem)] transition-all duration-300">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Filters</h2>
                
                <!-- Category Filter -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-700 mb-2">Categories</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="category[]" value="vegetables" class="rounded text-emerald-600">
                            <span class="ml-2 text-gray-600">Vegetables</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="category[]" value="fruits" class="rounded text-emerald-600">
                            <span class="ml-2 text-gray-600">Fruits</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="category[]" value="cereals" class="rounded text-emerald-600">
                            <span class="ml-2 text-gray-600">Cereals</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="category[]" value="dairy" class="rounded text-emerald-600">
                            <span class="ml-2 text-gray-600">Dairy Products</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-700 mb-2">Price Range</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-600">Min Price (UGX)</label>
                            <input type="number" name="min_price" min="0" 
                                   class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Max Price (UGX)</label>
                            <input type="number" name="max_price" min="0"
                                   class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                    </div>
                </div>

                <!-- Sort By -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-700 mb-2">Sort By</h3>
                    <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="latest">Latest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="popularity">Popularity</option>
                    </select>
                </div>

                <button type="button" id="applyFilters"
                        class="w-full bg-emerald-700 text-white px-4 py-2 rounded-md hover:bg-emerald-800 transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            <!-- Sort Bar -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-6 flex items-center justify-between">
                <div class="text-gray-600">
                    Showing <span class="font-medium">{{ $products->firstItem() ?? 0 }}</span> - 
                    <span class="font-medium">{{ $products->lastItem() ?? 0 }}</span> of 
                    <span class="font-medium">{{ $products->total() }}</span> products
                </div>
                <div class="flex items-center gap-4">
                    <label class="text-sm text-gray-600">View:</label>
                    <button type="button" class="text-emerald-600 hover:text-emerald-700" data-view="grid">
                        <i class="fas fa-grid-2 text-lg"></i>
                    </button>
                    <button type="button" class="text-gray-400 hover:text-emerald-700" data-view="list">
                        <i class="fas fa-list text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Products -->
            @if($products->isEmpty())
                <div class="col-span-3 text-center py-12">
                    <div class="text-gray-500 mb-4">
                        <i class="fas fa-search text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No products found</h3>
                    @if(request('query'))
                        <p class="text-gray-600 mb-6">No products match your search "{{ request('query') }}"</p>
                    @else
                        <p class="text-gray-600 mb-6">Try adjusting your filters or search terms</p>
                    @endif
                    <a href="{{ route('guest.marketplace') }}" 
                       class="inline-block bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                        Clear All Filters
                    </a>
                </div>
            @else
                <div class="col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <a href="{{ route('guest.product-detail', $product) }}">
                            <img src="{{ asset('images/' . ($product->image ?? 'default-product.jpg')) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-2">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between">
                                    <p class="text-emerald-700 font-bold">UGX {{ number_format($product->price, 2) }} / {{ $product->unit }}</p>
                                    <p class="text-sm text-gray-500">Stock: {{ $product->quantity }}</p>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= ($product->rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span class="ml-1 text-sm text-gray-500">({{ $product->reviews_count ?? 0 }})</span>
                                    </div>
                                    <button type="button" class="text-emerald-700 hover:text-emerald-800 add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="fas fa-cart-plus text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            
            try {
                const response = await fetch(`{{ url('guest/cart/add') }}/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: 1,
                        action: 'cart'
                    })
                });
                
                if (!response.ok) throw new Error('Failed to add item to cart');
                
                // Reload page to update cart count in header
                window.location.reload();
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });

    // Filter functionality
    const applyFiltersButton = document.getElementById('applyFilters');
    const categoryCheckboxes = document.querySelectorAll('input[name="category[]"]');
    const minPriceInput = document.querySelector('input[name="min_price"]');
    const maxPriceInput = document.querySelector('input[name="max_price"]');
    const sortSelect = document.querySelector('select[name="sort"]');

    // Set initial values from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Set category checkboxes
    const categories = urlParams.getAll('category[]');
    categoryCheckboxes.forEach(checkbox => {
        if (categories.includes(checkbox.value)) {
            checkbox.checked = true;
        }
    });

    // Set price range
    if (urlParams.has('min_price')) {
        minPriceInput.value = urlParams.get('min_price');
    }
    if (urlParams.has('max_price')) {
        maxPriceInput.value = urlParams.get('max_price');
    }

    // Set sort option
    if (urlParams.has('sort')) {
        sortSelect.value = urlParams.get('sort');
    }

    // Handle filter application
    applyFiltersButton.addEventListener('click', function() {
        const params = new URLSearchParams();

        // Add search query if exists
        const searchQuery = urlParams.get('query');
        if (searchQuery) {
            params.append('query', searchQuery);
        }

        // Add categories
        categoryCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                params.append('category[]', checkbox.value);
            }
        });

        // Add price range
        if (minPriceInput.value) {
            params.append('min_price', minPriceInput.value);
        }
        if (maxPriceInput.value) {
            params.append('max_price', maxPriceInput.value);
        }

        // Add sort option
        if (sortSelect.value) {
            params.append('sort', sortSelect.value);
        }

        // Redirect with filters
        window.location.href = `${window.location.pathname}?${params.toString()}`;
    });
});
</script>
@endpush
@endsection