<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concession extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'discount_percentage', 'valid_from', 'valid_until'];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // You could consider adding an accessor to handle discounted price calculation.
    public function getDiscountedPrice($price)
    {
        if ($this->discount_percentage) {
            return $price - ($price * ($this->discount_percentage / 100));
        }

        return $price;
    }
}
