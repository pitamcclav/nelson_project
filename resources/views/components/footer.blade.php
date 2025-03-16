<!-- Footer -->
<footer class="bg-emerald-700 text-white py-12">
    <div class="container mx-auto px-4">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Company Info -->
            <div>
                <div class="text-2xl font-bold mb-4">
                    <a href="{{ route('guest.home') }}">Agri<span class="text-yellow-400">Link</span></a>
                </div>
                <p class="text-gray-300 mb-4">Connecting farmers and buyers for fresh, quality agricultural products.</p>
                <div class="flex items-center gap-2 text-gray-300 mb-4">
                    <i class="fas fa-phone-alt text-yellow-400"></i>
                    <span>Toll-free: 0800 100 200</span>
                </div>
                <div class="flex items-center gap-2 text-gray-300">
                    <i class="fas fa-envelope text-yellow-400"></i>
                    <span>support@agrilink.com</span>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('guest.marketplace') }}" class="text-gray-300 hover:text-yellow-400 transition-colors">Shop Now</a></li>
                    <li><a href="{{ route('guest.buyers') }}" class="text-gray-300 hover:text-yellow-400 transition-colors">For Buyers</a></li>
                    <li><a href="{{ route('register') }}?type=seller" class="text-gray-300 hover:text-yellow-400 transition-colors">Become a Seller</a></li>
                    <li><a href="{{ route('guest.contact') }}" class="text-gray-300 hover:text-yellow-400 transition-colors">Contact Us</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors">About Us</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors">FAQs</a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Categories</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('guest.marketplace') }}?category[]=vegetables" class="text-gray-300 hover:text-yellow-400 transition-colors">Vegetables</a></li>
                    <li><a href="{{ route('guest.marketplace') }}?category[]=fruits" class="text-gray-300 hover:text-yellow-400 transition-colors">Fruits</a></li>
                    <li><a href="{{ route('guest.marketplace') }}?category[]=cereals" class="text-gray-300 hover:text-yellow-400 transition-colors">Cereals</a></li>
                    <li><a href="{{ route('guest.marketplace') }}?category[]=dairy" class="text-gray-300 hover:text-yellow-400 transition-colors">Dairy Products</a></li>
                    <li><a href="{{ route('guest.marketplace') }}" class="text-gray-300 hover:text-yellow-400 transition-colors">All Categories</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Stay Updated</h3>
                <p class="text-gray-300 mb-4">Subscribe to our newsletter for updates and special offers.</p>
                <form id="footerNewsletterForm" class="space-y-3">
                    @csrf
                    <div class="relative">
                        <input type="email" name="email" placeholder="Your email address" 
                               class="w-full px-4 py-2 bg-emerald-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 placeholder-gray-400">
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-yellow-400 hover:text-yellow-500">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="mt-2 text-sm hidden" id="footerNewsletterMessage"></div>
                </form>
                <div class="mt-6">
                    <h4 class="font-semibold mb-2">Follow Us</h4>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="pt-8 border-t border-emerald-600">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-gray-300 text-sm">
                    © {{ date('Y') }} AgriLink. All rights reserved.
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ route('guest.privacy') }}" class="text-gray-300 hover:text-yellow-400 text-sm">Privacy Policy</a>
                    <a href="{{ route('guest.terms') }}" class="text-gray-300 hover:text-yellow-400 text-sm">Terms of Service</a>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/payment-methods.png') }}" alt="Payment Methods" class="h-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
<script>
    document.getElementById('footerNewsletterForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const messageDiv = document.getElementById('footerNewsletterMessage');
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
                    privacy_accepted: true
                })
            });
            
            const data = await response.json();
            
            messageDiv.classList.remove('hidden');
            if (data.success) {
                messageDiv.className = 'mt-2 text-sm text-yellow-400';
                messageDiv.textContent = data.message;
                form.reset();
            } else {
                throw new Error(data.message || 'Subscription failed');
            }
        } catch (error) {
            messageDiv.classList.remove('hidden');
            messageDiv.className = 'mt-2 text-sm text-red-400';
            messageDiv.textContent = error.message;
        }
    });
</script>
@endpush 