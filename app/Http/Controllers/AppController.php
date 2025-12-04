<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function fetchAllRecipe(Request $request)
    {
        $filters = $request->session()->get('recipe_filters', []);
        $q = Recipe::query();
        $q = $this->applyFilters($request, $q, $filters);
        $recipes = $q->with('difficulty')->get();
        return response()->json($recipes);
    }

    public function toggleFilter(Request $request, $name)
    {
        $filters = $request->session()->get('recipe_filters', []);
        if (($i = array_search($name, $filters)) !== false) {
            array_splice($filters, $i, 1);
        } else {
            $filters[] = $name;
        }
        $request->session()->put('recipe_filters', $filters);
        return response()->json(['filters' => $filters]);
    }

    public function searchRecipebyIngredient(Request $request)
    {
        $terms = $request->input('terms', []);
        $q = Recipe::query();
        $q = $this->ingredientQuery($q, $terms);
        return response()->json($q->get());
    }

    public function addToFavorite(Request $request, $recipeId)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $user->favoriteRecipes()->syncWithoutDetaching([$recipeId]);
        return response()->json(['favorites' => $user->favoriteRecipes()->pluck('id')]);
    }

    private function applyFilters(Request $request, $q, array $filters)
    {
        if (in_array('favorites', $filters) && $request->user()) {
            $q->whereHas('favoritedByUsers', fn($qq) => $qq->where('users.id', $request->user()->id));
        }
        foreach ($filters as $f) {
            if (in_array(strtolower($f), ['vegan', 'vegetarian'])) {
                $q->where('ingredients', 'LIKE', '%' . $f . '%');
            }
            if (in_array(strtolower($f), ['easy', 'medium', 'hard'])) {
                $name = ucfirst(strtolower($f));
                $q->whereHas('difficulty', fn($qq) => $qq->where('name', $name));
            }
        }
        return $q;
    }

    private function ingredientQuery($q, array $terms)
    {
        foreach ($terms as $t) {
            $t = trim((string)$t);
            if ($t === '') continue;
            $q->whereRaw('LOWER(ingredients) LIKE ?', ['%' . strtolower($t) . '%']);
        }
        return $q;
    }
}
