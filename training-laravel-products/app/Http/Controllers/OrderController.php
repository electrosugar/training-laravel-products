<?php

namespace App\Http\Controllers;

use App\Mail\MailVendor;
use App\Models\ArchivedProduct;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use PhpParser\Error;
use function Symfony\Component\HttpFoundation\Session\Storage\save;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {

        $validated = $request->validate([
            'name' => 'bail|required|max:255',
            'contact' => 'bail|required|email',
            'comment' => 'required|max:500',
        ]);
        $products = Product::find(Session::get('cart'));
        if (empty(Session::get('cart'))) {
            return redirect()->back()->withInput()->with(['errors'=>new MessageBag(['No products in cart'])]);
        }

        $customer = new Customer();
        $customer->name = $validated['name'];
        $customer->contact = $validated['contact'];
        $customer->comment = $validated['comment'];
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
        Mail::to('razvan.mocanu.5pointsolutions@gmail.com')->send(new MailVendor($customer->id));
        return redirect()->to('order/' . $customer->id);
    }

    public function order($customer)
    {
        $order = Customer::find($customer);
        $totalPrice = 0;
        foreach ($order->products as $product) {
            $totalPrice += $product->price;
        }
        $order->totalPrice = $totalPrice;
        return view('order', ['order' => $order]);
    }


}
