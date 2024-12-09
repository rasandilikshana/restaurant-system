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
        Schema::table('orders', function (Blueprint $table) {
            // Remove the old table_number column if it's no longer needed
            $table->dropColumn('table_number');

            // Add a foreign key to reference the tables table
            $table->unsignedBigInteger('table_id')->nullable();  // Ensure unsignedBigInteger
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['table_id']);
            $table->string('table_number')->nullable();
        });
    }
};
