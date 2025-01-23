<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodType;

class FoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedConfig = config('models.seeding.food-types');
        $foodTypes = $seedConfig['default_list'];

        foreach($foodTypes as $foodType) {
            FoodType::updateOrCreate(
                [
                    'name' => $foodType['name'],
                    'description' => $foodType['description'],
                ],
            );
        }
    }
}
