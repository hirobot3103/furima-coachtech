@extends('layouts.cmn')

@section('subtitle', '商品詳細画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/sell.css') }}">
@endsection

@section('page-main')

    <x-header></x-header>

    <main class="contents">
        <div class="contents-area">
            <p class="sell-title">商品の出品</p>
            @foreach ($errors->all() as $error)
            <li class="validatin-error__area">&#x274C;&emsp;{{$error}}</li>
            @endforeach
            <form class="sell-form" action="/sell" method="post" enctype="multipart/form-data">
                @csrf
                <section class="uploader-area">
                    <p>商品画像</p>
                    <label for="file-uploader-btn" class="uploder-label">画像を選択する</label>
                    <input type="file" name="img_url" id="img_url" class="file-uploader-btn" >
                </section>
                <section class="item-detail-area">
                    <img src="" alt="" class="prof-img" id="profile-img">
                    <p class="detail-title">商品の詳細</p>
                    <hr>
                    <p>カテゴリー</p>
                    <div class="categori-area">
                        @foreach($categoryLists as $category)
                        <input type="checkbox" name="cat{{ $category['id'] }}" id="cat{{ $category['id'] }}" value="{{ $category['id'] }}">
                        <label for="cat{{ $category['id'] }}" class="cat-label">{{ $category['category_name'] }}</label>
                        @endforeach
                    </div>
                    <p>商品の状態</p>
                    <div class="item-status-area">
                        <div class="select-triangle">&#x25BD;</div>
                        <select name="status" id="" class="status__select">
                            <option value="0" selected disabled>選択してください</option>
                            @foreach($statusLists as $status)
                            <option value="{{ $status['id'] }}">{{ $status['status'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="item-title">商品名と説明</p>
                    <hr>
                    <p class="iteme-name-title">商品名</p>
                    <input type="text" class="item-name" name="item_name">

                    <p class="iteme-name-title">ブランド名</p>
                    <input type="text" class="item-name" name="brand_name">

                    <p class="iteme-name-title">商品の説明</p>
                    <textarea name="discription" id="item-discript" class="item-discript">

                    </textarea>

                    <p class="iteme-name-title">販売価格</p>
                    <input type="text" class="item-prace" name="price" placeholder="&yen;">
                </section>
                <button class="item-post-btn" type="submit">出品する</button>
            </form>
        </div>   
    </main>
    <script>
        document.querySelector('#img_url').addEventListener('change', (event) => {
            const file = event.target.files[0]

            if (!file) return

            const reader = new FileReader()

            reader.onload = (event) => {
                document.querySelector('#profile-img').src = event.target.result
            }

            reader.readAsDataURL(file)
        })
    </script>
@endsection