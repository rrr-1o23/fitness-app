<x-dashboard-layout>
    <div class="bg-zinc-100 p-5 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-1">Search Food</h2>
        <form method="GET" action="{{ route('dashboard.food') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-3">
                <div>
                    <label for="name" class="block text-gray-700 text-sm">Name</label>
                    <input type="text" name="name" id="name" class="w-full p-1 border border-gray-300 rounded-lg" value="{{ request('name') }}">
                </div>
                <div>
                    <label for="food_type" class="block text-gray-700 text-sm">Food Type</label>
                    <select name="food_type" id="food_type" class="w-full p-1 border border-gray-300 rounded-lg">
                        <option value="">All</option>
                        @foreach ($foodTypes as $foodType)
                            <option value="{{ $foodType->name }}" {{ request('food_type') == $foodType->name ? 'selected' : '' }}>
                                {{ $foodType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tags" class="block text-gray-700 text-sm">Tags (Comma Separated)</label>
                    <input type="text" name="tags" id="tags" class="w-full p-1 border border-gray-300 rounded-lg" value="{{ request('tags') }}">
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded-lg text-sm">Search</button>
            </div>
        </form>
    </div>

    <div class="food-card-container">
        <x-dashboard.food-cards :food-paginator="$food">
        </x-dashboard.food-cards>
    </div>

</x-dashboard-layout>