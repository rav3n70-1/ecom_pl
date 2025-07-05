@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Progress Bar -->
        <div class="mb-8">
            <nav aria-label="Progress" class="flex justify-center">
                <ol role="list" class="flex items-center space-x-5">
                    <li class="flex items-center">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-900">Cart</span>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="flex items-center ml-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-medium">2</span>
                            </div>
                            <span class="ml-2 text-sm font-medium text-blue-600">Shipping</span>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="flex items-center ml-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-500 font-medium">3</span>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-500">Confirmation</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" class="lg:grid lg:grid-cols-12 lg:gap-12">
            @csrf
            <!-- Shipping Information -->
            <div class="lg:col-span-7">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">Shipping Information</h2>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                            <input type="text" name="state" id="state" value="{{ old('state') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-1">ZIP/Postal Code</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-5 mt-8 lg:mt-0">
                <div class="bg-white shadow rounded-lg p-6 sticky top-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="text-sm font-medium text-gray-900">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t border-gray-200 mt-6 pt-6 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-900">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="text-gray-900">
                                @if($shipping > 0)
                                    ${{ number_format($shipping, 2) }}
                                @else
                                    <span class="text-green-600">Free</span>
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax</span>
                            <span class="text-gray-900">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-medium border-t border-gray-200 pt-2">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 font-medium">
                            Place Order
                        </button>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('cart.index') }}" class="text-sm text-blue-600 hover:text-blue-500">
                            ← Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
