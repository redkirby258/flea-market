@extends('layouts.appp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-image">
            <img src="{{ asset(optional($profile)->profile_image ?? 'images/default.png') }}" alt="プロフィール画像">
        </div>
        <div class="profile-info">
            <h2 class="profile-name">{{ optional($profile)->user_name ?? 'ゲスト' }}</h2>
            <a href="/mypage/profile" class="edit-profile-btn">プロフィールを編集</a>
        </div>
    </div>
    
    <div class="tabs">
        <span class="tab active-tab" data-tab="selling">出品した商品</span>
        <span class="tab" data-tab="purchased">購入した商品</span>
    </div>

    <div class="product-list selling-list">
        @foreach ($selling_products as $product)
            <div class="product-item">
                <img src="{{ asset($product->image) }}" alt="商品画像" class="product-image">
                <p class="product-name">{{ $product->name }}</p>
            </div>
        @endforeach
    </div>

    <div class="product-list purchased-list" style="display: none;">
        @foreach ($purchased_products as $product)
            <div class="product-item">
                <img src="{{ asset($product->image) }}" alt="商品画像" class="product-image">
                <p class="product-name">{{ $product->name }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection

