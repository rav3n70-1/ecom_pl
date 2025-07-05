<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
                <p class="text-gray-600 mt-2">{{ $cartItems->count() }} items in your cart</p>
            </div>

            @if($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Cart Items</h2>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @foreach($cartItems as $item)
                                <div class="p-6 flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/200x200/e2e8f0/333?text={{ urlencode($item->product->name) }}"
                                             alt="{{ $item->product->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    <a href="{{ route('products.show', $item->product) }}" class="hover:text-indigo-600">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h3>
                                                <p class="text-sm text-gray-600">Category: {{ $item->product->category->name }}</p>
                                                <p class="text-sm text-gray-600">Price: ${{ number_format($item->product->price, 2) }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-gray-900">
                                                    ${{ number_format($item->product->price * $item->quantity, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center space-x-2">
                                                <label for="quantity-{{ $item->id }}" class="text-sm font-medium text-gray-700">Qty:</label>
                                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                                        <button type="button" class="quantity-btn decrease" data-target="quantity-{{ $item->id }}">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                            </svg>
                                                        </button>
                                                        <input type="number" name="quantity" id="quantity-{{ $item->id }}" 
                                                               value="{{ $item->quantity }}" min="1" max="99"
                                                               class="w-16 text-center border-0 focus:ring-0 focus:outline-none">
                                                        <button type="button" class="quantity-btn increase" data-target="quantity-{{ $item->id }}">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <button type="submit" class="text-sm bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300 transition">
                                                        Update
                                                    </button>
                                                </form>
                                            </div>
                                            
                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Continue Shopping -->
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div>
                        <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                    <span class="font-medium">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium">
                                        @if($total >= 50)
                                            <span class="text-green-600">Free</span>
                                        @else
                                            $9.99
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tax</span>
                                    <span class="font-medium">${{ number_format($total * 0.08, 2) }}</span>
                                </div>
                                <div class="border-t pt-3">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-semibold text-gray-900">Total</span>
                                        <span class="text-lg font-bold text-gray-900">
                                            ${{ number_format($total + ($total >= 50 ? 0 : 9.99) + ($total * 0.08), 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            @if($total < 50)
                                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <p class="text-sm text-yellow-800">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Add ${{ number_format(50 - $total, 2) }} more for free shipping!
                                    </p>
                                </div>
                            @endif
                            
                            <div class="mt-6 space-y-3">
                                <a href="{{ route('checkout.index') }}" 
                                   class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition text-center block">
                                    Proceed to Checkout
                                </a>
                                <button class="w-full bg-gray-900 text-white py-3 px-4 rounded-lg font-semibold hover:bg-gray-800 transition">
                                    Express Checkout
                                </button>
                            </div>
                            
                            <!-- Trust Badges -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="grid grid-cols-2 gap-4 text-xs text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Secure Checkout
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        30-Day Returns
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Fast Shipping
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        24/7 Support
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m15.6 0L7 13m0 0L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6.28l.01-.01L9 15l8-2z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                    <p class="text-gray-600 mb-8">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        .quantity-btn {
            @apply w-8 h-8 bg-gray-50 text-gray-600 hover:bg-gray-100 transition flex items-center justify-center;
        }
        .quantity-btn.decrease {
            @apply rounded-l-lg border-r border-gray-300;
        }
        .quantity-btn.increase {
            @apply rounded-r-lg border-l border-gray-300;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityBtns = document.querySelectorAll('.quantity-btn');
            
            quantityBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const target = this.dataset.target;
                    const input = document.getElementById(target);
                    const isIncrease = this.classList.contains('increase');
                    const isDecrease = this.classList.contains('decrease');
                    
                    let value = parseInt(input.value);
                    
                    if (isIncrease && value < 99) {
                        input.value = value + 1;
                    } else if (isDecrease && value > 1) {
                        input.value = value - 1;
                    }
                });
            });
        });
    </script>
</x-app-layout>
                                                    @method('PATCH')
                                                    <label for="quantity-{{ $item->id }}" class="sr-only">Quantity</label>
                                                    <input type="number" name="quantity" id="quantity-{{ $item->id }}"
                                                        value="{{ $item->quantity }}" min="1"
                                                        class="w-16 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    <button type="submit"
                                                        class="ml-2 font-medium text-indigo-600 hover:text-indigo-500">Update</button>
                                                </form>

                                                {{-- Remove Item Form --}}
                                                <div class="flex">
                                                    <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Cart Summary --}}
                        <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-6 sm:px-6 mt-6">
                            <div class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                                <p>Subtotal</p>
                                <p>${{ number_format($total, 2) }}</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">Shipping and taxes calculated at
                                checkout.</p>
                            <div class="mt-6">
                                {{-- THIS LINK IS NOW CORRECTLY PLACED --}}
                                <a href="{{ route('checkout.index') }}"
                                    class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">Your cart is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>