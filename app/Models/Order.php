<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'staff_member_id', 'customer_name', 'customer_phone', 'customer_email', 'table_number', 'total_amount', 'order_time', 'send_to_kitchen_time', 'status'];

    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            // Auto-generate order_id based on the last order and increment it
            $lastOrder = DB::table('orders')->latest('created_at')->first();
            $lastOrderId = $lastOrder ? (int) substr($lastOrder->order_id, 2) : 1000; // Start from OR1000
            $order->order_id = 'OR' . ($lastOrderId + 1);  // Increment order ID with the prefix 'OR'
        });
    }

    public function kitchenQueue()
    {
        return $this->hasOne(KitchenQueue::class);
    }

    public function sendToKitchen()
    {

        $this->status = 'Sent to Kitchen';
        $this->save();

        KitchenQueue::create([
            'order_id' => $this->id,
            'order_received_time' => now(),
            'status' => 'Pending'
        ]);
    }
}
