@extends('layouts.cmn')

@section('subtitle', 'ログイン画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset( '/assets/css/login.css' ) }}">
@endsection

@section('page-main')
    <header class="page-header">
        <div class="page-logo">
            <a href="/">
                <img src="{{ asset('/assets/img/logo.svg') }}" alt="ロゴ COACHTECH">
            </a>
        </div>
    </header>
    <main>
        <div class="container" style="text-align:center;">
            <h2>メール認証が必要です</h2>
            <p>登録したメールアドレスに確認メールを送信しました。</p>
            <p>確認リンクをクリックして認証を完了してください。</p>
        </div>
    </main>  
@endsection