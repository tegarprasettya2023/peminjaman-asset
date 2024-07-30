<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'nama',
        'description',
        'waktu_dipinjam',
        'stock',
    ];

    protected $casts = [
        'waktu_dipinjam' => 'datetime',
    ];
}

