@extends('layouts.guest')

@section('title', 'Our Farmers')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Meet Our Local Farmers</h1>
    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Connect directly with experienced farmers who are passionate about bringing you the freshest produce straight from their farms.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($farmers as $farmer)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/' . ($farmer->avatar ?? 'default-avatar.jpg')) }}" alt="{{ $farmer->name }}" 
                         class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $farmer->name }}</h2>
                        <p class="text-emerald-600">{{ $farmer->products->count() }} Products</p>
                    </div>
                </div>

                <div class="text-gray-600 mb-4">
                    <p>{{ $farmer->bio ?? 'Experienced farmer providing quality agricultural products.' }}</p>
                </div>

                @if($farmer->products->count() > 0)
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Available Products:</h3>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($farmer->products->take(4) as $product)
                        <a href="{{ route('guest.product-detail', $product->id) }}" 
                           class="flex items-center p-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                            <img src="{{ asset('images/' . ($product->image ?? 'default-product.jpg')) }}" 
                                 alt="{{ $product->name }}" class="w-10 h-10 rounded object-cover">
                            <div class="ml-2">
                                <p class="text-sm font-medium text-gray-800">{{ $product->name }}</p>
                                <p class="text-xs text-emerald-600">UGX {{ number_format($product->price, 2) }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @if($farmer->products->count() > 4)
                    <a href="{{ route('guest.marketplace', ['farmer' => $farmer->id]) }}" 
                       class="text-yellow-500 hover:text-yellow-600 text-sm font-semibold mt-2 inline-block">
                        View All Products →
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $farmers->links() }}
    </div>

    <!-- Join as Farmer CTA -->
    <div class="mt-16 bg-emerald-700 text-white rounded-lg p-8 text-center">
        <h2 class="text-2xl font-bold mb-4">Are You a Farmer?</h2>
        <p class="mb-6">Join our marketplace and connect with buyers looking for quality farm produce.</p>
        <a href="{{ route('register') }}?type=seller" 
           class="inline-block bg-yellow-400 text-emerald-900 px-8 py-3 rounded-full font-bold hover:bg-yellow-500 transition-colors">
            Register as a Seller
        </a>
    </div>
</div>
@endsection