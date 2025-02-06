@extends('layouts.cmn')

@section('subtitle', '商品詳細画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/detail.css') }}">
@endsection

@section('page-main')

    <x-header></x-header>

    <main class="contents">
        <div class="contents-area">
            <section class="item-img-area">
                @php
                    $soldOutClass = "";
                @endphp  

                @if ( $itemData['soldout'] == 1)
                    <div class="item-sold-out__discript">
                        <span>SOLD</span>
                    </div>
                    
                    @php
                        $soldOutClass = "item-sold-out__img";
                    @endphp
                @endif
                <img class="{{ $soldOutClass }}" src="{{ $itemData[ 'img_url' ] }}" alt="{{ $itemData[ 'item_name' ] }}">
            </section>
            <section class="item-detail-area">
                <div class="detail-item-title">
                    <p class="item-name">{{ $itemData[ 'item_name' ] }}</p>
                    <p class="brand-name">{{ $itemData[ 'brand_name' ] }}</p>
                    <p class="price">&yen;<span>{{ number_format( $itemData[ 'price' ] ) }}</span>(税込)</p>
                    <div class="item-actions">
                        <figure class="favarite-action">
                            <form action="/item/{{ $itemData[ 'id' ] }}" method="post">
                                @csrf
                                <input type="hidden" name="myfavoritFlg" value={{ $favoritData[ 'myfavorit' ] }}>
                                <button type="submit" name="myfavorit" value="1">
                                @if ( $favoritData[ 'myfavorit' ] > 0 )
                                    <img src="{{ asset( '/assets/img/icons8-star-48.svg') }}" alt="いいねアイコン">
                                @else
                                    <img src="{{ asset( '/assets/img/star.svg' ) }}" alt="いいねアイコン">
                                @endif
                                </button>
                            </form>
                            <figcaption>{{ $favoritData[ 'count' ] }}</figcaption>
                        </figure>
                        <figure class="comment-action">
                            <img src="{{ asset( '/assets/img/cmnt.svg' ) }}" alt="コメントアイコン">
                            <figcaption>{{ $commentCount }}</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="purchase-btn">
                    @if ( $itemData['soldout'] == 1)
                    <a class="purchase-anchor" href=""><S>Sold</S></a>
                    @else
                    <a class="purchase-anchor" href="/purchase/{{ $itemData[ 'id' ] }}">購入手続きへ</a>
                    @endif
                </div>
                <section class="item-discrption-area">
                    <p class="item-discrption__index">商品説明</p>
                    <p class="item-discrption__body">{{ $itemData[ 'discription' ] }}</p>
                </section>
                <section class="item-status-area">
                    <p class="item-status__index">商品の状態</p>
                    <table class="item-status__table">
                        <tr>
                            <td class="category_title">カテゴリー</td>
                            <td class="category_area">
                            @foreach( $itemCategories as $itemCategory )                            
                                <div class="category-mod">{{ $itemCategory->categoryName->category_name }}</div>
                            @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>商品の状態</td>
                            <td><div class="status-mod">{{ $itemData->status_list->status }}</div></td>                            
                        </tr>
                    </table>
                </section>

                <section class="item-comment-area">
                    <p class="item-comment__index">コメント（ {{ $commentCount }} ）</p>
                    <section class="item-comment__board">

                        @foreach($commentDatas as $comment)

                        @php
                            $profImg = "";
                            $currentUserId = 0;
                            $currentUserName = "";

                            foreach($profileDatas as $prof)
                            {
                                if ( $prof['user_id'] == $comment['user_id'])
                                {
                                    $profImg = $prof['img_url'];
                                    $currentUserId = $prof['user_id'];
                                    $currentUserName = $prof['name'];
                                    break;
                                }
                            }
                        @endphp
                        <div class="contributor-area">
                            <figure class="contributor-prof">
                                <img src="{{ $profImg }}" alt="プロフィール画像" class="contributor-img">
                                <figcaption>{{ $currentUserName }}</figcaption>
                            </figure>
                            <div class="contributor-comment">
                            <p>{{ $comment['comment'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </section>
                    @if ( Auth::check() )
                    <section class="comment-post-area">
                        <p class="comment-post__index">商品へのコメント</p>
                        @foreach ($errors->all() as $error)
                        <li class="validatin-error__area">&#x274C;&emsp;{{$error}}</li>
                        @endforeach
                        <form class="comment-post__form" action="/item/{{ $itemData[ 'id' ] }}" method="post">
                            @csrf
                            <textarea name="comment" id="" class="comment__input">
                            </textarea>
                            <button name="commentReg" class="post-btn" type="submit" value=1 >コメントを送信する</button>
                        </form>
                    </section>
                    @endif
                </section>

            </section>
        </div>
    </main>
@endsection