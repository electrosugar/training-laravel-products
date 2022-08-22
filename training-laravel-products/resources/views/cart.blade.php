@extends('layout')

@section('content')
    @foreach($products as $product)
        <div class="product">
            <img src="{{$product->image_path}}">
            <h1 class="title">
                {{$product->title . $product->id}}
            </h1>
            <span class="description">
                    {{$product->description}}
            </span>
            <span class="price">
                    {{$product->price}} $
            </span>
        </div>
        <form action="{{url('cart')}}" method="POST" id="product-remove">
            @csrf
            <input type="hidden" name="productID" value="{{$product->id}}">
            <button id="btn-submit" type="submit">Remove from cart</button>
        </form>
    @endforeach
    <a href="{{ url('index') }}" >Go to index</a>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#product-remove").submit(function (e) {
                $("#btn-submit").attr("disabled", true);
                return true;
            });
        });
    </script>
@endsection
