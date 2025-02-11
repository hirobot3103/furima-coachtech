@extends('layouts.cmn')

@section('subtitle', 'マイページ画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/prof.css') }}">
@endsection

@section('page-main')
<body>
    <header class="page-header">
        <div class="page-logo" class="page-logo">
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
        <div class="prof-area">
            <img class="prof-img" src="{{ $profileData['img_url'] }}" alt="プロフィール画像">
            <p class="user-mane">{{ $profileData['name'] }}</p>
            <a href="/mypage/profile" class="prof-link">プロフィールを編集</a>
        </div>
        <ul>
            <li><a href="/mypage?tag=sell"><span>出品した商品</span></a></li>
            <li><a href="/mypage?tag=buy"><span class="contents__current-page" >購入した商品</span></a></li>
        </ul>
        <hr>
        <section class="contents__lists-area">
        <ul class="contents__lists">
            @foreach ($itemData as $item)

            @php
                $soldOutClass = "";
            @endphp  

                <li class="contents__item">

                    <a href="/item/{{$item['id']}}" class="item-detail__link">
                        
                        @if ( $item['soldout'] == 1)
                        <div class="item-sold-out__discript">
                            <span>SOLD</span>
                        </div>
                        
                        @php
                            $soldOutClass = "item-sold-out__img";
                        @endphp
                        @endif

                        <img class="{{ $soldOutClass }}" src="{{ asset($item['img_url']) }}" alt="商品名:{{ $item['item_name'] }}">
                        <p>{{ $item['item_name'] }}</p>

                    </a>

                </li>
                @endforeach  
            </ul>
        </section>
    </main>
@endsection