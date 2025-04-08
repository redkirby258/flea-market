@extends('layouts.appp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="product-container">
    <div class="product-layout">
        <!-- 商品画像 -->
        <div class="product-image">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.png') }}" alt="商品画像">
        </div>
        
        <!-- 商品情報 -->
        <div class="product-info">
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="product-brand">{{ $product->brand }}</p>
            <p class="product-price">¥{{ number_format($product->price) }} (税込)</p>
            
            <div class="like-section">
                <button id="like-button" class="{{ auth()->check() && $product->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                  ❤️<span id="like-count">{{ $product->likes()->count() }}</span>
                </button>
            </div>
            
            <a href="{{ route('purchase.show', $product->id) }}" class="purchase-button">
                購入手続きへ
            </a>
            
            <h2 class="product-section-title">商品説明</h2>
            <p class="product-description">{{ $product->description }}</p>
            
            <h2 class="product-section-title">商品情報</h2>
            <p class="product-category">カテゴリー: 
                @foreach($product->categories as $category)
                    <span class="category-tag">{{ $category->name }}</span>@if (!$loop->last), @endif
                @endforeach
            </p>
            <p class="product-condition">商品の状態: {{ $product->condition }}</p>
        </div>
    </div>

    <!-- コメント欄 -->
    <div class="comment-section">
        <h2 class="comment-title">コメント ({{ $product->comments->count() }})</h2>
        <div class="comment-list">
            @foreach($product->comments as $comment)
                <div class="comment-item">
                    <p class="comment-user">{{ optional($comment->user)->name ?? 'ゲスト' }}</p>
                    <p class="comment-content">{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('comments.store', ['product' => $product->id]) }}" class="comment-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <textarea name="content" class="comment-box" placeholder="商品のコメント"></textarea>
            <button type="submit" class="comment-button">コメントを送信する</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('like-button').addEventListener('click', function() {
        fetch("{{ route('like.toggle', $product->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('like-count').innerText = data.likes_count;
            this.classList.toggle('liked', data.is_liked);
        });
    });
</script>

<style>
    #like-button {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }
    .liked {
        color: red;
    }
</style>
@endsection
