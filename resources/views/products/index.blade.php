<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Sidebar - Filters -->
                <div class="lg:w-1/4">
                    <div class="bg-gray-50 p-6 rounded-lg sticky top-24">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>
                        
                        <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                            <!-- Categories -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Categories</h4>
                                <div class="space-y-2">
                                    @foreach($categories as $category)
                                    <label class="flex items-center">
                                        <input type="radio" name="category" value="{{ $category->slug }}" 
                                               {{ request('category') == $category->slug ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-600">{{ $category->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Price Range -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Price Range</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <input type="number" name="min_price" placeholder="Min" 
                                               value="{{ request('min_price') }}"
                                               class="w-20 px-3 py-2 border border-gray-300 rounded-md text-sm">
                                        <span class="text-gray-500">to</span>
                                        <input type="number" name="max_price" placeholder="Max" 
                                               value="{{ request('max_price') }}"
                                               class="w-20 px-3 py-2 border border-gray-300 rounded-md text-sm">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sort -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Sort By</h4>
                                <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                                </select>
                            </div>
                            
                            <div class="flex space-x-2">
                                <button type="submit" class="flex-1 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                                    Apply Filters
                                </button>
                                <a href="{{ route('products.index') }}" class="flex-1 bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 transition text-center">
                                    Clear
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Right Content - Products -->
                <div class="lg:w-3/4">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">All Products</h1>
                        <p class="text-sm text-gray-600">{{ $products->total() }} products found</p>
                    </div>
                    
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition">
                                <div class="relative">
                                    <a href="{{ route('products.show', $product) }}">
                                        <img src="https://placehold.co/400x300/e2e8f0/333?text={{ urlencode($product->name) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition">
                                    </a>
                                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                        <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $product->category->name }}</span>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="text-sm text-gray-600 ml-1">4.5</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('products.show', $product) }}">
                                        <h3 class="font-semibold text-gray-900 mb-2 hover:text-indigo-600">{{ $product->name }}</h3>
                                    </a>
                                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($product->description, 80) }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                        <form action="{{ route('cart.store') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                                Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293L16 17.414a2 2 0 01-1.414.586h-3.172a2 2 0 01-1.414-.586L7.414 15.293a1 1 0 00-.707-.293H4"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                            <p class="text-gray-600">Try adjusting your filters or search terms.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
