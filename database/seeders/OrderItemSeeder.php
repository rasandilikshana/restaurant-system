<?php

namespace Database\Seeders;

use App\Models\Concession;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch orders, menu items, and concessions (ensure data exists before seeding)
        $orders = Order::all();
        $menuItems = MenuItem::all();
        $concessions = Concession::all();

        if ($orders->isEmpty()) {
            echo "No orders found. Please run the OrderSeeder first.";
            return;
        }

        if ($menuItems->isEmpty()) {
            echo "No menu items found. Please run the MenuItemSeeder first.";
            return;
        }

        foreach ($orders as $order) {
            // Randomly select menu items for each order
            foreach ($menuItems->random(2) as $menuItem) { // Randomly select 2 menu items per order
                $quantity = rand(1, 3);
                $price = $menuItem->price;
                $totalPrice = $price * $quantity;

                // Randomly select a concession
                $concession = $concessions->isNotEmpty() ? $concessions->random() : null;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'concession_id' => $concession ? $concession->id : null, // Handle nullable concession_id
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $totalPrice,
                ]);
            }
        }
    }
}
