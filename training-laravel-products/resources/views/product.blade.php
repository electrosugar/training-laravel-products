@extends('layout')

@section('content')
    <h1>{{isset($id) ? __('Editing Product #') . $id : __('Creating new product')}}</h1>
    <form enctype="multipart/form-data" action="{{url('product/' . $value = isset($id) ? $id : '')}}" method="post"
          class="form-group">
        @if(session()->has('message'))
            <div class="alert success">
                {{ session()->get('message') }}
            </div>
        @endif
        @csrf
        <input type="text" name="title" placeholder="{{__('Title') }}" value="{{old('title')}}"><br>
            @error('title')
            <div class="error"> {{$message}} </div>
            @enderror
        <input type="text" name="description" placeholder="{{__('Description') }}"
               value="{{old('description')}}"><br>
            @error('description')
            <div class="error"> {{$message}} </div>
            @enderror
        <input type="text" name="price" placeholder="{{__('Price') }}"
               value="{{old('price')}}"><br>
            @error('price')
            <div class="error"> {{$message}} </div>
            @enderror
        <input type="file" name="image"><br>
            @error('image')
            <div class="error"> {{$message}} </div>
            @enderror
        <span class="formLinks"> <input type="submit" value="Save"></span>
    </form>
    <a href="{{url('products')}}">{{__('See Items')}}</a>

@endsection
