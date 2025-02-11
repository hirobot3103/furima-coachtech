@extends('layouts.cmn')

@section('subtitle', 'マイページ画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/prof.css') }}">
@endsection

@section('page-main')
<body>
    <x-header>
        <x-slot name="keyword">{{ $urlData['keyword'] }}</x-slot>
    </x-header>
    
    <main class="contents">
        <div class="prof-area">
            <img class="prof-img" src="{{ $profileData['img_url'] }}" alt="プロフィール画像">
            <p class="user-mane">{{ $profileData['name'] }}</p>
            <a href="/mypage/profile" class="prof-link">プロフィールを編集</a>
        </div>
        <ul>
            @if ( !empty($urlData['keyword']))
                @php
                    $searchParam = "&keyword=" . $urlData['keyword']; 
                @endphp
            @else
                @php
                    $searchParam = "";
                @endphp
            @endif
            @if ($urlData['tag'] == "1")
                <li><a href="/mypage?tag=sell{{$searchParam}}"><span class="contents__current-page" >出品した商品</span></a></li>
                <li><a href="/mypage?tag=buy{{$searchParam}}""><span>購入した商品</span></a></li>                
            @else
                <li><a href="/mypage?tag=sell{{$searchParam}}""><span>出品した商品</span></a></li>
                <li><a href="/mypage?tag=buy{{$searchParam}}""><span class="contents__current-page">購入した商品</span></a></li>                        
            @endif
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
                            <span>Sold</span>
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
    <script>
        const form = document.querySelector("#search-box");

        async function sendData() {
                
            const keyword = document.getElementById("kw");
            const url = "{{$urlData['locationUrl']}}&keyword=" + keyword.value;
            location.href = url;
        }

        form.addEventListener("submit", (event) => {
            event.preventDefault();    
            sendData();
        });

    </script>
@endsection