<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id', // atau 'furniture_id' jika kamu pakai itu
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tambahkan relasi ke furniture jika ada
    public function furniture()
    {
        return $this->belongsTo(Furnitures::class);
    }
}
