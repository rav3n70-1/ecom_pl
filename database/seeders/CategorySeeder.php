<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // <-- Import the Category model
use Illuminate\Support\Str; // <-- Import the Str facade for generating slugs

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the categories to be created
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Find the latest and greatest in electronic gadgets.'
            ],
            [
                'name' => 'Books',
                'description' => 'Discover new worlds in our vast collection of books.'
            ],
            [
                'name' => 'Home Goods',
                'description' => 'Everything you need to make your house a home.'
            ],
        ];

        // Loop through the categories and create them in the database
        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']), // Generate a URL-friendly slug
                'description' => $category['description'],
            ]);
        }
    }
}
