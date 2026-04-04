@extends('layouts.app')

@section('title', 'Login')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-button')
<a href="/register" class="header__link">register</a>
@endsection

@section('content')
<div class="auth__content">
    <div class="auth__heading">
        <h2>Login</h2>
    </div>

    <form class="auth-form" method="POST" action="/login">
        @csrf

        <div class="auth-form__group">
            <label class="auth-form__label" for="email">メールアドレス</label>
            <input class="auth-form__input" type="email" name="email" id="email" placeholder="例： test@example.com" value="{{ old('email') }}">
            @error('email')
                <p class="auth-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form__group">
            <label class="auth-form__label" for="password">パスワード</label>
            <input class="auth-form__input" type="password" name="password" id="password" placeholder="例： coachtech1106">
            @error('password')
                <p class="auth-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form__button">
            <button class="auth-form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection