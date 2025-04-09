@extends('layouts.appp') {{-- 共通レイアウトを使っている場合 --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/setup.css') }}"> {{-- 必要ならCSS --}}
@endsection

@section('content')
<div class="profile-container">
    <h2 class="title">プロフィールを設定してください</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- プロフィール画像 -->
        <div class="form-group image-wrapper">
            <label for="profile_image">
                <div class="image-box">
                    <span>画像を選択する</span>
                </div>
            </label><br>
            <img id="preview" src="{{ asset('images/default-profile.png') }}" class="profile-img" alt="プロフィール画像">
            <input type="file" name="profile_image" id="profile_image" style="display: none;" accept="image/*"  onchange="previewImage(event)">
        </div>

        <!-- ユーザー名 -->
        <div class="form-group">
            <label for="user_name">ユーザー名</label>
            <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" required>
        </div>

        <!-- 建物名 -->
        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" value="{{ old('building') }}">
        </div>

        <!-- 郵便番号 -->
        <div class="form-group">
            <label for="phone_number">郵便番号</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
        </div>

        <!-- 住所 -->
        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}">
        </div>

        <button type="submit" class="submit-btn">保存する</button>
    </form>
    <script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</div>

@endsection
