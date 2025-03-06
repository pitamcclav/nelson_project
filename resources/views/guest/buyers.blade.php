@extends('layouts.guest')

@section('title', 'For Buyers')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Buy Fresh Farm Produce</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Get access to high-quality agricultural products directly from local farmers at competitive prices.</p>
    </div>

    <!-- How It Works -->
    <div class="mb-16">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-2xl text-emerald-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Browse Products</h3>
                <p class="text-gray-600">Explore our marketplace filled with fresh produce from local farmers.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-2xl text-emerald-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Place Order</h3>
                <p class="text-gray-600">Select your items, specify quantities, and proceed to checkout.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-truck text-2xl text-emerald-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Get Delivery</h3>
                <p class="text-gray-600">Receive your fresh produce right at your doorstep.</p>
            </div>
        </div>
    </div>

    <!-- Benefits -->
    <div class="bg-gray-50 rounded-lg p-8 mb-16">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Why Buy From AgriLink?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-start">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-leaf text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Fresh & Direct</h3>
                    <p class="text-gray-600">Get farm-fresh produce directly from local farmers, ensuring the highest quality.</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-hand-holding-dollar text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Competitive Prices</h3>
                    <p class="text-gray-600">Fair prices for both buyers and farmers with no middlemen markups.</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-shield-check text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Quality Assured</h3>
                    <p class="text-gray-600">All products are verified and quality-checked before delivery.</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Convenient Shopping</h3>
                    <p class="text-gray-600">Shop anytime, anywhere with our easy-to-use platform.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Ready to Start Shopping?</h2>
        <p class="text-gray-600 mb-6">Browse our marketplace for fresh, quality produce from local farmers.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('guest.marketplace') }}" class="bg-emerald-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-emerald-800 transition-colors">
                Visit Marketplace
            </a>
            <a href="{{ route('register') }}" class="bg-yellow-400 text-emerald-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-500 transition-colors">
                Create Account
            </a>
        </div>
    </div>
</div>
@endsection