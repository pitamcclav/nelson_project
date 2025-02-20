@extends('layouts.app')

@section('title', 'Reviews')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Reviews</h1>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Review ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($reviews as $review)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">{{ $review->id }}</td>
                            <td class="px-6 py-4">{{ $review->user->name }}</td>
                            <td class="px-6 py-4">{{ $review->product->name }}</td>
                            <td class="px-6 py-4">{{ $review->rating }}</td>
                            <td class="px-6 py-4">{{ $review->comment }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
