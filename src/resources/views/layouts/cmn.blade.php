<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furima @yield('subtitle')</title>

    <link rel="stylesheet" href="{{ asset('/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common.css') }}">
    @yield('csslink')
    
</head>
<body>
    @yield('page-main')
</body>
</html>