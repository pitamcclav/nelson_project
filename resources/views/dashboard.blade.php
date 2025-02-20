@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700">Total Products</h2>
                <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalProducts ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700">Total Orders</h2>
                <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalOrders ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700">Total Users</h2>
                <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalUsers ?? 0 }}</p>
            </div>
        </div>
    </div>
@endsection
