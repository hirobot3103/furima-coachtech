@extends('layouts.cmn')

@section('subtitle', '画面一覧')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/top.css') }}">
@endsection

@section('page-main')
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
        <ul>
            <li><span class="contents__current-page">おすすめ</span></li>
            <li><span>マイリスト</span></li>
        </ul>
        <hr>
        <section class="contents__lists-area">

        <ul class="contents__lists">
            @foreach ($item_data as $item)
                @php
                    $soldout_class = "";
                @endphp  
                <li class="contents__item">

                    <a href="/item/{{$item['id']}}" class="item-detail__link">
                    
                    @if ( $item['soldout'] == 1)
                    <div class="item-sold-out__discript">
                        <span>SOLD OUT</span>
                    </div>
                    
                        @php
                            $soldout_class = "item-sold-out__img";
                        @endphp
                    @endif
                    <img class="{{ $soldout_class }}" src="{{ asset($item['img_url']) }}" alt="商品名:{{ $item['item_name'] }}">
                    <p>{{ $item['item_name'] }}</p>
                    </a>
                </li>
            @endforeach  
            </ul>
        </section>
    </main>
@endsection