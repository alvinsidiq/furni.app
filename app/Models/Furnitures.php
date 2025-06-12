<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Furnitures extends Model
{
    protected $fillable = ['name', 'price', 'image', 'description', 'stock'];
}