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
                        <span>SOLD OUT</span>
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
                            <a href="">
                                <img src="{{ asset( '/assets/img/cmnt.svg' ) }}" alt="コメントアイコン">
                            </a>
                            <figcaption>4</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="purchase-btn">
                    <a class="purchase-anchor" href="">購入手続きへ</a>
                </div>
                <section class="item-discrption-area">
                    <p class="item-discrption__index">商品説明</p>
                    <p class="item-discrption__body">{{ $itemData[ 'discription' ] }}</p>
                </section>
                <section class="item-status-area">
                    <p class="item-status__index">商品の状態</p>
                    <table class="item-status__table">
                        <tr>
                            <td>カテゴリー</td>
                            <td>
                                <div class="category-mod">洋服</div>
                            </td>
                            <td>
                                <div class="category-mod">メンズ</div>
                            </td>
                            <td><div class="category-mod">最先端</div></td>
                        </tr>
                        <tr>
                            <td>商品の状態</td>
                            <td colspan="2"><div class="status-mod">{{ $itemData->status_list->status }}</div></td>
                            <td></td>                            
                        </tr>
                    </table>
                </section>
                <section class="item-comment-area">
                    <p class="item-comment__index">コメント（4）</p>
                    <section class="item-comment__board">
                        <div class="contributor-area">
                            <figure class="contributor-prof">
                                <img src="./assets/img/prof.jpeg" alt="プロフィール画像" class="contributor-img">
                                <figcaption>administrator</figcaption>
                            </figure>
                            <div class="contributor-comment">
                            <p>
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                            </p>
                            </div>
                        </div>
                        <div class="contributor-area">
                            <figure class="contributor-prof">
                                <img src="./assets/img/prof.jpeg" alt="プロフィール画像" class="contributor-img">
                                <figcaption>administrator</figcaption>
                            </figure>
                            <div class="contributor-comment">
                            <p>
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                            </p>
                            </div>
                        </div>
                        <div class="contributor-area">
                            <figure class="contributor-prof">
                                <img src="./assets/img/prof.jpeg" alt="プロフィール画像" class="contributor-img">
                                <figcaption>administrator</figcaption>
                            </figure>
                            <div class="contributor-comment">
                            <p>
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                            </p>
                            </div>
                        </div>
                        <div class="contributor-area">
                            <figure class="contributor-prof">
                                <img src="./assets/img/prof.jpeg" alt="プロフィール画像" class="contributor-img" id="">
                                <figcaption>administrator</figcaption>
                            </figure>
                            <div class="contributor-comment">
                            <p>
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                                こちらにコメントが入ります。
                            </p>
                            </div>
                        </div>
                    </section>
                    <section class="comment-post-area">
                        <p class="comment-post__index">商品へのコメント</p>
                        <form class="comment-post__form" action="">
                            <textarea name="" id="" class="comment__input">

                            </textarea>
                            <button class="post-btn" type="submit">コメントを送信する</button>
                        </form>
                    </section>
                </section>
            </section>
        </div>
    </main>
@endsection