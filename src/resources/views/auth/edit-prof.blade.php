@extends('layouts.cmn')

@section('subtitle', 'プロフィール設定画面')

@section('csslink')
<link rel="stylesheet" href="{{ asset('/assets/css/edit-prof.css') }}">
@endsection

@section('page-main')
    <header class="page-header">
        <div class="page-logo">
            <a href="/" class="page-logo">
                <img src="{{ asset('/assets/img/logo.svg') }}" alt="ロゴ COACHTECH">
            </a>
        </div>
        <form action="/" class="page-search">
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
            <p class="sell-title">プロフィール設定</p>
            <form class="sell-form" action="/mypage/profile" method="post" enctype="multipart/form-data">
                @csrf
                @if( !empty($profileData) )
                @method('PATCH')
                @endif
                @php
                    if( !empty($profileData) ) {
                        $name = $profileData['name'];
                        $postCode = $profileData['post_number'];
                        $address = $profileData['address'];
                        $building = $profileData['building'];
                        $profImg = $profileData['img_url'];
                        if( $profileData['prof_reg'] == 0)
                        {
                            $postCode = old( 'post_number' );
                            $address = old( 'address' );
                            $building = old( 'building' );
                        }
                    } else {
                        $name = old( 'name' );
                        $postCode = old( 'post_number' );
                        $address = old( 'address' );
                        $building = old( 'building' );
                        $profImg = asset('assets/img/prof.jpeg');
                    }
                @endphp
                <section class="item-detail-area">
                    <div class="prof-img-area">
                        <img src="{{ $profImg }}" alt="" class="prof-img" id="profile-img">
                        <label for="user-img" class="user-img-label">画像を選択する</label>
                        <input type="file" name="img_url" id="user-img" class="user-img">
                        @if ($errors->has('img_url'))
                            @foreach($errors->get('img_url') as $errorMassage )
                                <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                            @endforeach
                        @endif
                    </div>
                    <p class="iteme-name-title">ユーザー名</p>
                    <input type="text" class="item-name" name="name" value="{{ $name }}">
                    @if ($errors->has('name'))
                        @foreach($errors->get('name') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">郵便番号</p>
                    <input type="text" class="item-name" name="post_number" value="{{ $postCode }}">
                    @if ($errors->has('post_number'))
                        @foreach($errors->get('post_number') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">住所</p>
                    <input type="text" class="item-prace" name="address" value="{{ $address }}">
                    @if ($errors->has('address'))
                        @foreach($errors->get('address') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif

                    <p class="iteme-name-title">建物名</p>
                    <input type="text" class="item-prace" name="building" value="{{ $building }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @if ($errors->has('building'))
                        @foreach($errors->get('building') as $errorMassage )
                            <li class="validatin-error__area">&#x274C;&emsp;{{$errorMassage}}</li> 
                        @endforeach
                    @endif
                </section>
                <button class="item-post-btn" type="submit" name="edit-prof">更新する</button>
            </form>
        </div>   
    </main>

    <script>
        document.querySelector('#user-img').addEventListener('change', (event) => {
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