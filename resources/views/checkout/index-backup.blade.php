<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">

                    {{-- Display Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Whoops!</strong>
                            <span class="block sm:inline">There were some problems with your input.</span>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            {{-- Shipping Information Form --}}
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Shipping
                                    Information</h3>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <label for="name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full
                                            name</label>
                                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                                            required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="email"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email
                                            address</label>
                                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                                            required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="address"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street
                                            address</label>
                                        <input type="text" name="address" id="address" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="city"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                                        <input type="text" name="city" id="city" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="state"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">State /
                                            Province</label>
                                        <input type="text" name="state" id="state" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="zip_code"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ZIP /
                                            Postal code</label>
                                        <input type="text" name="zip_code" id="zip_code" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>
                            </div>

                            {{-- Order Summary --}}
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Order Summary
                                </h3>
                                <div class="mt-6">
                                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-600">
                                        @foreach($cartItems as $item)
                                            <li class="flex py-4">
                                                <div
                                                    class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 dark:border-gray-600">
                                                    <img src="https://placehold.co/100x100/e2e8f0/333?text={{ urlencode($item->product->name) }}"
                                                        alt="{{ $item->product->name }}"
                                                        class="h-full w-full object-cover object-center">
                                                </div>
                                                <div class="ml-4 flex flex-1 flex-col">
                                                    <div>
                                                        <div
                                                            class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                                                            <h3>{{ $item->product->name }}</h3>
                                                            <p class="ml-4">
                                                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                                                            </p>
                                                        </div>
                                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Qty:
                                                            {{ $item->quantity }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4 mt-4">
                                        <div
                                            class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                                            <p>Subtotal</p>
                                            <p>${{ number_format($total, 2) }}</p>
                                        </div>
                                        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">Shipping and taxes
                                            will be calculated later.</p>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                        class="w-full rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Place
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>