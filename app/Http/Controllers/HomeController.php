<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

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
}