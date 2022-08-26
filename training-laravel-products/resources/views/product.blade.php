@extends('layout')

@section('content')
    <h1>{{isset($id) ? __('Editing Product #') . $id : __('Creating new product')}}</h1>
    <form enctype="multipart/form-data" action="{{url('product/' . $value = isset($id) ? $id : '')}}" method="post"
          class="form-group">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <input type="text" name="title" placeholder="{{__('Title') }}" value="{{old('title')}}"><br>
        <input type="text" name="description" placeholder="{{__('Description') }}"
               value="{{$value = isset($_POST['description'])?$_POST['description']:''}}"><br>
        <input type="text" name="price" placeholder="{{__('Price') }}"
               value="{{$value = isset($_POST['price'])?$_POST['price']:''}}"><br>
        <input type="file" name="image"><br>
        <span class="formLinks"> <input type="submit" value="Save"></span>
    </form>
@endsection
