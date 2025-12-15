<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get all recipes - no filtering, just get them
        $recipes = Recipe::limit(12)->get();
        
        return view('home', [
            'user' => $user,
            'favoriteRecipes' => collect([]), // Empty for now
            'recentRecipes' => $recipes->take(8),
            'recommendedRecipes' => $recipes->take(8)
        ]);
    }
    
    public function show($id)
    {
        $recipe = Recipe::find($id);
        
        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }
        
        // Parse ingredients from string format
        $ingredientsString = trim($recipe->ingredients, '{}\'');
        $ingredientsArray = array_filter(explode(',', str_replace("''", "", $ingredientsString)));
        
        $ingredients = array_map(function($item) {
            return (object)[
                'name' => trim($item, " '"),
                'quantity' => '',
                'unit' => ''
            ];
        }, $ingredientsArray);
        
        // Parse instructions - split by numbered steps
        $instructionText = $recipe->instruction;
        $steps = preg_split('/\d+\.\s+/', $instructionText, -1, PREG_SPLIT_NO_EMPTY);
        
        $instructions = array_map(function($step) {
            return (object)['step' => trim($step)];
        }, $steps);
        
        return response()->json([
            'recipe' => [
                'id' => $recipe->id,
                'name' => $recipe->name,
                'description' => $recipe->description,
                'prep_time' => 30,
                'ingredients' => $ingredients,
                'instructions' => $instructions,
            ]
        ]);
    }

}
