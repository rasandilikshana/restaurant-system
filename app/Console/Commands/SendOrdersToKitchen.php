<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\KitchenQueue;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendOrdersToKitchen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-orders-to-kitchen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send orders to the kitchen based on the scheduled time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current time
        $currentTime = Carbon::now();

        // Get all orders where send_to_kitchen_time is in the past and status is not yet 'Sent to Kitchen'
        $ordersToSend = Order::where('send_to_kitchen_time', '<=', $currentTime)
                             ->where('status', '!=', 'Sent to Kitchen')
                             ->get();

        // Loop through each order and send it to the kitchen
        foreach ($ordersToSend as $order) {
            // Send the order to the kitchen (update status and add to the KitchenQueue)
            $order->sendToKitchen();

            // Optionally, you can log or notify about the orders being sent
            $this->info("Order {$order->order_id} sent to kitchen.");

            // Create a record in the kitchen queue
            KitchenQueue::create([
                'order_id' => $order->id,
                'order_received_time' => now(),
                'status' => 'Pending',
            ]);
        }
    }
}
