@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="mb-6">
                <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Placed Successfully!</h1>
                <p class="text-gray-600">Thank you for your purchase. Your order has been received and is being processed.</p>
            </div>
            
            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4">What's Next?</h2>
                <div class="space-y-3 text-left">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>You'll receive an email confirmation shortly</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                        <span>Your order will be processed within 1-2 business days</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Track your order status in your dashboard</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 space-y-3">
                <a href="{{ route('dashboard') }}" class="block w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200">
                    View Order History
                </a>
                <a href="{{ route('home') }}" class="block w-full bg-gray-100 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-200 transition duration-200">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
