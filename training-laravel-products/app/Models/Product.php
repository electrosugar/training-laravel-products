<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'price',
        'image_path'
    ];
    public $id;
    public $title;
    public $description;
    public $price;
    public $image_path;

    public function __construct($id, $title, $description, $price, $image_path)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->image_path = $image_path;
        return $this;
    }

    public static function find($id)
    {
        $product = DB::table('products')->select('*')->where('id', $id)->get();

        if (!$product) {
            throw new ModelNotFoundException();
        }

        return $product;
    }

    public static function allProducts()
    {
        $allProducts = DB::table('products')->select('*')->get();

        if (!$allProducts) {
            throw new ModelNotFoundException();
        }

        return $allProducts;
    }

    public static function notInCart()
    {
        if (Session::has('cart')) {
            $indexProducts = DB::table('products')->select('*')->whereNotIn('id', Session::get('cart'))->get();
        } else {
            $indexProducts = DB::table('products')->select('*')->get();
        }

        if (!$indexProducts) {
            throw new ModelNotFoundException();
        }

        return $indexProducts;
    }

    public static function inCart()
    {
        if (Session::has('cart')) {
            $indexProducts = DB::table('products')->select('*')->whereIn('id', Session::get('cart'))->get();
        } else {
            $indexProducts = DB::table('products')->select('*')->get();
        }

        if (!$indexProducts) {
            throw new ModelNotFoundException();
        }

        return $indexProducts;

    }

}
