import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/dashboard/foodSearch.ts',
                'resources/js/calculators/calories.ts',
                'resources/css/calculators/calories.css',
                'resources/css/dashboard.css',
            ],
            refresh: true,
        }),
    ],
});
