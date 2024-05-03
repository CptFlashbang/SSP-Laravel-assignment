<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topping extends Model
{
    use HasFactory;
    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }
}
