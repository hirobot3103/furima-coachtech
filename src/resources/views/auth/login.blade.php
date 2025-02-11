@extends('layouts.cmn')

@section('subtitle', 'ログイン画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset( '/assets/css/login.css' ) }}">
@endsection

@section('page-main')
    <header class="page-header">
        <div class="page-logo">
            <a href="/">
                <img src="{{ asset('/assets/img/logo.svg') }}" alt="ロゴ COACHTECH">
            </a>
        </div>
    </header>

    <main class="contents">
        <div class="contents-area">
            <p class="sell-title">ログイン</p>
            <form class="sell-form" action="/login" method="post">
                @csrf
                <section class="item-detail-area">
                    <p class="iteme-name-title">メールアドレス</p>
                    <input type="text" class="item-name" name="email" value="{{ old( 'email' ) }}">
                    @if ($errors->has('email'))
                        @foreach($errors->get('email') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
                    <p class="iteme-name-title">パスワード</p>
                    <input type="password" class="item-prace" name="password">
                    @if ($errors->has('password'))
                        @foreach($errors->get('password') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
                </section>
                <button class="item-post-btn" type="submit">ログインする</button>
            </form>
            <a href="/register" class="register-link">会員登録はこちら</a>
        </div>   
    </main>

@endsection