<x-app-layout>
    {{-- Hero Banner Carousel --}}
    <section class="relative">
        <div x-data="{ currentSlide: 0 }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % 3 }, 5000)" class="relative h-96 md:h-[500px] overflow-hidden">
            <!-- Slide 1 -->
            <div x-show="currentSlide === 0" x-transition:enter="transition-opacity duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                    <div class="max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4">Summer Sale</h1>
                        <p class="text-xl md:text-2xl mb-6">Up to 50% off on all products</p>
                        <a href="{{ route('products.index') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Shop Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div x-show="currentSlide === 1" x-transition:enter="transition-opacity duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-gradient-to-r from-green-600 to-teal-600 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                    <div class="max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4">New Arrivals</h1>
                        <p class="text-xl md:text-2xl mb-6">Fresh styles, trending now</p>
                        <a href="{{ route('products.index') }}" class="bg-white text-teal-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Explore</a>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div x-show="currentSlide === 2" x-transition:enter="transition-opacity duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                    <div class="max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4">Free Shipping</h1>
                        <p class="text-xl md:text-2xl mb-6">On orders over $50</p>
                        <a href="{{ route('products.index') }}" class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Shop Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Slide Indicators -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <button @click="currentSlide = 0" :class="{ 'bg-white': currentSlide === 0, 'bg-white bg-opacity-50': currentSlide !== 0 }" class="w-3 h-3 rounded-full"></button>
                <button @click="currentSlide = 1" :class="{ 'bg-white': currentSlide === 1, 'bg-white bg-opacity-50': currentSlide !== 1 }" class="w-3 h-3 rounded-full"></button>
                <button @click="currentSlide = 2" :class="{ 'bg-white': currentSlide === 2, 'bg-white bg-opacity-50': currentSlide !== 2 }" class="w-3 h-3 rounded-full"></button>
            </div>
        </div>
    </section>

    {{-- Flash Deals Section --}}
    <section class="py-12 bg-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">⚡ Flash Deals</h2>
                <p class="text-gray-600">Limited time offers - grab them before they're gone!</p>
                
                <!-- Countdown Timer -->
                <div x-data="{ 
                    hours: 23, 
                    minutes: 59, 
                    seconds: 59,
                    start() {
                        setInterval(() => {
                            this.seconds--;
                            if (this.seconds < 0) {
                                this.seconds = 59;
                                this.minutes--;
                                if (this.minutes < 0) {
                                    this.minutes = 59;
                                    this.hours--;
                                    if (this.hours < 0) {
                                        this.hours = 23;
                                    }
                                }
                            }
                        }, 1000);
                    }
                }" x-init="start()" class="flex justify-center items-center space-x-4 mt-4">
                    <div class="bg-red-600 text-white px-4 py-2 rounded-lg">
                        <span x-text="hours.toString().padStart(2, '0')" class="text-2xl font-bold"></span>
                        <div class="text-xs">Hours</div>
                    </div>
                    <div class="bg-red-600 text-white px-4 py-2 rounded-lg">
                        <span x-text="minutes.toString().padStart(2, '0')" class="text-2xl font-bold"></span>
                        <div class="text-xs">Minutes</div>
                    </div>
                    <div class="bg-red-600 text-white px-4 py-2 rounded-lg">
                        <span x-text="seconds.toString().padStart(2, '0')" class="text-2xl font-bold"></span>
                        <div class="text-xs">Seconds</div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products->take(4) as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition">
                    <div class="relative">
                        <img src="https://placehold.co/400x300/e2e8f0/333?text={{ urlencode($product->name) }}" 
                             alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
                        <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-bold">
                            -{{ rand(20, 50) }}%
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-lg font-bold text-red-600">${{ number_format($product->price * 0.7, 2) }}</span>
                                <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <a href="{{ route('products.show', $product) }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Categories Grid --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach(\App\Models\Category::all() as $category)
                <a href="{{ route('products.category', $category->slug) }}" class="group">
                    <div class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center group-hover:bg-indigo-200 transition">
                            <!-- Category Icon -->
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.023.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Featured Products</h2>
                <p class="text-gray-600">Hand-picked favorites just for you</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition">
                    <div class="relative">
                        <a href="{{ route('products.show', $product) }}">
                            <img src="https://placehold.co/400x300/e2e8f0/333?text={{ urlencode($product->name) }}" 
                                 alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
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
                        <a href="{{ route('products.show', $product) }}">
                            <h3 class="font-semibold text-gray-900 mb-2 hover:text-indigo-600">{{ $product->name }}</h3>
                        </a>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($product->description, 60) }}</p>
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
            
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    {{-- Brand Carousel --}}
    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Trusted Brands</h2>
            <div class="grid grid-cols-3 md:grid-cols-6 gap-8 items-center">
                @for($i = 1; $i <= 6; $i++)
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <img src="https://placehold.co/120x60/f8f9fa/6c757d?text=Brand+{{ $i }}" 
                         alt="Brand {{ $i }}" class="w-full h-12 object-contain">
                </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- Newsletter Signup --}}
    <section class="py-12 bg-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Stay Updated</h2>
            <p class="text-indigo-200 mb-8">Subscribe to our newsletter for exclusive deals and updates</p>
            <form class="max-w-md mx-auto flex">
                <input type="email" placeholder="Enter your email" 
                       class="flex-1 px-4 py-3 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="bg-white text-indigo-600 px-6 py-3 rounded-r-lg font-semibold hover:bg-gray-100 transition">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
</x-app-layout>