<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Predefined categories for the menu items
        $categories = [
            'Appetizer',
            'Main Course',
            'Dessert',
            'Beverage',
            'Salads',
            'Soup',
            'Sides',
            'Specials',
        ];

        // Insert each category into the categories table
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
