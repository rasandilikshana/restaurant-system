<?php

namespace Database\Seeders;

use App\Models\Concession;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StaffMember;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffMember1 = StaffMember::find(1); // Assuming staff member with ID 1 exists
        $staffMember2 = StaffMember::find(2); // Assuming staff member with ID 2 exists

        if ($staffMember1 && $staffMember2) {
            // Create Order 1
            $order1 = Order::create([
                'staff_member_id' => $staffMember1->id,
                'customer_name' => 'Alice Johnson',
                'total_amount' => 25.98,
                'order_time' => Carbon::now(),
                'send_to_kitchen_time' => Carbon::now()->addMinutes(10),
                'status' => 'Pending',
            ]);

            // Create Order 2
            $order2 = Order::create([
                'staff_member_id' => $staffMember2->id,
                'customer_name' => 'Bob Williams',
                'total_amount' => 15.99,
                'order_time' => Carbon::now(),
                'send_to_kitchen_time' => Carbon::now()->addMinutes(15),
                'status' => 'In Progress',
            ]);

            // Create Order Items for these Orders
            $this->createOrderItems($order1, $order2);
        }
    }

    /**
     * Create Order Items for the given orders
     */
    private function createOrderItems($order1, $order2)
    {
        // Fetch existing menu items and concessions
        $menuItem1 = MenuItem::find(1); // Assuming Grilled Chicken exists with ID 1
        $menuItem2 = MenuItem::find(2); // Assuming Vegetable Curry exists with ID 2
        $concession1 = Concession::find(1); // Assuming New Year Discount exists with ID 1
        $concession2 = Concession::find(2); // Assuming Student Discount exists with ID 2

        if ($menuItem1 && $menuItem2) {
            // Create order items for Order 1
            OrderItem::create([
                'order_id' => $order1->id, // Reference to Order ID 1
                'menu_item_id' => $menuItem1->id, // Reference to Menu Item 1 (Grilled Chicken)
                'concession_id' => $concession1->id, // Optional: Reference to Concession 1
                'quantity' => 2,
                'price' => 12.99,
                'total_price' => 25.98,
            ]);

            // Create order items for Order 2
            OrderItem::create([
                'order_id' => $order2->id, // Reference to Order ID 2
                'menu_item_id' => $menuItem2->id, // Reference to Menu Item 2 (Vegetable Curry)
                'concession_id' => $concession2->id, // Optional: Reference to Concession 2
                'quantity' => 1,
                'price' => 8.99,
                'total_price' => 8.99,
            ]);
        }
    }
}
