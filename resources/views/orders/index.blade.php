@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section with "Create Order" Button -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Orders</h1>
            <button onclick="openCreateOrderModal()" class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded shadow-md flex items-center transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Create Order
            </button>
        </div>

        <!-- Orders Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buyer</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->buyer->name }}</td>
                            <td class="px-6 py-4">{{ $order->product->name }}</td>
                            <td class="px-6 py-4">{{ $order->quantity }}</td>
                            <td class="px-6 py-4">UGX {{ number_format($order->total_price, 2) }}</td>
                            <td class="px-6 py-4">{{ ucfirst($order->status) }}</td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openEditModal({{ $order->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="openDeleteModal({{ $order->id }})" class="text-red-600 hover:text-red-900 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Order Modal -->
    <div id="orderCreateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-auto max-w-lg transform transition-all duration-300 scale-95">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-900">Create Order</h3>
                <button onclick="closeModal('orderCreateModal')" class="text-gray-400 hover:text-gray-500 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="orderCreateForm" method="POST" action="{{ route('orders.store') }}">
                @csrf
                <div class="px-6 py-4 space-y-4">
                    <!-- Buyer Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Buyer</label>
                        <select name="buyer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                            @foreach($buyers as $buyer)
                                <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Product Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product</label>
                        <select name="product_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Quantity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                    </div>
                    <!-- Total Price compute-->

                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-xl">
                    <button type="button" onclick="closeModal('orderCreateModal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-500 rounded-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Create Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div id="orderEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-auto max-w-lg transform transition-all duration-300 scale-95">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-900" id="orderModalTitle">Edit Order</h3>
                <button onclick="closeModal('orderEditModal')" class="text-gray-400 hover:text-gray-500 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="orderEditForm" method="POST" action="">
                @csrf
                <div id="orderMethodField"></div>
                <div class="px-6 py-4 space-y-4">
                    <!-- For simplicity, only allow editing quantity, total price, and status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="orderEditQuantity" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                    </div>
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700">Total Price</label>--}}
{{--                        <input type="number" step="0.01" name="total_price" id="orderEditTotalPrice" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">--}}
{{--                    </div>--}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="orderEditStatus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                            @foreach(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-xl">
                    <button type="button" onclick="closeModal('orderEditModal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-500 rounded-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Order Modal -->
    <div id="orderDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-auto max-w-md transform transition-all duration-300 scale-95">
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Order</h3>
                <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this order? This action cannot be undone.</p>
                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="closeModal('orderDeleteModal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Cancel
                    </button>
                    <form id="orderDeleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function openCreateOrderModal() {
            document.getElementById('orderCreateForm').reset();
            document.getElementById('orderCreateForm').action = "{{ route('orders.store') }}";
            toggleModal('orderCreateModal', true);
        }

        function openEditModal(id) {
            document.getElementById('orderModalTitle').textContent = 'Edit Order';
            document.getElementById('orderEditForm').action = `/orders/${id}`;
            document.getElementById('orderMethodField').innerHTML = '@method("PUT")';
            // Fetch order data for editing
            fetch(`/orders/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('orderEditQuantity').value = data.quantity;
                    document.getElementById('orderEditTotalPrice').value = data.total_price;
                    document.getElementById('orderEditStatus').value = data.status;
                });
            toggleModal('orderEditModal', true);
        }

        function openDeleteModal(id) {
            document.getElementById('orderDeleteForm').action = `/orders/${id}`;
            toggleModal('orderDeleteModal', true);
        }

        function closeModal(modalId) {
            toggleModal(modalId, false);
        }

        function toggleModal(modalId, show) {
            const modal = document.getElementById(modalId);
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
@endsection
