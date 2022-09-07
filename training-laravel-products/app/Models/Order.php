<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'contact',
        'comment'
    ];

    public static function order($id){
        $order = Order::find($id);
        return $order;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }
}
