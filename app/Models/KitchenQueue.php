<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenQueue extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'order_received_time', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
