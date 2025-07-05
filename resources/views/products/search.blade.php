<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Search Results for "{{ $query }}"</h1>
                <p class="text-gray-600 mt-2">{{ $products->total() }} products found</p>
            </div>
            
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition">
                        <div class="relative">
                            <a href="{{ route('products.show', $product) }}">
                                <img src="https://placehold.co/400x300/e2e8f0/333?text={{ urlencode($product->name) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover group-hover:scale-105 transition">
                            </a>
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
                    {{ $products->appends(['q' => $query])->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                    <p class="text-gray-600">Sorry, we couldn't find any products matching "{{ $query }}".</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Browse All Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
