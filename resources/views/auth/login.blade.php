@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Login</h2>
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password:</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200" required>
                </div>
                <div class="mb-4">
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Login</button>
                </div>
            </form>
            <div class="text-center">
                <a href="{{ route('register') }}" class="text-sm text-emerald-500 hover:underline">Don't have an account? Register</a>
            </div>
        </div>
    </div>
@endsection
