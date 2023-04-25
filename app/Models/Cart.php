<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
    protected $fillable = [
        'product_id',
        'product_detail',
        'product_qty',
        'product_price',
        'user_id',
    ];
}
