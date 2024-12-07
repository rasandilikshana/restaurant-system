<?php

namespace Database\Seeders;

use App\Models\Concession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Concession::create([
            'name' => 'New Year Discount',
            'description' => 'A special discount for the New Year celebration.',
            'discount_percentage' => 10,
            'valid_from' => '2024-01-01',
            'valid_until' => '2024-01-31',
        ]);

        Concession::create([
            'name' => 'Student Discount',
            'description' => 'A special discount for students.',
            'discount_percentage' => 15,
            'valid_from' => '2024-09-01',
            'valid_until' => '2024-12-31',
        ]);

        Concession::create([
            'name' => 'Happy Hour',
            'description' => 'Discount available during happy hours.',
            'discount_percentage' => 20,
            'valid_from' => '2024-06-01',
            'valid_until' => '2024-06-30',
        ]);
    }
}
