@extends('layouts.app')

@section('content')
<div class="profile-setup">
    <h2>プロフィール設定</h2>

    <form action="/profile" method="POST">
        @csrf
        <div>
            <label for="bio">自己紹介</label>
            <textarea id="bio" name="bio" rows="4"></textarea>
        </div>
        
        <div>
            <label for="avatar">アバター画像 (URL)</label>
            <input id="avatar" type="text" name="avatar">
        </div>

        <button type="submit">プロフィールを保存</button>
    </form>
</div>
@endsection

