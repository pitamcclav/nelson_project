@extends('layouts.guest')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Your Shopping Cart</h1>
    
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if(count($cart) > 0)
            <!-- Cart Items Table -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="cart-items">
                    @foreach($cart as $id => $item)
                        <tr class="cart-item" data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        <img class="h-16 w-16 rounded-md object-cover" 
                                             src="{{ asset('images/' . $item['image']) }}" 
                                             alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item['name'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">UGX {{ number_format($item['price'], 2) }} / {{ $item['unit'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center border border-gray-300 rounded-md w-24">
                                    <button class="px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200 decrement-btn">-</button>
                                    <input type="number" value="{{ $item['quantity'] }}" min="1" 
                                           class="w-8 py-1 text-center border-none focus:outline-none text-gray-700 quantity-input">
                                    <button class="px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200 increment-btn">+</button>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-emerald-700 item-total">
                                UGX {{ number_format($item['price'] * $item['quantity'], 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-red-500 hover:text-red-700 remove-item">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Cart Summary -->
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                    <!-- Cart Total -->
                    <div class="mb-6 md:mb-0">
                        <div class="text-gray-700">Subtotal: <span class="font-bold" id="subtotal">UGX {{ number_format($total, 2) }}</span></div>
                        <div class="text-gray-700">Shipping: <span class="font-bold" id="shipping">UGX {{ number_format($shipping, 2) }}</span></div>
                        <div class="text-lg font-bold text-emerald-700 mt-2">Total: <span id="total">UGX {{ number_format($total + $shipping, 2) }}</span></div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('guest.marketplace') }}" 
                           class="inline-block text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-colors">
                            Continue Shopping
                        </a>
                        <a href="{{ route('guest.checkout') }}" 
                           class="inline-block text-center bg-yellow-400 hover:bg-yellow-500 text-emerald-900 font-bold py-3 px-10 rounded-lg transition-colors">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty cart message -->
            <div class="p-8 text-center">
                <div class="text-gray-500 mb-4">
                    <i class="fas fa-shopping-cart text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Your cart is empty</h3>
                <p class="text-gray-600 mb-6">Browse our products and discover premium quality farm produce</p>
                <a href="{{ route('guest.marketplace') }}" 
                   class="inline-block bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateQuantity = async (id, quantity) => {
        try {
            const response = await fetch('{{ route("guest.cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ id, quantity })
            });
            
            if (!response.ok) throw new Error('Failed to update cart');
            
            updateCartTotals();
        } catch (error) {
            console.error('Error:', error);
        }
    };

    const removeItem = async (id, row) => {
        try {
            console.log('Removing item with ID:', id); // Debug log
            const response = await fetch('{{ route("guest.cart.remove") }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ id })
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to remove item');
            }
            
            const result = await response.json();
            if (result.success) {
                row.remove();
                updateCartTotals();
                
                // Show empty cart message if no items left
                if (document.querySelectorAll('.cart-item').length === 0) {
                    location.reload();
                }
            } else {
                throw new Error('Failed to remove item from cart');
            }
        } catch (error) {
            console.error('Error removing item:', error);
            alert('Failed to remove item from cart: ' + error.message);
        }
    };

    const updateCartTotals = () => {
        let subtotal = 0;
        const rows = document.querySelectorAll('.cart-item');
        
        rows.forEach(row => {
            const price = parseFloat(row.dataset.price);
            const quantity = parseInt(row.querySelector('.quantity-input').value);
            const itemTotal = price * quantity;
            
            row.querySelector('.item-total').textContent = `UGX ${itemTotal.toFixed(2)}`;
            subtotal += itemTotal;
        });
        
        const shipping = rows.length > 0 ? 200 : 0;
        const total = subtotal + shipping;
        
        document.getElementById('subtotal').textContent = `UGX ${subtotal.toFixed(2)}`;
        document.getElementById('shipping').textContent = `UGX ${shipping.toFixed(2)}`;
        document.getElementById('total').textContent = `UGX ${total.toFixed(2)}`;
    };

    // Handle quantity changes
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('.cart-item');
            const id = row.dataset.id;
            const quantity = parseInt(this.value);
            
            if (quantity < 1) {
                this.value = 1;
                return;
            }
            
            updateQuantity(id, quantity);
        });
    });

    // Handle increment/decrement buttons
    document.querySelectorAll('.increment-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentNode.querySelector('.quantity-input');
            input.value = parseInt(input.value) + 1;
            input.dispatchEvent(new Event('change'));
        });
    });

    document.querySelectorAll('.decrement-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentNode.querySelector('.quantity-input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });

    // Handle remove item
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('.cart-item');
            const id = row.dataset.id;
            
            if (confirm('Are you sure you want to remove this item?')) {
                removeItem(id, row);
            }
        });
    });
});
</script>
@endpush
@endsection