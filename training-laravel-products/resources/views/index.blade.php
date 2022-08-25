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
        <form action="{{url('index')}}" method="POST" id="product-add">
            @csrf
            <input type="hidden" name="productID" value="{{$product->id}}">
            <button id="btn-submit" type="submit">Add to cart</button>
        </form>
    @endforeach
    <a href="{{ url('cart') }}">{{__('Go to cart')}}</a>
    <a href="{{ url('login') }}">{{__('Login')}}</a>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#product-add").submit(function (e) {
                $("#btn-submit").attr('disabled', true);
                return true;
            });
        });
    </script>
@endsection

