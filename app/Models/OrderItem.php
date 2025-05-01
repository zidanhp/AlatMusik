<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'rent_days', 'price_per_day'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    // Di model Pemesanan
    public function items()
    {
        return $this->hasMany(ItemPemesanan::class, 'id_pemesanan');
    }
}