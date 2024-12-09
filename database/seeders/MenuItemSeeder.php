<?php

namespace Database\Seeders;

use App\Models\Category;
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
        // Fetch categories from the database (these should already exist)
        $categories = Category::all();

        // Seed some menu items
        MenuItem::create([
            'name' => 'Pizza Margherita',
            'description' => 'Classic pizza with tomato sauce, mozzarella, and basil.',
            'image' => 'pizza-margherita.jpg',
            'price' => 12.99,
            'available' => true,
            'category' => $categories->where('name', 'Main Course')->first()->name, // Use category name instead of category_id
        ]);

        MenuItem::create([
            'name' => 'Spaghetti Carbonara',
            'description' => 'Pasta with creamy carbonara sauce, bacon, and parmesan.',
            'image' => 'spaghetti-carbonara.jpg',
            'price' => 15.99,
            'available' => true,
            'category' => $categories->where('name', 'Main Course')->first()->name, // Use category name instead of category_id
        ]);

        MenuItem::create([
            'name' => 'Caesar Salad',
            'description' => 'Fresh lettuce, croutons, and Caesar dressing.',
            'image' => 'caesar-salad.jpg',
            'price' => 7.99,
            'available' => true,
            'category' => $categories->where('name', 'Salads')->first()->name, // Use category name instead of category_id
        ]);

        MenuItem::create([
            'name' => 'Lemonade',
            'description' => 'Refreshing lemonade made with fresh lemons.',
            'image' => 'lemonade.jpg',
            'price' => 3.99,
            'available' => true,
            'category' => $categories->where('name', 'Beverage')->first()->name, // Use category name instead of category_id
        ]);
    }
}
