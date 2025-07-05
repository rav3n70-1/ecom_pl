<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
    ];

    /**
     * Get the category that owns the product.
     *
     * This defines the inverse of the one-to-many relationship. A product belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
