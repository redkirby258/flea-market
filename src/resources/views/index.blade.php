<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧ページ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
<header class="header">
    <div class="logo">COACHTECH</div>
    <input type="text" class="search-bar" placeholder="なにをお探しですか？">
    <nav class="nav-links">
        <a href="#">ログアウト</a>
        <a href="#">マイページ</a>
        <button class="sell-button">出品</button>
    </nav>
</header>

<div class="container">
    <nav class="nav">
        <a href="#" class="nav-item active">おすすめ</a>
        <a href="#" class="nav-item">マイリスト</a>
    </nav>

    <div class="product-grid">
    @if(isset($products) && count($products) > 0)
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <p>画像なし</p>
                        @endif
                    </div>
                    <div class="product-name">
                        {{ $product->name }}
                    </div>
                    @if($product->sold)
                        <div class="sold-label">Sold</div>
                    @endif
                </div>
            @endforeach
        @else
            <p>商品がありません</p>
        @endif
        </div>
    </div>
</div>

</body>
</html>
