<!-- Top Bar -->
<div class="bg-gray-800 text-white text-sm py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>Call: +1 (555) 123-4567</span>
                </div>
                <div class="hidden md:flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>Email: support@ecommerce.com</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-2">
                    <span>Language:</span>
                    <select class="bg-gray-700 text-white text-sm border-gray-600 rounded px-2 py-1">
                        <option>English</option>
                        <option>Spanish</option>
                        <option>French</option>
                    </select>
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <span class="text-gray-300">Welcome, {{ Auth::user()->name }}!</span>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-gray-300 transition">Login</a>
                        <span class="text-gray-500">|</span>
                        <a href="{{ route('register') }}" class="hover:text-gray-300 transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
