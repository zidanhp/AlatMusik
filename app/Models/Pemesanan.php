<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function items()
    {
        return $this->hasMany(ItemPemesanan::class, 'id_pemesanan');
    }
}