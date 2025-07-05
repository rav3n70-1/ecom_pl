<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // <-- Import the Product model
use App\Models\Category; // <-- Import the Category model
use Illuminate\Support\Str; // <-- Import the Str facade

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Find the categories we created earlier
        $electronics = Category::where('slug', 'electronics')->first();
        $books = Category::where('slug', 'books')->first();
        $homeGoods = Category::where('slug', 'home-goods')->first();

        // Define sample products
        $products = [
            [
                'name' => 'Laptop Pro',
                'description' => 'A high-performance laptop for all your needs.',
                'price' => 1299.99,
                'stock' => 50,
                'category_id' => $electronics->id,
            ],
            [
                'name' => 'Smartphone X',
                'description' => 'The latest smartphone with amazing features.',
                'price' => 799.99,
                'stock' => 150,
                'category_id' => $electronics->id,
            ],
            [
                'name' => 'The Laravel Journey',
                'description' => 'An epic tale of a developer learning Laravel.',
                'price' => 29.99,
                'stock' => 300,
                'category_id' => $books->id,
            ],
            [
                'name' => 'Cozy Blanket',
                'description' => 'A warm and comfortable blanket for your home.',
                'price' => 49.99,
                'stock' => 200,
                'category_id' => $homeGoods->id,
            ],
        ];

        // Create the products in the database
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category_id' => $product['category_id'],
            ]);
        }
    }
}
