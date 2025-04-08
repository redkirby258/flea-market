@extends('layouts.appp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-container">
    <!-- 左側: 商品情報 & 支払い・配送 -->
    <div class="left-section">
        <div class="product-details">
            <div class="product-image">
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像">
            </div>
            <div class="product-info">
                <h2>{{ $product->name }}</h2>
                <p class="price">￥{{ number_format($product->price) }}</p>
            </div>
        </div>

        <div class="payment-shipping">
        <form action="{{ route('products.purchase', ['item_id' => $product->id]) }}" method="POST">
                @csrf
                <div class="payment-method">
                    <h3>支払い方法</h3>
                    <select name="payment" id="payment" required>
                        <option value="">選択してください</option>
                        <option value="credit">クレジットカード</option>
                        <option value="convenience">コンビニ払い</option>
                    </select>
                </div>

                <div class="shipping-info">
                    <h3>配送先</h3>
                    <p>〒 XXX-YYYY</p>
                    <p>ここには住所と建物が入ります</p>
                    <a href="#" class="change-address">変更する</a>
                </div>

                <div class="summary">
                    <table>
                        <tr>
                            <td>商品代金</td>
                            <td>￥{{ number_format($product->price) }}</td>
                        </tr>
                        <tr>
                            <td>支払い方法</td>
                            <td id="selected-payment">未選択</td>
                        </tr>
                    </table>
                    <button type="submit" class="purchase-btn">購入する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
