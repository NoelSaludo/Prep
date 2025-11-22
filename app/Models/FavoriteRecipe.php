<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteRecipe extends Model
{
    protected $table = 'favorite_recipes';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'recipe_id'
    ];
}
