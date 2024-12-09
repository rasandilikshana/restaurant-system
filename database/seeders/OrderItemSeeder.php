<?php

namespace Database\Seeders;

use App\Models\Concession;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Fetch some existing orders, menu items, and concessions (assuming they exist)
       $orders = Order::all();
       $menuItems = MenuItem::all();
       $concessions = Concession::all();

       foreach ($orders as $order) {
           foreach ($menuItems as $menuItem) {
               $quantity = rand(1, 3); // Random quantity between 1 and 3
               $price = $menuItem->price;
               $totalPrice = $price * $quantity;

               // Check if a concession is applied, assign one randomly
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
