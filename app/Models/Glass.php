<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Glass extends Model
{
    protected $fillable = [
        'name',
        'category',
        'brand',
        'price',
        'description',
        'image',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];
}