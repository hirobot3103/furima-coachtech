@extends('layouts.cmn')

@section('subtitle', 'マイページ画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/prof.css') }}">
@endsection

@section('page-main')
<body>
    <header class="page-header">
        <div class="page-logo">
            <img src="{{ asset('/assets/img/logo.svg') }}" alt="ロゴ COACHTECH">
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
        <div class="prof-area">
            <img class="prof-img" src="./assets/img/prof.jpeg" alt="">
            <p class="user-mane">ユーザー名</p>
            <a href="/mypage/profile" class="prof-link">プロフィールを編集</a>
        </div>
        <ul>
            <li><span>出品した商品</span></li>
            <li><span class="contents__current-page">購入した商品</span></li>
        </ul>
        <hr>
        <section class="contents__lists-area">
            <ul class="contents__lists">
                <li class="contents__item">
                    <img src="./assets/img/test.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/Armani+Mens+Clock.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <div class="item-sold-out__discript">
                        <span>SOLD OUT</span>
                    </div>
                    <img class="item-sold-out__img" src="./assets/img/HDD+Hard+Disk.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/iLoveIMG+d.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/Leather+Shoes+Product+Photo.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <div class="item-sold-out__discript">
                        <span>SOLD OUT</span>
                    </div>
                    <img class="item-sold-out__img" src="./assets/img/Living+Room+Laptop.jpg " alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/Music+Mic+4632231.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/Purse+fashion+pocket.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/Tumbler+souvenir.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/Waitress+with+Coffee+Grinder.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
                <li class="contents__item">
                    <img src="./assets/img/外出メイクアップセット.jpg" alt="商品名">
                    <p>商品名</p>
                </li>
            </ul>
        </section>
    </main>
@endsection