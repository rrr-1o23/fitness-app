<div class="bg-{{ $color }}-200 p-4 rounded shadow flex flex-col">
    <h2 class="text-2xl font-bold mb-2">{{ $food->name }}</h2>
    <p class="mb-1"><strong>Protein:</strong> {{ $food->protein }}g</p>
    <p class="mb-1"><strong>Carbs:</strong> {{ $food->carbs }}g</p>
    <p class="mb-1"><strong>Fat:</strong> {{ $food->fat }}g</p>
    <p class="mb-1"><strong>Type:</strong> {{ $food->food_type_name ?? 'N/A' }}</p>
    <div class="mt-auto">
        <!-- 食品詳細ページへのリンク -->
        <div class="flex justify-center items-center mb-3 mt-3">
            <a href="{{ route('food.show', $food) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                View Food Item
            </a>
        </div>
        {{ $slot }}
    </div>
</div>