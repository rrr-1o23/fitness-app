<div class="food-cards flex flex-col w-full mt-4">
    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($foodPaginator as $i=>$foodItem)
            <x-cards.food-item-card :food="$foodItem" :color="$randomColor">
                <p class="text-center"> ( {{ ($foodPaginator->currentPage() - 1) * $foodPaginator->perPage() + $i + 1 }} )</p>
            </x-cards.food-item-card>
        @endforeach
    </div>

    <div class="w-full mt-4">
        {{ $foodPaginator->links() }}
    </div>
</div>