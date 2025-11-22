<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    protected $table = 'users';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    public function favoriteRecipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'favorite_recipes', 'user_id', 'recipe_id');
    }
}
