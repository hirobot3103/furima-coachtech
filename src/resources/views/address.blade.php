@extends('layouts.cmn')

@section('subtitle', '住所変更画面')

@section('csslink')
<link rel="stylesheet" href="{{ asset('/assets/css/address.css') }}">
@endsection

@section('page-main')
    <header class="page-header">
        <div class="page-logo">
            <a href="/">
                <img src="{{ asset('/assets/img/logo.svg') }}" alt="ロゴ COACHTECH">
            </a>
        </div>
        <form action="/" class="page-search">
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
            <p class="sell-title">住所の変更</p>
            <form class="sell-form" action="/purchase/address/{{ $itemId }}" method="post">
                @csrf
                @method('PATCH')

                @php
                    if( !empty($profileData) ) {
                        $name = $profileData['name'];
                        $postCode = $profileData['post_number'];
                        $address = $profileData['address'];
                        $building = $profileData['building'];
                    } else {
                        $name = old( 'name' );
                        $postCode = old( 'post_number' );
                        $address = old( 'address' );
                        $building = old( 'building' );
                    }
                @endphp
                <section class="item-detail-area">
                    <p class="iteme-name-title">郵便番号</p>
                    <input type="text" class="item-name" name="post_number" value="{{ $postCode }}">
                    @if($errors->has("post_number") )
                        @foreach($errors->get("post_number") as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">住所</p>
                    <input type="text" class="item-prace" name="address" value="{{ $address }}">
                    @if($errors->has("address") )
                        @foreach($errors->get("address") as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">建物名</p>
                    <input type="text" class="item-prace" name="building" value="{{ $building }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="name" value="{{ $name }}">
                </section>
                <button class="item-post-btn" type="submit">更新する</button>
            </form>
        </div>   
    </main>
@endsection