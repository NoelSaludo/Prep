<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory ,Notifiable;

    protected $table = 'users';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'username',
        'email',
        'password',
        'created_at',
        'udpated_at',
    ];

    public function favoriteRecipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'favorite_recipes', 'user_id', 'recipe_id');
    }


}
