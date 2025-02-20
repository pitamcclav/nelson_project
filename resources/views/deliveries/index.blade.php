@extends('layouts.app')

@section('title', 'Deliveries')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Deliveries</h1>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking Code</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery Amount</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estimated Arrival</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($deliveries as $delivery)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">{{ $delivery->id }}</td>
                            <td class="px-6 py-4">{{ $delivery->order_id }}</td>
                            <td class="px-6 py-4">{{ $delivery->tracking_code }}</td>
                            <td class="px-6 py-4">${{ number_format($delivery->delivery_amount, 2) }}</td>
                            <td class="px-6 py-4">{{ ucfirst($delivery->delivery_status) }}</td>
                            <td class="px-6 py-4">{{ $delivery->estimated_arrival ? \Carbon\Carbon::parse($delivery->estimated_arrival)->format('M d, Y') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
