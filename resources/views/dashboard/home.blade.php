<x-dashboard-layout>
    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="space-y-8">
            @php 
                $randomList = array_map(
                    fn() => [
                        'title' => fake()->sentence(3), 
                        'content' => fake()->paragraph
                    ], 
                    range(1, 4)
                ); 
            @endphp
            @foreach ($randomList as $item)
                <div class="bg-white p-8 shadow rounded w-full">
                    <h2 class="text-2xl font-semibold mb-4">{{ $item['title'] }}</h2>
                    <p class="text-gray-600">{{ $item['content'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>