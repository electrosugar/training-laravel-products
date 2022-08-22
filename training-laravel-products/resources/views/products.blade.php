@extends('layout')

@section('content')
    <body>
    @foreach($products as $product)
        <div class="product">
            <img src="{{$product->image_path}}" alt="{{$product->image_path}}">
            <h1 class="title">
                {{$product->title  . $product->id}}
            </h1>
            <span class="description">
                {{$product->description}}
            </span>
            <span class="price">
                {{$product->price}} $
            </span>
        </div>
        <form action="{{url('products')}}" method="POST" id="product-delete">
            @csrf
            <input type="hidden" name="productID" value="{{$product->id}}">
            <button id="btn-submit" type="submit">Delete product</button>
        </form>
        <a href="{{url('product?editProduct='.$product->id)}}">Edit Item</a>
    @endforeach
    <br>
    <a href="{{url('product')}}">Add Item</a>
@endsection
