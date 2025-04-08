@extends('layouts.appp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="container">
    <h2 class="title">商品の出品</h2>

<!-- 商品画像 -->
<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="image-upload">
        <label for="image">
            <div class="image-box">
                <span>画像を選択する</span>
            </div>
        </label>
        <input type="file" id="image" name="image" accept="image/*" style="display: none;">
    </div>
    <div class="product-details">
        <h3>商品の詳細</h3>

        <!-- カテゴリー選択 -->
        <div class="category-box">
            <h4>カテゴリー</h4>
            <div class="categories">
            @foreach ($categories as $category)
                <label class="category-label">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="category-checkbox" hidden>
                    <span class="category-button">{{ $category->name }}</span>
                </label>
            @endforeach
            </div>
        </div>

        <!-- 商品の状態 -->
        <div class="form-group">
            <label for="condition">商品の状態</label>
            <select name="condition" id="condition" class="form-control" required>
                <option value="" disabled selected>選択してください</option>
                <option value="新品">新品</option>
                <option value="未使用に近い">未使用に近い</option>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                <option value="傷や汚れあり">傷や汚れあり</option>
                <option value="全体的に状態が悪い">全体的に状態が悪い</option>
            </select>
        </div>

        <!-- 商品名と説明 -->
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="brand">ブランド名</label>
            <input type="text" name="brand" id="brand" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">商品の説明</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">販売価格 (円)</label>
            <div class="price-input">
                <span>¥</span>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
        </div>

        <!-- 送信ボタン -->
        <button type="submit" class="submit-button">出品する</button>
    </div>
</form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = document.querySelectorAll('.category-label');

        labels.forEach(label => {
            const checkbox = label.querySelector('.category-checkbox');
            const button = label.querySelector('.category-button');

            label.addEventListener('click', () => {
                checkbox.checked = !checkbox.checked;
                button.classList.toggle('active', checkbox.checked);
            });
        });
    });
</script>
@endsection