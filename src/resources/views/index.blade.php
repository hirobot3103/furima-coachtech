@extends('layouts.cmn')

@section('subtitle', '画面一覧')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/top.css') }}">
@endsection

@section('page-main')

    <x-header></x-header>

    <main class="contents">

        <ul>
            <li><span class="contents__current-page">おすすめ</span></li>
            <li><span>マイリスト</span></li>
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
                            <span>SOLD OUT</span>
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