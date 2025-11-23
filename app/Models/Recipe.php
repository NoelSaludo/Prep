<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    protected $table = 'recipe';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'instruction',
        'min_calorie',
        'max_calorie',
        'difficulty_id'
    ];

    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class, 'difficulty_id');
    }

    public function favoritedByUsers(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'favorite_recipes', 'recipe_id', 'user_id');
    }
}
