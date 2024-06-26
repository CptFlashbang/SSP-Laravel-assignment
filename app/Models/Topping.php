<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topping extends Model
{
    use HasFactory;
    public function pizzas(): BelongsToMany
    {
        return $this->belongsToMany(Pizza::class, 'pizza_topping');
    }
}
