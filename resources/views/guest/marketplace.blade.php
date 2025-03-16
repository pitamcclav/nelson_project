@extends('layouts.guest')

@section('title', 'Marketplace')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Fresh Farm Produce</h1>
        <p class="text-xl text-gray-600">Direct from local farmers to your table</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Filters Sidebar -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
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
        <div class="lg:w-3/4">
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="products-grid">
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
});
</script>
@endpush
@endsection