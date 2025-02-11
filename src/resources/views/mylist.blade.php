@extends('layouts.cmn')

@section('subtitle', 'マイリスト')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/mylist.css') }}">
@endsection

@section('page-main')

    <x-header>
        <x-slot name="keyword">{{ $urlData['keyword'] }}</x-slot>
    </x-header>

    <main class="contents">
        <ul>
            @php 
                $urlRoot = '/';
                $urlMyList = '/?tag=mylist';
            @endphp

            @if ( $urlData['keyword'] )
            @php 
                $urlRoot = '/?keyword=' . $urlData['keyword'];
                $urlMyList = '/?tag=mylist&keyword=' . $urlData['keyword'];
            @endphp
            @endif
            <li><a href="{{ $urlRoot }}"><span>おすすめ</span></a></li>
            <li><a href="{{ $urlMyList }}"><span class="contents__current-page">マイリスト</span></a></li>
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