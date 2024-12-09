<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_item_id',
        'concession_id',
        'quantity',
        'price',
        'total_price'
    ];

    // Accessor to calculate total price dynamically
    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->price;
    }

    // Other relationships...
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function concession()
    {
        return $this->belongsTo(Concession::class);
    }
}
