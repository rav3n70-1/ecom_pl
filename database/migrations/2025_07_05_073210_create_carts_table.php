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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // Foreign key for the user who owns the cart item
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Foreign key for the product being added to the cart
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            $table->unsignedInteger('quantity')->default(1); // The quantity of the product

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
