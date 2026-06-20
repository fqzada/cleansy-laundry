<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // Relasi ke tabel Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}