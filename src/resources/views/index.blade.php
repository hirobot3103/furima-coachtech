@extends('layouts.cmn')

@section('subtitle', '画面一覧')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/top.css') }}">
@endsection

@section('page-main')

    <x-header></x-header>

    <main class="contents">

        <ul>
            <li><a href="/"><span class="contents__current-page">おすすめ</span></a></li>
            <li><a href="/?tag=mylist"><span>マイリスト</span></a></li>
        </ul>
        
        <hr>
        
        <section class="contents__lists-area">

            <ul class="contents__lists">
            @foreach ($itemData as $item)

            @php
                $soldOutClass = "";
            @endphp  

                <li class="contents__item">

                    {{-- @if( !empty($keySentence) )
                    <a href="/item/{{$item['id']}}?keyword={{ $keySentence }}" class="item-detail__link">
                    @else --}}
                    <a href="/item/{{$item['id']}}" class="item-detail__link">
                    {{-- @endif 
                         --}}
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
@endsection