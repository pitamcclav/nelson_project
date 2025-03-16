@extends('layouts.guest')

@section('title', 'Digital Marketplace')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-24 bg-emerald-700">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('images/backg.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
        </div>
        <div class="relative container mx-auto px-6 text-center text-white">
            <h1 class="text-5xl font-bold mb-6">Fresh Farm Produce at Your Fingertips</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Connect directly with local farmers and access fresh, high-quality agricultural products at competitive prices.</p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('guest.marketplace') }}" class="bg-yellow-400 text-emerald-900 px-8 py-3 rounded-full font-bold hover:bg-yellow-500 transition-colors">
                    Start Shopping
                </a>
                <a href="{{ route('register') }}?type=seller" class="bg-white text-emerald-700 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-colors">
                    Become a Seller
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Featured Products</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                    <img src="{{ asset('images/' . ($product->image ?? 'default-product.jpg')) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-emerald-700 font-bold mt-1">UGX {{ number_format($product->price, 2) }} / {{ $product->unit }}</p>
                        <a href="{{ route('guest.product-detail', $product->id) }}" class="text-yellow-500 hover:text-yellow-600 text-sm font-semibold mt-2 inline-block">View Details →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
