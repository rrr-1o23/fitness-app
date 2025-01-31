<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-8">
            <span class="text-xl font-semibold text-primary">Fitness App</span>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary">Home</a>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary">Diary</a>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary">Stats</a>
            <a href="{{ route('food.index') }}" class="text-gray-600 hover:text-primary">My Food</a>
            <a href="{{ route('dashboard.food') }}" class="text-gray-600 hover:text-primary">Food</a>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary">Exercises</a>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-600">Hello, {{ Auth::user()->name }}</span>
            <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-primary">Settings</a>
        </div>
    </div>
</nav>