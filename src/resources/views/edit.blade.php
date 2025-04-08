@extends('layouts.appp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
    <div class="profile-container">
        <h1>プロフィール設定</h1>
        <div class="profile-header">
            <div class="profile-image"></div>
            <button class="edit-profile-btn">画像を選択する</button>
        </div>

        <form action="#" method="POST">
            @csrf
            <label for="username">ユーザー名</label>
            <input type="text" id="username" name="username" value="{{ old('user_name', $profile->user_name) }}">
            
            <label for="postal">郵便番号</label>
            <input type="text" id="postal" name="postal" value="{{ old('phone_number', $profile->phone_number) }}">
            
            <label for="address">住所</label>
            <input type="text" id="address" name="address" value="{{ old('address', $profile->address) }}">
            
            <label for="building">建物名</label>
            <input type="text" id="building" name="building" value="{{ old('building', $profile->building) }}">
            
            <button type="submit" class="update-btn">更新する</button>
        </form>
    </div>
@endsection
