<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = [
        'order_id', 'return_date', 'condition', 'notes', 'fine'
    ];

    protected $casts = [
        'return_date' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}