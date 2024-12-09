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
        $menuItems = [
            [
                'name' => 'Grilled Chicken',
                'description' => 'A delicious grilled chicken served with vegetables.',
                'price' => 12.99,
                'available' => true,
                'category' => 'Main Course',
                'image' => 'grilled_chicken.jpg'
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'A fresh Caesar salad with crispy croutons and creamy dressing.',
                'price' => 8.99,
                'available' => true,
                'category' => 'Salads',
                'image' => 'caesar_salad.jpg'
            ],
            [
                'name' => 'Vegetable Soup',
                'description' => 'A healthy and warm vegetable soup made with fresh ingredients.',
                'price' => 6.49,
                'available' => true,
                'category' => 'Soup',
                'image' => 'vegetable_soup.jpg'
            ],
            [
                'name' => 'Cheeseburger',
                'description' => 'A juicy beef patty with melted cheese, served with fries.',
                'price' => 10.99,
                'available' => true,
                'category' => 'Main Course',
                'image' => 'cheeseburger.jpg'
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'A rich and moist chocolate cake topped with creamy chocolate frosting.',
                'price' => 4.99,
                'available' => true,
                'category' => 'Dessert',
                'image' => 'chocolate_cake.jpg'
            ]
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }
    }
}
