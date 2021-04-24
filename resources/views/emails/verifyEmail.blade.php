@extends('layouts.mail')
@section('main')
    <h1 class='logo'>
        <a href="{{ config('frontend.url') }}"><img src="{{ config('frontend.url') }}/img/logo.png"></a>
    </h1>
    <p class='text'>
        下記のボタンをクリックし、メールアドレスを認証してください。<br>
    </p>
    <p class='caption'>
        もしお心当たりのない場合、本メールは破棄して頂けるようお願いいたします。
    </p>
    <p>
        <a href="{{ $actionUrl }}" class='button'><img src="{{ config('frontend.url') }}/img/button_mailVerify.png"></a>
    </p>
@endsection
