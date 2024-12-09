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
        Category::create(['name' => 'Appetizer']);
        Category::create(['name' => 'Main Course']);
        Category::create(['name' => 'Dessert']);
        Category::create(['name' => 'Beverage']);
        Category::create(['name' => 'Salads']);
        Category::create(['name' => 'Soup']);
        Category::create(['name' => 'Sides']);
        Category::create(['name' => 'Specials']);
    }
}
