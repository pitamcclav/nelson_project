<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgriLink - Digital Marketplace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-50">
    <!-- Header Section -->
    <header class="fixed top-0 left-0 w-full bg-emerald-700 shadow-md z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-white">
                Agri<span class="text-yellow-400">Link</span>
            </div>
            
            <div class="flex-1 px-8">
                <input type="text" placeholder="Search for fresh produce..." 
                    class="w-full max-w-md px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            
            <div class="flex items-center gap-6">
                <div class="flex gap-4">
                    <a href="#" class="text-white hover:text-yellow-400 transition-colors"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white hover:text-yellow-400 transition-colors"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white hover:text-yellow-400 transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white hover:text-yellow-400 transition-colors"><i class="fab fa-linkedin"></i></a>
                </div>
                
                <a href="{{ route('login') }}" class="bg-yellow-400 text-emerald-700 px-6 py-2 rounded-full font-bold hover:bg-emerald-700 hover:text-white transition-colors">Login</a>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-yellow-500 mt-16">
        <div class="container mx-auto">
            <ul class="flex justify-center py-3 space-x-8">
                <li><a href="{{ route('guest.home') }}" class="text-white hover:text-emerald-900 transition-colors">Home</a></li>
                <li><a href="{{ route('guest.marketplace') }}" class="text-white hover:text-emerald-900 transition-colors">Marketplace</a></li>
                <li><a href="{{ route('guest.farmers') }}" class="text-white hover:text-emerald-900 transition-colors">Farmers</a></li>
                <li><a href="{{ route('guest.buyers') }}" class="text-white hover:text-emerald-900 transition-colors">Buyers</a></li>
                <li><a href="{{ route('guest.contact') }}" class="text-white hover:text-emerald-900 transition-colors">Contact</a></li>
            </ul>
        </div>
    </nav>

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

    <!-- Newsletter Section -->
    <section class="bg-yellow-500 text-emerald-900 py-10">
        <div class="container mx-auto px-6 flex flex-wrap justify-between items-end">
            <div class="flex-1 min-w-[300px] m-4">
                <h3 class="text-xl font-bold">NEW TO AGRILINK?</h3>
                <p class="mt-2">Subscribe to our newsletter to get updates on our latest offers!</p>
                <div class="flex gap-4 mt-4">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 rounded">
                    <button class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition-colors">
                        Subscribe
                    </button>
                </div>
                <div class="mt-4 text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="rounded">
                        <span>I agree to AgriLink's Privacy and Cookie Policy</span>
                    </label>
                </div>
            </div>
            <div class="flex-1 min-w-[300px] m-4">
                <h3 class="text-xl font-bold">DOWNLOAD AGRILINK FREE APP</h3>
                <p class="mt-2">Get access to exclusive offers!</p>
                <div class="flex gap-4 mt-4">
                    <a href="#"><img src="{{ asset('images/app-store.png') }}" alt="App Store" class="h-10"></a>
                    <a href="#"><img src="{{ asset('images/google-play.png') }}" alt="Google Play" class="h-10"></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-emerald-700 text-white py-6">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="text-2xl font-bold">
                Agri<span class="text-yellow-400">Link</span>
            </div>
            <ul class="flex gap-8">
                <li><a href="{{ route('guest.privacy') }}" class="hover:text-yellow-400 transition-colors">Privacy Policy</a></li>
                <li><a href="{{ route('guest.terms') }}" class="hover:text-yellow-400 transition-colors">Terms of Service</a></li>
                <li><a href="{{ route('guest.contact') }}" class="hover:text-yellow-400 transition-colors">Contact Us</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
