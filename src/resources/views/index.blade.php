@extends('layouts.cmn')

@section('subtitle', '画面一覧')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/top.css') }}">
@endsection

@section('page-main')
 
    <x-header>{{ $urlData['locationUrl'] }}</x-header>

    <main class="contents">
        <ul>
            @php 
                $urlRoot = '/';
                $urlMyList = '/?tag=mylist';
            @endphp

            @if ( session('message') )
            @php 
                $urlRoot = '/?keyword=' . session('message');
                $urlMyList = '/?tag=mylist&keyword=' . session('message');
            @endphp
            @endif
            <li><a href="{{ $urlRoot }}"><span class="contents__current-page">おすすめ</span></a></li>
            <li><a href="{{ $urlMyList }}"><span>マイリスト</span></a></li>
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
        // document.getElementById("search-box").onkeypress = (e) => {
        //     const key = e.keyCode || e.charCode || 0;
    
        //     if (key == 13) {

        //         const keyword = document.getElementById("ky").value;
        //         const url = "/";
        //         const formData = new URLSearchParams();
        //         formData.append('keyword', keyword);
        //         const body = formData.toString();

        //         fetch(url, { 
        //             method: 'GET', 
        //             headers: {
        //                 'Content-Type': 'application/x-www-form-urlencoded'
        //             },
        //             body: body 
        //         });
        //     }
        // }
    </script>
@endsection