@extends('layouts.cmn')

@section('subtitle', '登録画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/reg.css') }}">
@endsection

@section('page-main')
    <header class="page-header">
        <div class="page-logo">
            <a href="/" class="page-logo">
                <img src="{{ asset('/assets/img/logo.svg') }}" alt="ロゴ COACHTECH">
            </a>
        </div>
    </header>

    <main class="contents">
        <div class="contents-area">
            <p class="sell-title">会員登録</p>
            <form class="sell-form" action="/register" method="post">
                @csrf
                <section class="item-detail-area">
                    <p class="iteme-name-title">お名前</p>
                    <input type="text" class="item-name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        @foreach($errors->get('name') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
                    <p class="iteme-name-title">メールアドレス</p>
                    <input type="text" class="item-name" name="email" value="{{ old('email') }}">
<<<<<<< HEAD
                    @if ($errors->has('email'))
                        @foreach($errors->get('email') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
=======
                    @error('email')
                    <div>{{ $message }}</div>
                    @enderror
>>>>>>> dfae482d2a9bff2985c4ae3696cc1e7bc9127f41
                    <p class="iteme-name-title">パスワード</p>
                    <input type="password" class="item-name" name="password">
                    @if ($errors->has('password'))
                        @foreach($errors->get('password') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
                    <p class="iteme-name-title">確認用パスワード</p>
                    <input type="password" class="item-prace" name="password_confirmation">
<<<<<<< HEAD
                    @if ($errors->has('password_confirmation'))
                        @foreach($errors->get('password_confirmation') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
=======
                    @error('password')
                    <div>{{ $message }}</div>
                    @enderror
>>>>>>> dfae482d2a9bff2985c4ae3696cc1e7bc9127f41
                </section>
                <button class="item-post-btn" type="submit">登録する</button>
            </form>
            <a href="/login" class="register-link">ログインはこちら</a>
        </div>   
    </main>
@endsection