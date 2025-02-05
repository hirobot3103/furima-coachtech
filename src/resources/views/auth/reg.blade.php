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
        <form action="" class="page-search">
            <input type="text" name="keyword" id="kw" class="page-input-keyword" placeholder="なにをお探しですか？">
        </form>
        <nav class="page-menu">
            <ul>
            @if (Auth::check())
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
                @else
                <li><a href="/login">ログイン</a></li>
                @endif
                <li><a href="/mypage">マイページ</a></li>
                <li><a class="page-menu__listing" href="/sell">出品</a></li>
            </ul>
        </nav>
    </header>

    <main class="contents">
        <div class="contents-area">
            <p class="sell-title">会員登録</p>
            <form class="sell-form" action="/register" method="post">
                @csrf
                <section class="item-detail-area">
                    <p class="iteme-name-title">メールアドレス</p>
                    <input type="text" class="item-name" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div>{{ $message }}</div>
                    @enderror
                    <p class="iteme-name-title">パスワード</p>
                    <input type="password" class="item-name" name="password">
                    <p class="iteme-name-title">確認用パスワード</p>
                    <input type="password" class="item-prace" name="password_confirmation">
                    @error('password')
                    <div>{{ $message }}</div>
                    @enderror
                </section>
                <button class="item-post-btn" type="submit">登録する</button>
            </form>
            <a href="/login" class="register-link">ログインはこちら</a>
        </div>   
    </main>
@endsection