<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_date', 'total_price', 'status', 'notes', 'rental_status'
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function return()
    {
        return $this->hasOne(Returns::class);
    }

    public function approve()
    {
        $this->status = 'approved';
        $this->save();
    }

    public function complete()
    {
        $this->status = 'completed';
        $this->save();
    }

    public function cancel()
    {
        $this->status = 'cancelled';
        $this->save();
    }
}