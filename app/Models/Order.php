<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['staff_member_id', 'customer_name', 'total_amount', 'order_time', 'send_to_kitchen_time', 'status'];

    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
