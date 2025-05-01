<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Tambahkan konstanta role
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'Telepon',
        'alamat',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
