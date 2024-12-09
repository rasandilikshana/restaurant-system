<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique()->nullable(); // Use auto-generated or custom order ID logic
            $table->foreignId('staff_member_id')->constrained()->onDelete('cascade');  // Reference to staff_members
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('table_number')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->timestamp('order_time')->default(now());
            $table->timestamp('send_to_kitchen_time')->nullable(); // Set null until sent to kitchen
            $table->enum('status', ['Pending', 'Preparing', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
