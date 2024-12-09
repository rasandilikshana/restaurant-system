<?php

namespace Database\Seeders;

use App\Models\Concession;
use App\Models\KitchenQueue;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\OrderItem;
use App\Models\StaffMember;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there's at least one staff member, menu item, and concession in the database
        $staffMember = StaffMember::first();  // Assuming you've seeded staff members
        $menuItems = MenuItem::all();  // Assuming you've seeded menu items
        $concessions = Concession::all();  // Assuming you've seeded concessions

        // Create an order with associated order items
        $order = Order::create([
            'staff_member_id' => $staffMember->id,
            'customer_name' => 'John Doe',
            'customer_phone' => '123-456-7890',
            'customer_email' => 'johndoe@example.com',
            'table_number' => 'T1',
            'total_amount' => 99.99,
            'order_time' => now(),
            'send_to_kitchen_time' => now(), // Set the send_to_kitchen_time when creating the order
            'status' => 'Pending',
        ]);

        // Automatically send order to kitchen
        $order->sendToKitchen();
    }
}
