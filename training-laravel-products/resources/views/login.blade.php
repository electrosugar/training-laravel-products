@extends('layout')

@section('content')
    <div class="loginBody">
        <h1>Login</h1>

        <form class="login" method="POST" action="{{url('login')}}" >
            @csrf
            <input type="text" placeholder="<?= __('Username')?>" name="username" value="{{old('username')}}">
            @error('username')
            {{$message}}
            @enderror
            <input type="text" placeholder="<?= __('Password')?>" name="password" value="{{old('password')}}">
            <input type="submit" class="loginInputs" value="Login">
            <a href="{{url('index')}}"><?= __('Anonymous User')?></a>
        </form>
    </div>
@endsection
