@extends('layouts.guest')

@section('title', 'Contact Us')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Contact Us</h1>
    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Have questions? We're here to help! Send us a message and we'll respond as soon as possible.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('guest.contact.submit') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <div class="mb-6">
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input type="text" id="subject" name="subject" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="message" name="message" rows="5" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-emerald-700 text-white px-6 py-3 rounded-lg font-bold hover:bg-emerald-800 transition-colors">
                    Send Message
                </button>
            </form>
        </div>

        <!-- Contact Information -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Contact Information</h2>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-map-marker-alt text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Our Location</h3>
                            <p class="text-gray-600">123 Farmers Lane, Kampala, Uganda</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-phone text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Phone</h3>
                            <p class="text-gray-600">+256 123 456 789</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-envelope text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Email</h3>
                            <p class="text-gray-600">info@agrilink.com</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Business Hours</h3>
                            <p class="text-gray-600">Monday - Friday: 8:00 AM - 6:00 PM</p>
                            <p class="text-gray-600">Saturday: 9:00 AM - 3:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Follow Us</h2>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center hover:bg-emerald-200 transition-colors">
                        <i class="fab fa-facebook-f text-emerald-600"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center hover:bg-emerald-200 transition-colors">
                        <i class="fab fa-twitter text-emerald-600"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center hover:bg-emerald-200 transition-colors">
                        <i class="fab fa-instagram text-emerald-600"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center hover:bg-emerald-200 transition-colors">
                        <i class="fab fa-linkedin-in text-emerald-600"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection