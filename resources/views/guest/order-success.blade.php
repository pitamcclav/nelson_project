@extends('layouts.guest')

@section('title', 'Order Confirmed')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <div class="max-w-3xl mx-auto">
        <!-- Success Message -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8 text-center">
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-4xl text-emerald-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Thank You for Your Order!</h1>
            <p class="text-gray-600 mb-4">Your order has been placed successfully. Order details have been sent to your email.</p>
            <div class="text-lg font-semibold text-emerald-700 mb-6">
                Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}
            </div>
            <div class="flex justify-center gap-4">
                <a href="{{ route('guest.marketplace') }}" 
                   class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg transition-colors">
                    Continue Shopping
                </a>
            </div>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Order Details</h2>
            </div>

            <!-- Order Items -->
            <div class="divide-y divide-gray-200">
                @foreach($order->items as $item)
                <div class="p-6 flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-800">{{ $item->product_name }}</h3>
                        <p class="text-gray-600">
                            {{ $item->quantity }} × KES {{ number_format($item->unit_price, 2) }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-medium text-emerald-700">
                            KES {{ number_format($item->subtotal, 2) }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="bg-gray-50 p-6">
                <div class="space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>KES {{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span>KES {{ number_format($order->shipping_fee, 2) }}</span>
                    </div>
                    <div class="h-px bg-gray-200 my-4"></div>
                    <div class="flex justify-between text-lg font-bold text-emerald-700">
                        <span>Total</span>
                        <span>KES {{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delivery Information -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Delivery Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium text-gray-700 mb-2">Contact Details</h3>
                    <div class="space-y-1 text-gray-600">
                        <p>{{ $order->guest_name }}</p>
                        <p>{{ $order->guest_email }}</p>
                        <p>{{ $order->guest_phone }}</p>
                    </div>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700 mb-2">Delivery Address</h3>
                    <div class="space-y-1 text-gray-600">
                        <p>{{ $order->delivery_address }}</p>
                        <p>{{ $order->delivery_city }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Status</h2>
            <div class="flex items-center">
                <div class="relative w-full">
                    @php
                        $statuses = ['pending', 'processing', 'confirmed', 'shipped', 'delivered'];
                        $currentIndex = array_search($order->status, $statuses);
                        $progressWidth = ($currentIndex / (count($statuses) - 1)) * 100;
                    @endphp
                    <div class="h-2 bg-gray-200 rounded-full">
                        <div class="h-2 bg-emerald-500 rounded-full" style="width: {{ $progressWidth }}%"></div>
                    </div>
                    <div class="absolute top-0 left-0 -translate-y-8 w-full flex justify-between">
                        @foreach($statuses as $index => $status)
                            <div class="text-center {{ $index <= $currentIndex ? 'text-emerald-600' : 'text-gray-400' }}">
                                <i class="fas fa-circle text-sm"></i>
                                <div class="text-xs mt-1 capitalize">{{ $status }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-8 text-center">
            <p class="text-gray-600">Need help? Contact our support team:</p>
            <div class="mt-2">
                <a href="{{ route('guest.contact') }}" class="text-emerald-600 hover:text-emerald-700">
                    <i class="fas fa-headset mr-1"></i> Contact Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection