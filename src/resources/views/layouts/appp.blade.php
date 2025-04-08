<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧ページ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/commmon.css') }}" />
    @yield('css')
</head>

<body>
<header class="header">
    <div class="logo">COACHTECH</div>
    <form action="{{ route('products.index') }}" method="GET" class="flex">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="なにをお探しですか？" class="border p-2">
        <button type="submit" class="bg-gray-500 text-white px-4">検索</button>
    </form>
    <nav class="nav-links">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
            <button type="submit">ログアウト</button>
        </form>
        <a href="#">マイページ</a>
        <button class="sell-button">出品</button>
    </nav>
</header>
@yield('content')
</body>
</html>