<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'category', 'stock', 'price', 'image_path'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function updateRating()
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_reviews = $this->reviews()->count();
        $this->save();
    }
}