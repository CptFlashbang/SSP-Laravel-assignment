<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Pizza extends Model
{
    use HasFactory;
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function toppings(): BelongsToMany
    {
        return $this->belongsToMany(Topping::class, 'pizza_topping');
    }
}
