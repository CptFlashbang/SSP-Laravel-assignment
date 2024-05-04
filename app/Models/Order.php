<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function addOrUpdatePizza(Pizza $pizza, $size, $price)
    {
        $uniqueIdentifier = $pizza->id . '_' . $size;
        $item = $this->orderItems->firstWhere('uniqueIdentifier', $uniqueIdentifier);

        if ($item) {
            // If found, increment the quantity
            $item->quantity += 1;
        } else {
            // If not found, add new pizza with quantity 1
            $this->orderItems()->create([
                'pizza_id' => $pizza->id,
                'size' => $size,
                'price' => $price,
                'quantity' => 1,
                'uniqueIdentifier' => $uniqueIdentifier
            ]);
        }
        $this->save(); // Make sure changes are saved
    }
}
