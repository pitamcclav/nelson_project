@extends('layouts.guest')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Summary -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>
                <div class="divide-y divide-gray-200">
                    @foreach($cart as $id => $item)
                    <div class="py-4 flex items-center">
                        <img src="{{ asset('images/' . $item['image']) }}" 
                             alt="{{ $item['name'] }}" 
                             class="w-16 h-16 rounded object-cover">
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-medium text-gray-800">{{ $item['name'] }}</h3>
                            <p class="text-gray-600">
                                {{ $item['quantity'] }} {{ $item['unit'] }}(s) × KES {{ number_format($item['price'], 2) }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-medium text-emerald-700">
                                KES {{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Delivery Information</h2>
                <form id="deliveryForm" method="POST" action="{{ route('guest.order.create') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                            <input type="text" name="city" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Address</label>
                            <textarea name="address" rows="3" required 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500"></textarea>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Method</h3>
                        <div class="space-y-4">
                            <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-emerald-500">
                                <input type="radio" name="payment_method" value="mpesa" class="text-emerald-600" checked>
                                <span class="ml-2">M-PESA</span>
                            </label>
                            <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-emerald-500">
                                <input type="radio" name="payment_method" value="card" class="text-emerald-600">
                                <span class="ml-2">Credit/Debit Card</span>
                            </label>
                            <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-emerald-500">
                                <input type="radio" name="payment_method" value="cash" class="text-emerald-600">
                                <span class="ml-2">Cash on Delivery</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Total -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Total</h2>
                <div class="space-y-3 text-gray-600">
                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span>KES {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Shipping:</span>
                        <span>KES {{ number_format($shipping, 2) }}</span>
                    </div>
                    <div class="h-px bg-gray-200 my-4"></div>
                    <div class="flex justify-between text-lg font-bold text-emerald-700">
                        <span>Total:</span>
                        <span>KES {{ number_format($total + $shipping, 2) }}</span>
                    </div>
                </div>

                <button type="submit" form="deliveryForm" 
                        class="w-full mt-8 bg-yellow-400 text-emerald-900 px-6 py-3 rounded-lg font-bold hover:bg-yellow-500 transition-colors">
                    Place Order
                </button>

                <div class="mt-6">
                    <p class="text-sm text-gray-600">
                        By placing your order, you agree to our 
                        <a href="{{ route('guest.terms') }}" class="text-emerald-600 hover:text-emerald-800">Terms of Service</a> 
                        and <a href="{{ route('guest.privacy') }}" class="text-emerald-600 hover:text-emerald-800">Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mpesaRadio = document.querySelector('input[value="mpesa"]');
    const cardRadio = document.querySelector('input[value="card"]');
    const cashRadio = document.querySelector('input[value="cash"]');
    
    const paymentForms = {
        mpesa: createMpesaForm(),
        card: createCardForm()
    };
    
    function createMpesaForm() {
        const div = document.createElement('div');
        div.id = 'mpesa-details';
        div.className = 'mt-4 p-4 bg-gray-50 rounded-lg';
        div.innerHTML = `
            <p class="text-sm text-gray-600 mb-4">
                To pay via M-PESA:
                <ol class="list-decimal ml-4 mt-2">
                    <li>Go to M-PESA on your phone</li>
                    <li>Select Pay Bill</li>
                    <li>Enter Business no: <strong>247247</strong></li>
                    <li>Enter Account no: <strong>AGRILINK</strong></li>
                    <li>Enter Amount & complete payment</li>
                </ol>
            </p>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">M-PESA Transaction Code</label>
                <input type="text" name="mpesa_code" placeholder="e.g., QWE1234XYZ" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
            </div>
        `;
        return div;
    }
    
    function createCardForm() {
        const div = document.createElement('div');
        div.id = 'card-details';
        div.className = 'mt-4 space-y-4';
        div.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                <input type="text" name="card_number" placeholder="1234 5678 9012 3456" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                    <input type="text" name="card_expiry" placeholder="MM/YY" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                    <input type="text" name="card_cvv" placeholder="123" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>
        `;
        return div;
    }
    
    function showPaymentDetails(method) {
        // Remove any existing payment forms
        Object.values(paymentForms).forEach(form => form.remove());
        
        // Add the appropriate form
        if (paymentForms[method]) {
            const container = document.querySelector('.payment-method-details');
            container.appendChild(paymentForms[method]);
        }
    }
    
    // Add payment details container
    const paymentSection = document.querySelector('.space-y-4');
    const detailsContainer = document.createElement('div');
    detailsContainer.className = 'payment-method-details';
    paymentSection.appendChild(detailsContainer);
    
    // Show initial payment form
    showPaymentDetails('mpesa');
    
    // Handle payment method changes
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            showPaymentDetails(this.value);
        });
    });
});
</script>
@endpush
@endsection