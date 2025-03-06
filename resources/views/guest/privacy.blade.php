@extends('layouts.guest')

@section('title', 'Privacy Policy')

@section('content')
<div class="container mx-auto px-4 py-12 mt-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Privacy Policy</h1>
        <div class="prose max-w-none text-gray-600">
            <p class="mb-6">Last updated: March 1, 2024</p>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">1. Information We Collect</h2>
            <p class="mb-4">When you use AgriLink, we collect various types of information to provide and improve our services:</p>
            <ul class="list-disc pl-6 mb-6">
                <li>Personal information (name, email address, phone number)</li>
                <li>Delivery information (shipping address)</li>
                <li>Payment information</li>
                <li>Usage data and preferences</li>
                <li>Device and browser information</li>
            </ul>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">2. How We Use Your Information</h2>
            <p class="mb-4">We use the collected information for:</p>
            <ul class="list-disc pl-6 mb-6">
                <li>Processing your orders and payments</li>
                <li>Providing customer support</li>
                <li>Sending important updates and notifications</li>
                <li>Improving our services</li>
                <li>Marketing and promotional communications (with your consent)</li>
            </ul>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">3. Information Sharing</h2>
            <p class="mb-4">We may share your information with:</p>
            <ul class="list-disc pl-6 mb-6">
                <li>Farmers and sellers to fulfill your orders</li>
                <li>Delivery partners for order fulfillment</li>
                <li>Payment processors for secure transactions</li>
                <li>Service providers who assist our operations</li>
            </ul>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">4. Data Security</h2>
            <p class="mb-6">We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">5. Your Rights</h2>
            <p class="mb-4">You have the right to:</p>
            <ul class="list-disc pl-6 mb-6">
                <li>Access your personal information</li>
                <li>Correct inaccurate data</li>
                <li>Request deletion of your data</li>
                <li>Opt-out of marketing communications</li>
                <li>Export your data</li>
            </ul>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">6. Cookies</h2>
            <p class="mb-6">We use cookies and similar tracking technologies to enhance your browsing experience and analyze usage patterns.</p>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">7. Changes to This Policy</h2>
            <p class="mb-6">We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page.</p>

            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">8. Contact Us</h2>
            <p class="mb-6">If you have any questions about this privacy policy, please contact us at:</p>
            <ul class="list-none pl-6 mb-6">
                <li>Email: privacy@agrilink.com</li>
                <li>Phone: +256 123 456 789</li>
                <li>Address: 123 Farmers Lane, Kampala, Uganda</li>
            </ul>
        </div>
    </div>
</div>
@endsection