@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Users</h1>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
