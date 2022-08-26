<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function order($customer){
        $order = Customer::find($customer);
        $totalPrice = 0;
        foreach ($order->products as $product){
            $totalPrice += $product->price;
        }
        $order->totalPrice = $totalPrice;
        return $order;
    }
}
