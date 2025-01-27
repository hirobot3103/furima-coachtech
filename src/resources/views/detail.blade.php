@extends('layouts.cmn')

@section('subtitle', '商品詳細画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/detail.css') }}">
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
        <div class="contents-area">
            <section class="item-img-area">
                @php
                    $soldout_class = "";
                @endphp  

                @if ( $item_data['soldout'] == 1)
                    <div class="item-sold-out__discript">
                        <span>SOLD OUT</span>
                    </div>
                    
                    @php
                        $soldout_class = "item-sold-out__img";
                    @endphp
                @endif
                <img class="{{ $soldout_class }}" src="{{ $item_data['img_url'] }}" alt="{{ $item_data['item_name'] }}">
            </section>
            <section class="item-detail-area">
                <div class="detail-item-title">
                    <p class="item-name">{{ $item_data['item_name'] }}</p>
                    <p class="brand-name">ブランド名</p>
                    <p class="price">&yen;<span>{{ number_format( $item_data['price'] ) }}</span>(税込)</p>
                    <div class="item-actions">
                        <figure class="favarite-action">
                            <a href="">
                                @if ( $favorit_data['my_favorit'] > 0 )
                                <img src="{{ asset('/assets/img/icons8-star-48.svg') }}" alt="いいねアイコン">
                                @else
                                <img src="{{ asset('/assets/img/star.svg') }}" alt="いいねアイコン">
                                @endif
                            </a>
                            <figcaption>{{ $favorit_data['count'] }}</figcaption>
                        </figure>
                        <figure class="comment-action">
                            <a href="">
                                <img src="{{ asset('/assets/img/cmnt.svg') }}" alt="コメントアイコン">
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
                    <p class="item-discrption__body">{{ $item_data['discription'] }}</p>
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
                            <td colspan="2"><div class="status-mod">{{ $item_data->status_list->status }}</div></td>
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