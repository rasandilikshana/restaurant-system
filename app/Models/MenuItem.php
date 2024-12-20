<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'price', 'available', 'category'];

    protected $casts = [
        'price' => 'decimal:2',
        'available' => 'boolean',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // This method can be used to check if the menu item is available.
    public function isAvailable()
    {
        return $this->available;
    }
}
