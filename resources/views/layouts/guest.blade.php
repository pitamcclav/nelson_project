<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'AgriLink') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="fixed top-0 left-0 w-full bg-emerald-700 shadow-md z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-2xl font-bold text-white">
                Agri<span class="text-yellow-400">Link</span>
            </div>
            
            <div class="flex-1 px-8">
                <form action="{{ route('guest.search') }}" method="GET" class="w-full">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                        <input type="text" name="query" placeholder="Search for fresh produce..." 
                            value="{{ request('query') }}"
                            class="w-full max-w-md pl-10 pr-12 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-emerald-700 hover:text-emerald-800 bg-yellow-400 p-2 rounded-full transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex items-center gap-6">
                <!-- Cart Icon -->
                <a href="{{ route('guest.cart') }}" class="text-white hover:text-yellow-400 transition-colors relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-yellow-400 text-emerald-900 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- Toll-free line -->
                <div class="flex items-center gap-2 text-white">
                    <i class="fas fa-phone-alt text-yellow-400"></i>
                    <span class="font-medium">Toll-free: 0800 100 200</span>
                </div>

                <div class="flex gap-4">
                    <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-linkedin"></i></a>
                </div>
                <a href="{{ route('login') }}" class="bg-yellow-400 text-emerald-700 px-6 py-2 rounded-full font-bold hover:bg-emerald-700 hover:text-white transition-colors">Login</a>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-yellow-500 mt-16">
        <div class="container mx-auto">
            <ul class="flex justify-center py-3 space-x-8">
                <li><a href="{{ route('guest.home') }}" class="text-white hover:text-emerald-900">Home</a></li>
                <li><a href="{{ route('guest.marketplace') }}" class="text-white hover:text-emerald-900">Marketplace</a></li>
                {{-- <li><a href="{{ route('guest.farmers') }}" class="text-white hover:text-emerald-900">Farmers</a></li> --}}
                <li><a href="{{ route('guest.buyers') }}" class="text-white hover:text-emerald-900">Buyers</a></li>
                <li><a href="{{ route('guest.contact') }}" class="text-white hover:text-emerald-900">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @include('components.newsletter')
    @include('components.footer')

    @stack('scripts')
</body>
</html>