<header class="page-header">
        <div class="page-logo">
            <a href="/" class="page-logo">
                <img src="{{ asset('/assets/img/logo.svg') }}" alt="ロゴ COACHTECH">
            </a>
        </div>
        <form class="page-search" id='search-box'>
            <input type="text" name="keyword" id="kw" class="page-input-keyword" placeholder="なにをお探しですか？" value="{{ $keyword }}">
        </form>
        <nav class="page-menu">
            <ul>
                @if (Auth::check())
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="page-menu-btn">ログアウト</button>
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