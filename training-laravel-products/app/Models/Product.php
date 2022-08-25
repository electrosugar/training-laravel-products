<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\String\__construct;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'price',
        'image_path'
    ];
//    public $id;
//    public $title;
//    public $description;
//    public $price;
//    public $image_path;


    public static function create($properties)
    {
        $product = new Product();
        $product->id = $properties->id;
        $product->title = $properties->title;
        $product->description = $properties->description;
        $product->price = $properties->price;
        $product->image_path = $properties->image_path;
        return $product;
    }

//    public function save(array $options = [])
//    {
//        DB::table('products')->insert([
//            'title' => $this->title,
//            'description' => $this->description,
//            'price' => $this->price,
//            'image_path' => $this->image_path
//        ]);
//    }

//    public static function find($id)
//    {
//        $product = DB::table('products')->select('*')->where('id', $id)->get();
//
//        if (!$product) {
//            throw new ModelNotFoundException();
//        }
//
//        return $product;
//    }

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
            $indexProducts = Product::whereNotIn('id', Session::get('cart'))->get();
        } else {
            throw new ModelNotFoundException();
        }

        return $indexProducts;
    }

    public static function inCart()
    {
        if (Session::has('cart')) {
            $cartProducts = Product::whereIn('id', Session::get('cart'))->get();
        } else {
            throw new ModelNotFoundException();
        }

        if (!$cartProducts) {
            throw new ModelNotFoundException();
        }

        return $cartProducts;

    }

}
