<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Difficulty extends Model
{
    protected $table = 'difficulty';

    protected $fillable = ['name'];

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class, 'difficulty_id');
    }
}
