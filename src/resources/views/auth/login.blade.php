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
            <p class="sell-title">ログイン</p>
            @foreach ($errors->all() as $error)
            <li class="validatin-error__area">&#x274C;&emsp;{{$error}}</li>
            @endforeach
            <form class="sell-form" action="/login" method="post">
                @csrf
                <section class="item-detail-area">
                    <p class="iteme-name-title">メールアドレス</p>
                    <input type="text" class="item-name" name="email" value="{{ old( 'email' ) }}">
<<<<<<< HEAD
                    @error('email')
                    <div>{{ $message }}</div>
                    @enderror

=======
>>>>>>> db7eefb0901e2a6b8f1295c49da99ea8e42c7aa3
                    <p class="iteme-name-title">パスワード</p>
                    <input type="password" class="item-prace" name="password">
                    @error('password')
                    <div>{{ $message }}</div>
                    @enderror
                </section>
                <button class="item-post-btn" type="submit">ログインする</button>
            </form>
            <a href="/register" class="register-link">会員登録はこちら</a>
        </div>   
    </main>

@endsection