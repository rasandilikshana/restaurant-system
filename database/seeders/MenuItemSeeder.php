<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::create([
            'name' => 'Grilled Chicken',
            'description' => 'A delicious grilled chicken served with vegetables.',
            'price' => 12.99,
            'available' => true,
            'category' => 'Main Course',
        ]);

        MenuItem::create([
            'name' => 'Vegetable Curry',
            'description' => 'A flavorful vegetable curry served with rice.',
            'price' => 8.99,
            'available' => true,
            'category' => 'Main Course',
        ]);

        MenuItem::create([
            'name' => 'Caesar Salad',
            'description' => 'A fresh Caesar salad with crispy croutons and dressing.',
            'price' => 7.99,
            'available' => true,
            'category' => 'Starters',
        ]);
    }
}
