<nav class="bg-gray-300 p-4 h-20">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold text-gray-800">{{ env('APP_NAME') }}</div>
        <ul class="flex space-x-4">
            <li><a href="{{ route('front.home') }}" class="hover:text-gray-600">Home</a></li>
            <li><a href="{{ route('front.food') }}" class="hover:text-gray-600">Food</a></li>
            <li><a href="{{ route('front.calculator') }}" class="hover:text-gray-600">Calculator</a></li>

            @if (Route::has('login'))
                @auth
                    <li><a href="{{ route('dashboard') }}" class="hover:text-gray-600">Dashboard</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-gray-600">Login</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="hover:text-gray-600">Register</a></li>
                    @endif
                @endauth
            @endif
        </ul>
    </div>
</nav>