<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    
    protected $fillable = ['user_id', 'delivery', 'totalPrice'];
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function addOrUpdatePizza(Order $order, Pizza $pizza, $size, $price)
    {
        $uniqueIdentifier = $pizza->id . '_' . $size;
        $item = $order->orderItems->first(function ($item) use ($uniqueIdentifier) {
            return $item->uniqueIdentifier === $uniqueIdentifier;
        });

        if ($item) {
            $item->quantity += 1;
        } else {
            $item = new OrderItem([
                'order_id' => $order->id,  // Ensure this is included
                'pizza_id' => $pizza->id,
                'size' => $size,
                'price' => $price,
                'quantity' => 1,
                'uniqueIdentifier' => $uniqueIdentifier
            ]);
            $order->orderItems->push($item);
        }

        // Now, explicitly save each item (if you want them in the database)
        $item->save();  // This line will save the OrderItem to the database
    }

}
