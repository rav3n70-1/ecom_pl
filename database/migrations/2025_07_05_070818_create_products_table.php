<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Product name
            $table->string('slug')->unique(); // URL-friendly slug
            $table->text('description')->nullable(); // Detailed product description
            $table->decimal('price', 8, 2); // Price with 8 total digits and 2 decimal places
            $table->unsignedInteger('stock')->default(0); // Stock quantity
            $table->string('image')->nullable(); // Path to the product image

            // Foreign key for the category
            $table->foreignId('category_id')
                  ->constrained('categories') // Ensures it references the 'id' on the 'categories' table
                  ->onDelete('cascade'); // If a category is deleted, its products are also deleted

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
