@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Register</h2>
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name:</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Phone:</label>
                    <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded border-gray-700 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700">Location:</label>
                    <input type="text" name="location" id="location" class="mt-1 block w-full rounded border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password:</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Register</button>
                </div>
            </form>
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-emerald-500 hover:underline">Already have an account? Login</a>
            </div>
        </div>
    </div>
@endsection
