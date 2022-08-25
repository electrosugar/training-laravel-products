<?php

namespace App\Http\Controllers;

use App\Models\ArchivedProduct;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use function Symfony\Component\HttpFoundation\Session\Storage\save;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $products = Product::find(Session::get('cart'));
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->contact = $request->contact;
        $customer->comment = $request->comment;
        $customer->save();

        foreach ($products as $product) {
            $archivedProduct = new ArchivedProduct();
            $archivedProduct->title = $product->title;
            $archivedProduct->description = $product->description;
            $archivedProduct->price = $product->price;
            $archivedProduct->image_path = 'storage\images\A' . Str::random(10) . microtime() . '.jpg';
            File::copy($product->image_path, $archivedProduct->image_path);
            $archivedProduct->save();

            $order = new Order();
            $order->archived_product_id = $archivedProduct->id;
            $order->customer_id = $customer->id;
            $order->save();
        }

        $totalPrice = 0;
        foreach ($customer->products as $product) {
            $totalPrice += $product->price;
        }
        $customer->totalPrice = $totalPrice;
        return redirect()->to('/order/'.$customer->id);
    }

    public function mailOrder($order){

    }

    public function order($customer)
    {
        $order = Customer::find($customer);
        $totalPrice = 0;
        foreach ($order->products as $product){
            $totalPrice += $product->price;
        }
        $order->totalPrice = $totalPrice;
        return view('order', ['order' => $order]);
    }

}
