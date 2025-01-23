<x-front-layout>
    <x-slot:title>MyFitnessTracker Home Page</x-slot:title>

    <h1 class="text-4xl font-bold mb-4 text-blue-500">Welcome to Fitness Tracker!</h1>
    <p class="text-lg mb-6">Your ultimate fitness companion for workout planning and exercise routines. Let's get fit together!</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-200 p-4 rounded shadow">
            <h2 class="text-2xl font-bold mb-2">Workout Plans</h2>
            <p>Discover and customize your workout plans tailored to your goals.</p>
        </div>
        <div class="bg-blue-200 p-4 rounded shadow">
            <h2 class="text-2xl font-bold mb-2">Exercise Library</h2>
            <p>Explore a variety of exercises with detailed instructions and videos.</p>
        </div>
        <div class="bg-blue-200 p-4 rounded shadow">
            <h2 class="text-2xl font-bold mb-2">Track Progress</h2>
            <p>Monitor your progress and stay motivated with our tracking tools.</p>
        </div>
    </div>

    <x-slot:js>
        console.log("This is some Javascript!")
    </x-slot:js>
</x-front-layout>