<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StaffMember;
use App\Models\Concession;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $staffMember1 = StaffMember::find(1); // Assuming staff member with ID 1 exists
        $staffMember2 = StaffMember::find(2); // Assuming staff member with ID 2 exists

        if ($staffMember1 && $staffMember2) {
            // Create Order 1
            $order1 = Order::create([
                'staff_member_id' => $staffMember1->id,
                'customer_name' => 'Alice Johnson',
                'customer_phone' => '123-456-7890',
                'customer_email' => 'alice@example.com',
                'total_amount' => 25.98,
                'order_time' => Carbon::now(),
                'send_to_kitchen_time' => Carbon::now()->addMinutes(10),
                'status' => 'Pending',
                'table_number' => 'TB01',
            ]);

            // Create Order 2
            $order2 = Order::create([
                'staff_member_id' => $staffMember2->id,
                'customer_name' => 'Bob Williams',
                'customer_phone' => '098-765-4321',
                'customer_email' => 'bob@example.com',
                'total_amount' => 15.99,
                'order_time' => Carbon::now(),
                'send_to_kitchen_time' => Carbon::now()->addMinutes(15),
                'status' => 'In Progress',
                'table_number' => 'TB02',
            ]);

            // Create Order Items for these Orders
            $this->createOrderItems($order1, $order2);
        }
    }

    private function createOrderItems($order1, $order2)
    {
        // Fetch existing menu items and concessions
        $menuItem1 = MenuItem::find(1);
        $menuItem2 = MenuItem::find(2);
        $concession1 = Concession::find(1);
        $concession2 = Concession::find(2);

        if ($menuItem1 && $menuItem2) {
            OrderItem::create([
                'order_id' => $order1->id,
                'menu_item_id' => $menuItem1->id,
                'concession_id' => $concession1->id,
                'quantity' => 2,
                'price' => 12.99,
                'total_price' => 25.98,
            ]);

            OrderItem::create([
                'order_id' => $order2->id,
                'menu_item_id' => $menuItem2->id,
                'concession_id' => $concession2->id,
                'quantity' => 1,
                'price' => 8.99,
                'total_price' => 8.99,
            ]);
        }
    }
}
