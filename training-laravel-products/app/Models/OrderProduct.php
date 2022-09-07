<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'order_product';
    protected $fillable = [
        'id_product',
        'id_order',
        'price'
    ];
}
