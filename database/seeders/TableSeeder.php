<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed 10 tables as an example
        foreach (range(1, 10) as $index) {
            Table::create([
                'name' => 'TB' . str_pad($index, 2, '0', STR_PAD_LEFT),  // Table names: TB01, TB02, ...
                'capacity' => rand(2, 6),  // Random capacity between 2 and 6
                'is_available' => true,    // Set tables as available by default
            ]);
        }
    }
}
