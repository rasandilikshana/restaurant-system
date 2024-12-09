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
            'image' => 'menu-items/01JEP5RADTGKJ6GEZSW4JA0BR3.jpg',
            'price' => 12.99,
            'available' => true,
            'category_id' => $categories->where('name', 'Main Course')->first()->id, // Correctly using category_id
        ]);

        MenuItem::create([
            'name' => 'Spaghetti Carbonara',
            'description' => 'Pasta with creamy carbonara sauce, bacon, and parmesan.',
            'image' => 'menu-items/01JEP5S91CKCNSPF9SJN4FD2YQ.jpg',
            'price' => 15.99,
            'available' => true,
            'category_id' => $categories->where('name', 'Main Course')->first()->id, // Correctly using category_id
        ]);

        MenuItem::create([
            'name' => 'Caesar Salad',
            'description' => 'Fresh lettuce, croutons, and Caesar dressing.',
            'image' => 'menu-items/01JEP5T2VPPB3BSB3KP5507QVN.jpg',
            'price' => 7.99,
            'available' => true,
            'category_id' => $categories->where('name', 'Salads')->first()->id, // Correctly using category_id
        ]);

        MenuItem::create([
            'name' => 'Lemonade',
            'description' => 'Refreshing lemonade made with fresh lemons.',
            'image' => 'menu-items/01JEP5XCHPPVA6P0GX25JB2XMW.jpg',
            'price' => 3.99,
            'available' => true,
            'category_id' => $categories->where('name', 'Beverage')->first()->id, // Correctly using category_id
        ]);
    }
}
