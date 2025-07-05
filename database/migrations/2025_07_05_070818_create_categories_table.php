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
        // Creates the 'categories' table with the specified columns.
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary key (auto-incrementing integer)
            $table->string('name'); // Name of the category (e.g., "Electronics")
            $table->string('slug')->unique(); // URL-friendly version of the name
            $table->text('description')->nullable(); // Optional description for the category
            $table->timestamps(); // 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drops the 'categories' table if the migration is rolled back.
        Schema::dropIfExists('categories');
    }
};
