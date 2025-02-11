@extends('layouts.cmn')

@section('subtitle', '商品詳細画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('/assets/css/sell.css') }}">
@endsection

@section('page-main')

    <x-header>
        @isset($session['keyword'])
            <x-slot name="keyword">{{ $urlData['keyword'] }}</x-slot>
        @else
            <x-slot name="keyword"></x-slot>
        @endisset
    </x-header>

    <main class="contents">
        <div class="contents-area">
            <p class="sell-title">商品の出品</p>
            <form class="sell-form" action="/sell" method="post" enctype="multipart/form-data">
                @csrf
                <section class="uploader-area">
                    <p>商品画像</p>
                    <label for="file-uploader-btn" class="uploder-label">画像を選択する</label>
                    <input type="file" name="img_url" id="img_url" class="file-uploader-btn" >
                    @if ($errors->has('img_url'))
                        @foreach($errors->get('img_url') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
                </section>
                <section class="item-detail-area">
                    <img src="" alt="" class="prof-img" id="profile-img">
                    <p class="detail-title">商品の詳細</p>
                    <hr>
                    <p>カテゴリー</p>
                    <div class="categori-area">
                        @foreach($categoryLists as $category)
                            @php
                                $checkboxChecked = "";
                                if ( !empty(old('cat' . $category['id'])))
                                {
                                    $checkboxChecked = "checked";
                                } 

                            @endphp
                        <input type="checkbox" name="cat{{ $category['id'] }}" id="cat{{ $category['id'] }}" value="{{ $category['id'] }}" {{$checkboxChecked}}>
                        <label for="cat{{ $category['id'] }}" class="cat-label">{{ $category['category_name'] }}</label>
                        @endforeach

                        @if($errors->has("cat1") )
                            @foreach($errors->get("cat1") as $errorMassage )
                                <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                            @endforeach
                        @endif
                        
                    </div>

                    <p>商品の状態</p>
                    <div class="item-status-area">
                        <div class="select-triangle">&#x25BD;</div>
                        <select name="status" id="" class="status__select" value="{{ old('status')}}">
                            @php
                                $statusSelected = "";
                                if( empty( old('status') ) || ( old('status') == 0 ) ) 
                                {
                                        $statusSelected = "selected";                                    
                                }                            
                            @endphp
                            <option value="0" {{$statusSelected}} disabled>選択してください</option>
                            @foreach($statusLists as $status)
                            @php
                                $statusSelected = "";
                                if( !empty( old('status') )) 
                                {
                                    if( $status['id'] == old('status') )
                                    {
                                        $statusSelected = "selected";                                    
                                    }
                                }
                            @endphp
                            <option value="{{ $status['id'] }}" {{$statusSelected}}>{{ $status['status'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('status'))
                        @foreach($errors->get('status') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
                    <p class="item-title">商品名と説明</p>
                    <hr>
                    <p class="iteme-name-title">商品名</p>
                    <input type="text" class="item-name" name="item_name" value="{{ old('item_name') }}">
                    @if ($errors->has('item_name'))
                        @foreach($errors->get('item_name') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">ブランド名</p>
                    <input type="text" class="item-name" name="brand_name" {{ old('brand_name') }}>
                    @if ($errors->has('brand_name'))
                        @foreach($errors->get('bland_name') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">商品の説明</p>
                    <textarea name="discription" id="item-discript" class="item-discript" {{ old('discription') }}>
                    </textarea>
                    @if ($errors->has('discription'))
                        @foreach($errors->get('discription') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">販売価格</p>
                    <input type="text" class="item-prace" name="price" placeholder="&yen;" value="{{ old('price') }}"">
                    @if ($errors->has('price'))
                        @foreach($errors->get('price') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
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
        });

    </script>
    <script>
        const form = document.querySelector("#search-box");

        async function sendData() {
                
            const keyword = document.getElementById("kw");
            const url = "/?keyword=" + keyword.value;
            location.href = url;
        }

        form.addEventListener("submit", (event) => {
            event.preventDefault();    
            sendData();
        });

    </script>    
@endsection