@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')
<div class="register-form">
  <h2 class="register-form__heading content__heading">会員登録</h2>
  <div class="register-form__inner">
    <form class="register-form__form" action="/register" method="post">
      @csrf
      <div class="register-form__group">
        <label class="register-form__label" for="name">ユーザーネーム</label>
        <input class="register-form__input" type="text" name="name" id="name" placeholder="例：山田 太郎">
         <p class="register-form__error-message">
          @error('name')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <label class="register-form__label" for="email">メールアドレス</label>
        <input class="register-form__input" type="mail" name="email" id="email" placeholder="例：test@example.com">
        <p class="register-form__error-message">
          @error('email')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <label class="register-form__label" for="password">パスワード</label>
        <input class="register-form__input" type="password" name="password" id="password" placeholder="例：coachtech1106">
        <p class="register-form__error-message">
          @error('password')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <label class="register-form__label" for="password_confirmation">確認パスワード</label>
        <input class="register-form__input" type="password" name="password_confirmation" id="password_confirmation" placeholder="例：coachtech1106">
        <p class="register-form__error-message">
          @error('password_confirmation')
          {{ $message }}
          @enderror
        </p> 
      </div>
      <input class="register-form__btn btn" type="submit" value="登録">
      <a class="register-form__link" href="/login">ログインはこちら</a>
    </form>
  </div>
</div>
@endsection