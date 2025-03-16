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
        <!-- Upper Header - Hide on mobile -->
        <div class="hidden md:block border-b border-emerald-600">
            <div class="container mx-auto px-4 py-2">
                <div class="flex justify-end items-center gap-4 text-sm">
                    <div class="flex items-center gap-2 text-white">
                        <i class="fas fa-phone-alt text-yellow-400"></i>
                        <span class="font-medium">Toll-free: 0800 100 200</span>
                    </div>
                    <div class="flex gap-4 items-center border-l border-emerald-600 pl-4">
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-col md:flex-row items-center gap-4 md:gap-8">
                <!-- Logo -->
                <div class="flex w-full md:w-auto justify-between items-center">
                    <a href="{{ route('guest.home') }}" class="text-2xl font-bold text-white shrink-0">
                        Agri<span class="text-yellow-400">Link</span>
                    </a>
                    <!-- Mobile Only Buttons -->
                    <div class="flex items-center gap-4 md:hidden">
                        <a href="{{ route('guest.cart') }}" class="text-white hover:text-yellow-400 relative">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-yellow-400 text-emerald-900 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                        <button type="button" class="text-white hover:text-yellow-400" onclick="toggleMobileSearch()">
                            <i class="fas fa-search text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Search Bar - Hidden on mobile by default -->
                <div id="searchContainer" class="hidden md:block w-full md:max-w-2xl">
                    <form action="{{ route('guest.search') }}" method="GET" class="w-full">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="query" 
                                   placeholder="Search for fresh produce, vegetables, fruits..." 
                                   value="{{ request('query') }}"
                                   class="w-full pl-11 pr-4 py-2.5 bg-white rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                   autocomplete="off">
                            <button type="submit" class="absolute inset-y-0 right-0 px-4 text-gray-500 hover:text-emerald-700">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Elements - Hidden on mobile -->
                <div class="hidden md:flex items-center gap-6 ml-auto">
                    <a href="{{ route('guest.cart') }}" class="text-white hover:text-yellow-400 transition-colors relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-yellow-400 text-emerald-900 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('login') }}" class="bg-yellow-400 text-emerald-700 px-6 py-2 rounded-lg font-bold hover:bg-yellow-500 transition-colors flex items-center gap-2">
                        <i class="fas fa-user"></i>
                        <span>Login</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Search - Hidden by default -->
            <div id="mobileSearch" class="md:hidden mt-3 hidden">
                <form action="{{ route('guest.search') }}" method="GET" class="w-full">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="query" 
                               placeholder="Search products..." 
                               value="{{ request('query') }}"
                               class="w-full pl-11 pr-4 py-2.5 bg-white rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                               autocomplete="off">
                        <button type="submit" class="absolute inset-y-0 right-0 px-4 text-gray-500 hover:text-emerald-700">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="bg-yellow-500">
            <div class="container mx-auto px-4">
                <ul class="flex flex-wrap justify-center py-3 gap-x-8 gap-y-2">
                    <li><a href="{{ route('guest.home') }}" class="text-white hover:text-emerald-900 whitespace-nowrap">Home</a></li>
                    <li><a href="{{ route('guest.marketplace') }}" class="text-white hover:text-emerald-900 whitespace-nowrap">Marketplace</a></li>
                    <li><a href="{{ route('guest.buyers') }}" class="text-white hover:text-emerald-900 whitespace-nowrap">Buyers</a></li>
                    <li><a href="{{ route('guest.contact') }}" class="text-white hover:text-emerald-900 whitespace-nowrap">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Mobile Login Button - Fixed at bottom -->
    <div class="fixed bottom-0 left-0 right-0 md:hidden bg-white shadow-lg border-t border-gray-200 p-4 z-50">
        <a href="{{ route('login') }}" class="bg-yellow-400 text-emerald-700 py-3 rounded-lg font-bold hover:bg-yellow-500 transition-colors flex items-center justify-center gap-2 w-full">
            <i class="fas fa-user"></i>
            <span>Login</span>
        </a>
    </div>

    <!-- Main Content Wrapper -->
    <div class="pt-[calc(64px+48px)] md:pt-[calc(64px+48px+40px)]"> <!-- Adjust these values based on your header height -->
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        @include('components.newsletter')
        @include('components.footer')
    </div>

    @stack('scripts')

    @push('scripts')
    <script>
        function toggleMobileSearch() {
            const mobileSearch = document.getElementById('mobileSearch');
            mobileSearch.classList.toggle('hidden');
            if (!mobileSearch.classList.contains('hidden')) {
                mobileSearch.querySelector('input').focus();
            }
        }
    </script>
    @endpush
</body>
</html>