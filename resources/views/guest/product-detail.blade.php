@extends('layouts.guest')

@section('title', $product->name)

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Product Images -->
        <div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/' . ($product->image ?? 'default-product.jpg')) }}" 
                     alt="{{ $product->name }}"
                     class="w-full h-96 object-cover">
            </div>
        </div>

        <!-- Product Info -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
            
            <!-- Rating -->
            <div class="flex items-center mb-4">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= ($product->reviews_avg_rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                @endfor
                <span class="ml-2 text-gray-600">({{ $product->reviews_count ?? 0 }} reviews)</span>
            </div>

            <!-- Price -->
            <div class="text-2xl font-bold text-emerald-700 mb-4">
                UGX {{ number_format($product->price, 2) }} / {{ $product->unit }}
            </div>

            <!-- Stock Status -->
            <div class="mb-6">
                <span class="text-gray-600">Availability:</span>
                @if($product->quantity > 0)
                    <span class="text-emerald-600 font-medium">In Stock ({{ $product->quantity }} {{ Str::plural($product->unit, $product->quantity) }})</span>
                @else
                    <span class="text-red-600 font-medium">Out of Stock</span>
                @endif
            </div>

            <!-- Description -->
            <div class="prose max-w-none mb-8">
                <p class="text-gray-600">{{ $product->description }}</p>
            </div>

            <!-- Add to Cart Form -->
            @if($product->quantity > 0)
                <form action="{{ route('guest.cart.add', $product) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="flex items-center gap-4 mb-4">
                        <label class="text-gray-700">Quantity:</label>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200" id="decrement">-</button>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}"
                                   class="w-16 py-1 text-center border-none focus:outline-none" id="quantity">
                            <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200" id="increment">+</button>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" name="action" value="cart"
                                class="flex-1 bg-emerald-700 text-white px-6 py-3 rounded-lg font-bold hover:bg-emerald-800 transition-colors">
                            Add to Cart
                        </button>
                        <button type="submit" name="action" value="buy"
                                class="flex-1 bg-yellow-400 text-emerald-900 px-6 py-3 rounded-lg font-bold hover:bg-yellow-500 transition-colors">
                            Buy Now
                        </button>
                    </div>
                </form>
            @endif

            <!-- Seller Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800 mb-2">Seller Information</h3>
                <div class="flex items-center">
                    <img src="https://avatar.iran.liara.run/public"
                         alt="{{ $product->seller->name }}"
                         class="w-12 h-12 rounded-full object-cover">
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">{{ $product->seller->name }}</p>
                        <p class="text-sm text-gray-600">Member since {{ $product->seller->created_at->format('F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="mt-12">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex">
                <button class="tab-button text-emerald-600 border-emerald-600 whitespace-nowrap py-4 px-8 border-b-2 font-medium" data-tab="details">
                    Product Details
                </button>
                <button class="tab-button text-gray-500 border-transparent whitespace-nowrap py-4 px-8 border-b-2 font-medium" data-tab="reviews">
                    Reviews ({{ $product->reviews_count ?? 0 }})
                </button>
            </nav>
        </div>

        <!-- Tab Contents -->
        <div class="py-8">
            <!-- Product Details Tab -->
            <div id="details-content" class="tab-content">
                <div class="prose max-w-none">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Product Specifications</h3>
                    <table class="min-w-full">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="py-3 text-gray-600">Category</td>
                                <td class="py-3 font-medium text-gray-800">{{ ucfirst($product->category) }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-gray-600">Unit</td>
                                <td class="py-3 font-medium text-gray-800">{{ $product->unit }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-gray-600">Minimum Order</td>
                                <td class="py-3 font-medium text-gray-800">1 {{ $product->unit }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-gray-600">Storage</td>
                                <td class="py-3 font-medium text-gray-800">{{ $product->storage_info ?? 'Store in a cool, dry place' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews-content" class="tab-content hidden">
                <div class="space-y-8">
                    @forelse($product->reviews as $review)
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex items-start">
                                <img src="{{ asset('images/' . ($review->user->avatar ?? 'default-avatar.jpg')) }}" 
                                     alt="{{ $review->user->name }}"
                                     class="w-10 h-10 rounded-full object-cover">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $review->user->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex items-center text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mt-2 text-gray-600">{{ $review->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500">No reviews yet. Be the first to review this product!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <a href="{{ route('guest.product-detail', $related) }}">
                            <img src="{{ asset('images/' . ($related->image ?? 'default-product.jpg')) }}" 
                                 alt="{{ $related->name }}"
                                 class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-2">{{ $related->name }}</h3>
                                <p class="text-emerald-700 font-bold">UGX {{ number_format($related->price, 2) }} / {{ $related->unit }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity input handling
    const quantityInput = document.getElementById('quantity');
    const decrementBtn = document.getElementById('decrement');
    const incrementBtn = document.getElementById('increment');
    const maxQuantity = {{ $product->quantity }};

    decrementBtn?.addEventListener('click', () => {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    incrementBtn?.addEventListener('click', () => {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue < maxQuantity) {
            quantityInput.value = currentValue + 1;
        }
    });

    quantityInput?.addEventListener('change', () => {
        let value = parseInt(quantityInput.value);
        if (value < 1) value = 1;
        if (value > maxQuantity) value = maxQuantity;
        quantityInput.value = value;
    });

    // Tab switching
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.dataset.tab;
            
            // Update button styles
            tabButtons.forEach(btn => {
                if (btn === button) {
                    btn.classList.remove('text-gray-500', 'border-transparent');
                    btn.classList.add('text-emerald-600', 'border-emerald-600');
                } else {
                    btn.classList.remove('text-emerald-600', 'border-emerald-600');
                    btn.classList.add('text-gray-500', 'border-transparent');
                }
            });
            
            // Show/hide content
            tabContents.forEach(content => {
                if (content.id === `${tab}-content`) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });
});
</script>
@endpush
@endsection