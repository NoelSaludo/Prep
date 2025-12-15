<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        $recipes = [
            ['name' => 'Chicken Adobo', 'description' => 'Classic Filipino braised chicken.', 'ingredients' => 'chicken, soy sauce, vinegar', 'instruction' => 'Marinate and simmer.', 'min_calorie' => 350, 'max_calorie' => 450, 'difficulty_id' => 1],
            ['name' => 'Pork Sinigang', 'description' => 'Sour tamarind-based pork soup.', 'ingredients' => 'pork, tamarind, vegetables', 'instruction' => 'Boil and simmer.', 'min_calorie' => 250, 'max_calorie' => 350, 'difficulty_id' => 2],
            // Add all 20 recipes here...
        ];

        foreach ($recipes as $recipe) {
            DB::table('recipe')->insert($recipe);
        }
    }
}
