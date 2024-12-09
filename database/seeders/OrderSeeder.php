<?php

namespace Database\Seeders;

use App\Models\Concession;
use App\Models\KitchenQueue;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\OrderItem;
use App\Models\StaffMember;
use App\Models\Table;
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
        $tables = Table::all();  // Fetch available tables

        if ($staffMember && $menuItems->isNotEmpty() && $concessions->isNotEmpty() && $tables->isNotEmpty()) {
            // Example Order 1
            $order = Order::create([
                'order_id' => 'ORD' . strtoupper(uniqid()), // Generate a custom order ID
                'staff_member_id' => $staffMember->id,  // Staff member reference
                'customer_name' => 'John Doe',
                'customer_phone' => '1234567890',
                'customer_email' => 'johndoe@example.com',
                'table_id' => $tables->random()->id,  // Assign a random table id
                'total_amount' => 45.99,
                'order_time' => Carbon::now(),
                'send_to_kitchen_time' => Carbon::now()->addMinutes(10),  // Send order to kitchen in 10 minutes
                'status' => 'Pending',
            ]);

            // Add items to the order
            foreach ($menuItems->take(2) as $menuItem) {
                $order->orderItems()->create([
                    'menu_item_id' => $menuItem->id,
                    'concession_id' => $concessions->random()->id,  // Random concession applied
                    'quantity' => rand(1, 3),  // Random quantity
                    'price' => $menuItem->price,  // Use the menu item's price
                    'total_price' => $menuItem->price,
                ]);
            }

            // Example Order 2 (Repeat as needed or create multiple orders)
            $order2 = Order::create([
                'order_id' => 'ORD' . strtoupper(uniqid()), // Generate a custom order ID
                'staff_member_id' => $staffMember->id,  // Staff member reference
                'customer_name' => 'Jane Smith',
                'customer_phone' => '9876543210',
                'customer_email' => 'janesmith@example.com',
                'table_id' => $tables->random()->id,  // Assign a random table id
                'total_amount' => 30.50,
                'order_time' => Carbon::now(),
                'send_to_kitchen_time' => Carbon::now()->addMinutes(10),  // Send order to kitchen in 10 minutes
                'status' => 'Pending',
            ]);

            // Add items to the second order
            foreach ($menuItems->take(2) as $menuItem) {
                $order2->orderItems()->create([
                    'menu_item_id' => $menuItem->id,
                    'concession_id' => $concessions->random()->id,  // Random concession applied
                    'quantity' => rand(1, 3),  // Random quantity
                    'price' => $menuItem->price,  // Use the menu item's price
                    'total_price' => $menuItem->price,
                ]);
            }

            // Add the second order to the kitchen queue
            KitchenQueue::create([
                'order_id' => $order->id,
                'order_received_time' => Carbon::now(),
                'status' => 'Pending',
            ]);
        }
    }
}
