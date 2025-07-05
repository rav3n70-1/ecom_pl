<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('products.category', $product->category->slug) }}" class="ml-1 text-gray-700 hover:text-indigo-600 md:ml-2">{{ $product->category->name }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-500 md:ml-2">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Image Gallery -->
                <div>
                    <div class="mb-4">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://placehold.co/800x600/e2e8f0/333?text={{ urlencode($product->name) }}"
                                 alt="{{ $product->name }}" 
                                 class="w-full h-96 object-cover cursor-zoom-in"
                                 x-data="{ expanded: false }"
                                 @click="expanded = !expanded">
                        </div>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-4 gap-4">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden cursor-pointer">
                            <img src="https://placehold.co/200x200/e2e8f0/333?text={{ urlencode($product->name) }}-{{ $i }}"
                                 alt="{{ $product->name }} {{ $i }}" 
                                 class="w-full h-full object-cover hover:opacity-75 transition">
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Product Information -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                        <p class="text-sm text-gray-600 mt-2">Category: {{ $product->category->name }}</p>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600 ml-2">4.0 (127 reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="space-y-2">
                        <div class="flex items-center space-x-4">
                            <span class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                            <span class="text-lg text-gray-500 line-through">${{ number_format($product->price * 1.3, 2) }}</span>
                            <span class="bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded">23% off</span>
                        </div>
                        <p class="text-sm text-green-600 font-medium">✓ Free shipping on orders over $50</p>
                    </div>

                    <!-- Stock Status -->
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">In Stock ({{ $product->stock ?? 50 }} available)</span>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">100% Authentic</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Verified Seller</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">30-Day Returns</span>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="border-t pt-6">
                        <form action="{{ route('cart.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <!-- Quantity Selector -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                <div class="flex items-center space-x-3">
                                    <button type="button" class="quantity-btn" data-action="decrease">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock ?? 50 }}"
                                           class="w-16 text-center border border-gray-300 rounded-md py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <button type="button" class="quantity-btn" data-action="increase">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-4">
                                <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 transition">
                                    Add to Cart
                                </button>
                                <button type="button" class="flex-1 bg-gray-900 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-800 transition">
                                    Buy Now
                                </button>
                            </div>
                            
                            <button type="button" class="w-full border-2 border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-50 transition flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Add to Wishlist
                            </button>
                        </form>
                    </div>

                    <!-- Delivery Info -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">Delivery Information</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Estimated delivery: 2-5 business days</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Free shipping on orders over $50</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Tabs -->
            <div class="mt-16" x-data="{ activeTab: 'description' }">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button @click="activeTab = 'description'" 
                                :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'description', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'description' }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Description
                        </button>
                        <button @click="activeTab = 'specifications'" 
                                :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'specifications', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'specifications' }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Specifications
                        </button>
                        <button @click="activeTab = 'reviews'" 
                                :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'reviews', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'reviews' }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Reviews (127)
                        </button>
                        <button @click="activeTab = 'shipping'" 
                                :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'shipping', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'shipping' }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Shipping & Returns
                        </button>
                    </nav>
                </div>

                <!-- Description Tab -->
                <div x-show="activeTab === 'description'" class="py-8">
                    <div class="prose max-w-none">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Description</h3>
                        <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>High-quality materials and construction</li>
                            <li>Durable and long-lasting</li>
                            <li>Perfect for everyday use</li>
                            <li>Available in multiple sizes and colors</li>
                        </ul>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div x-show="activeTab === 'specifications'" class="py-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Specifications</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">General</h4>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Brand:</dt>
                                    <dd class="text-gray-900">ShopEase</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Model:</dt>
                                    <dd class="text-gray-900">{{ $product->name }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">SKU:</dt>
                                    <dd class="text-gray-900">{{ strtoupper(Str::random(8)) }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Dimensions</h4>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Weight:</dt>
                                    <dd class="text-gray-900">{{ rand(1, 10) }} lbs</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Dimensions:</dt>
                                    <dd class="text-gray-900">{{ rand(5, 20) }}" x {{ rand(5, 20) }}" x {{ rand(5, 20) }}"</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div x-show="activeTab === 'reviews'" class="py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Reviews</h3>
                            <div class="space-y-6">
                                @for($i = 1; $i <= 3; $i++)
                                <div class="border-b pb-6">
                                    <div class="flex items-center mb-2">
                                        <div class="flex items-center mr-4">
                                            @for($j = 1; $j <= 5; $j++)
                                            <svg class="w-4 h-4 {{ $j <= 5 ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            @endfor
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Customer {{ $i }}</span>
                                        <span class="text-sm text-gray-500 ml-2">{{ rand(1, 30) }} days ago</span>
                                    </div>
                                    <p class="text-gray-600">Great product! Really happy with the quality and fast shipping. Would definitely recommend to others.</p>
                                </div>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-4">Overall Rating</h4>
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-gray-900">4.0</span>
                                    <div class="ml-2">
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            @endfor
                                        </div>
                                        <span class="text-sm text-gray-500">Based on 127 reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Tab -->
                <div x-show="activeTab === 'shipping'" class="py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Information</h3>
                            <div class="space-y-3 text-sm text-gray-600">
                                <p>• Free standard shipping on orders over $50</p>
                                <p>• Express shipping available for $9.99</p>
                                <p>• Estimated delivery: 2-5 business days</p>
                                <p>• International shipping available</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Returns & Exchanges</h3>
                            <div class="space-y-3 text-sm text-gray-600">
                                <p>• 30-day return policy</p>
                                <p>• Free returns on defective items</p>
                                <p>• Items must be in original condition</p>
                                <p>• Return shipping costs may apply</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition">
                        <div class="relative">
                            <a href="{{ route('products.show', $relatedProduct) }}">
                                <img src="https://placehold.co/300x200/e2e8f0/333?text={{ urlencode($relatedProduct->name) }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="w-full h-48 object-cover group-hover:scale-105 transition">
                            </a>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('products.show', $relatedProduct) }}">
                                <h3 class="font-semibold text-gray-900 mb-2 hover:text-indigo-600">{{ $relatedProduct->name }}</h3>
                            </a>
                            <p class="text-lg font-bold text-gray-900">${{ number_format($relatedProduct->price, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
        .quantity-btn {
            @apply w-8 h-8 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300 transition flex items-center justify-center;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.querySelector('[data-action="decrease"]');
            const increaseBtn = document.querySelector('[data-action="increase"]');
            
            decreaseBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });
            
            increaseBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                let max = parseInt(quantityInput.max);
                if (value < max) {
                    quantityInput.value = value + 1;
                }
            });
        });
    </script>
</x-app-layout>