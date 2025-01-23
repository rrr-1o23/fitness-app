<x-front-layout>
    <x-slot:early-asset-load>
        @vite('resources/css/calculators/calories.css')
    </x-slot:early-asset-load>

    <div id="calories-calculator" class="calories-calculator-container"></div>

    <x-slot:late-asset-load>
        @vite('resources/js/calculators/calories.ts')
    </x-slot:late-asset-load>
</x-front-layout>