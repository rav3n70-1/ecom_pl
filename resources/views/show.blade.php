<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12">
                    <div class="md:grid md:grid-cols-2 md:gap-12">
                        <!-- Product Image Gallery -->
                        <div>
                            <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                                <img src="https://placehold.co/800x600/e2e8f0/333?text={{ urlencode($product->name) }}"
                                    alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="mt-8 md:mt-0">
                            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                                {{ $product->name }}</h1>

                            <div class="mt-3">
                                <p class="text-3xl text-gray-900 dark:text-white">
                                    ${{ number_format($product->price, 2) }}</p>
                            </div>

                            <div class="mt-6">
                                <h3 class="sr-only">Description</h3>
                                <div class="text-base text-gray-700 dark:text-gray-300 space-y-6">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>

                            <div class="mt-10">
                                <!-- Add to Cart Button -->
                                <button type="submit"
                                    class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>