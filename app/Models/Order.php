<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = []; // Mengizinkan semua kolom diisi

    // Relasi ke tabel Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}