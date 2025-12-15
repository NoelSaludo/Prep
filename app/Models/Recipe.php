<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Recipe extends Model
{
    use HasUuids;
    
    protected $table = 'recipe';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'description', 
        'ingredients',
        'instruction',
        'min_calorie',
        'max_calorie',
        'difficulty_id'
    ];
}
