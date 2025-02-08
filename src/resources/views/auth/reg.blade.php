@extends('layouts.cmn')

@section('subtitle', '登録画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/reg.css') }}">
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
            <p class="sell-title">会員登録</p>
            @foreach ($errors->all() as $error)
            <li class="validatin-error__area">&#x274C;&emsp;{{$error}}</li>
            @endforeach
            <form class="sell-form" action="/register" method="post">
                @csrf
                <section class="item-detail-area">
                    <p class="iteme-name-title">メールアドレス</p>
                    <input type="text" class="item-name" name="email" value="{{ old('email') }}">
                    <p class="iteme-name-title">パスワード</p>
                    <input type="password" class="item-name" name="password">
                    <p class="iteme-name-title">確認用パスワード</p>
                    <input type="password" class="item-prace" name="password_confirmation">
                </section>
                <button class="item-post-btn" type="submit">登録する</button>
            </form>
            <a href="/login" class="register-link">ログインはこちら</a>
        </div>   
    </main>
@endsection