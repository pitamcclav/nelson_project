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
                <input type="text" placeholder="Search for fresh produce..." 
                    class="w-full max-w-md px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400">
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

    <!-- Newsletter Section -->
    <section class="bg-yellow-500 text-emerald-900 py-10">
        <div class="container mx-auto px-4 flex flex-wrap justify-between items-end">
            <div class="flex-1 min-w-[300px] m-4">
                <h3 class="text-xl font-bold">NEW TO AGRILINK?</h3>
                <p class="mt-2">Subscribe to our newsletter to get updates on our latest offers!</p>
                <form id="newsletterForm" class="mt-4">
                    @csrf
                    <div class="flex gap-4">
                        <input type="email" name="email" placeholder="Enter your email" 
                               class="flex-1 px-4 py-2 rounded focus:ring-2 focus:ring-emerald-500">
                        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition-colors">
                            Subscribe
                        </button>
                    </div>
                    <div class="mt-4 text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="privacy_accepted" class="rounded text-emerald-600">
                            <span>I agree to AgriLink's <a href="{{ route('guest.privacy') }}" class="underline hover:text-emerald-700">Privacy Policy</a></span>
                        </label>
                    </div>
                    <div id="newsletter-message" class="mt-2 text-sm"></div>
                </form>
            </div>
            <div class="flex-1 min-w-[300px] m-4">
                <h3 class="text-xl font-bold">DOWNLOAD AGRILINK FREE APP</h3>
                <p class="mt-2">Get access to exclusive offers!</p>
                <div class="flex gap-4 mt-4">
                    <a href="#" class="inline-block"><img src="{{ asset('images/app-store.png') }}" alt="App Store" class="h-10"></a>
                    <a href="#" class="inline-block"><img src="{{ asset('images/google-play.png') }}" alt="Google Play" class="h-10"></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-emerald-700 text-white py-6">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="text-2xl font-bold">
                <a href="{{ route('guest.home') }}">Agri<span class="text-yellow-400">Link</span></a>
            </div>
            <ul class="flex gap-8">
                <li><a href="{{ route('guest.privacy') }}" class="hover:text-yellow-400">Privacy Policy</a></li>
                <li><a href="{{ route('guest.terms') }}" class="hover:text-yellow-400">Terms of Service</a></li>
                <li><a href="{{ route('guest.contact') }}" class="hover:text-yellow-400">Contact Us</a></li>
            </ul>
        </div>
    </footer>

    @stack('scripts')
    <script>
        document.getElementById('newsletterForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const messageDiv = document.getElementById('newsletter-message');
            const form = this;
            
            try {
                const response = await fetch('{{ route("guest.newsletter.subscribe") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: form.email.value,
                        privacy_accepted: form.privacy_accepted.checked
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    messageDiv.className = 'mt-2 text-sm text-emerald-700';
                    messageDiv.textContent = data.message;
                    form.reset();
                } else {
                    throw new Error(data.message || 'Subscription failed');
                }
            } catch (error) {
                messageDiv.className = 'mt-2 text-sm text-red-600';
                messageDiv.textContent = error.message;
            }
        });
    </script>
</body>
</html>