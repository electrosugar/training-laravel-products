<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= __('Order') ?></title>
</head>
<body>
<div>
    <div>
        <h1>{{__('Order # ') . $order->id . __(' has been recorded')}}</h1>
        <div class="product">
            <div class="info">
                <span class="title">{{__('Name: ') . $order->name}}</span>
                <br>
                <span class="description">{{__('Contact: ') . $order->contact}}</span>
                <br>
                <span class="price">{{__('Comment: ') . $order->comment}}</span>
                <br>
                <span class="date">{{__('Date: ') . $order->creation_date}}</span>
                <br>
            </div>
            <span>{{__('Total Price: ') . $order->totalPrice}}</span>
        </div>
        <div class="selectedProducts">
            @foreach($order->products->toArray() as $product)
                <div class="product">
                    <img src="{{isset($message) ? $message->embed($product['image_path']) : asset($product['image_path'])}}" alt="{{$product['image_path']}}">
                    <h1 class="title">
                        {{$product['title']  . $product['id']}}
                    </h1>
                    <span class="description">
                {{$product['description']}}
            </span>
                    <span class="price">
                {{$product['price']}} $
            </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
<a href={{url('cart')}}><?= __('Go to cart') ?></a>
<a href={{url('index')}}><?= __('Go to index') ?></a>
</body>
