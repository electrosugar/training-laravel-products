<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        return view('index', ['products' => (Product::notInCart())]);
    }

    public function products()
    {
        return view('products', ['products' => Product::allProducts()]);
    }

    public function cart()
    {
        return view('cart', ['products' => Product::inCart()]);
    }

    public function add(Request $request)
    {
        Session::push('cart', $request->productID);
        return redirect('index');
    }

    public function remove(Request $request)
    {
        $cartSession = Session::get('cart');
        while (($key = array_search($request->productID, $cartSession)) !== false) {
            unset($cartSession[$key]);
        }
        Session::put('cart', $cartSession);
        Session::save();
        return redirect('cart');
    }

    public function delete(Request $request)
    {
        DB::table('products')->limit(1)->delete($request->productID);
        $allProducts = DB::table('products')->select('*')->get();
        return view('products', ['products' => $allProducts]);
    }

    public function edit(Request $request, int $id)
    {
        $updateAssocArray = [];
        if ($title = $request->input('title')) {
            $updateAssocArray['title'] = $title;
        }
        if ($description = $request->input('description')) {
            $updateAssocArray['description'] = $description;
        }
        if ($price = $request->input('price')) {
            $updateAssocArray['price'] = $price;
        }

        if ($image = $request->file('image')) {
            $image_path = 'storage\images\\' . $request->file('image')->hashName();
            $request->file('image')->store('public/images');
            $updateAssocArray['image_path'] = $image_path;
        }
        if ($updateAssocArray) {
            DB::table('products')->where('id', $id)->limit(1)->update($updateAssocArray);
        }
        return view('product');

    }

    public function insert(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $price = $request->input('price');
        if ($image = $request->file('image')) {
            $image_path = 'storage\images\\' . $request->file('image')->hashName();
            $request->file('image')->store('public/images');

            DB::table('products')->insert([
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'image_path' => $image_path
            ]);
        }

        return view('product');

    }

}
