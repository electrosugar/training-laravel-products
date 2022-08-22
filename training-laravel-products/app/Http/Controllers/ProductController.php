<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(){
        $indexProducts = DB::table('products')->select('*')->whereNotIn('id', Session::get('cart'))->get();
        return view('index', ['products' => ($indexProducts->toArray())]);
    }

    public function products(){
        $allProducts = DB::table('products')->select('*')->get();
        return view('products', ['products' => $allProducts]);
    }

    public function cart(){
        $cartProducts = DB::table('products')->select('*')->whereIn('id', Session::get('cart'))->get();
        return view('cart', ['products' => ($cartProducts->toArray())]);
    }

    public function add(Request $request){
        Session::push('cart', $request->productID);
        return redirect('index');
    }

    public function remove(Request $request){
        $cartSession = Session::get('cart');
        while (($key = array_search($request->productID, $cartSession)) !== false) {
            unset($cartSession[$key]);
        }
        Session::put('cart', $cartSession);
        Session::save();
        return redirect('cart');
    }

    public function delete(Request $request){
        DB::table('products')->limit(1)->delete($request->productID);
        $allProducts = DB::table('products')->select('*')->get();
        return view('products', ['products' => $allProducts]);
    }

    public function edit(Request $request){

    }

}
