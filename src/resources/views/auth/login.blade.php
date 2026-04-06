@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header-btn')
<div class="header__btn">
    <a href="/register" class="register-btn">register</a>
</div>
@endsection

@section('content')
<div class="form__content">
    <div class="form__header">
        <h2>Login</h2>
    </div>
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__inner">
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                    </div>
                    <div class="form__group-text">
                        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">パスワード</span>
                    </div>
                    <div class="form__group-text">
                        <input type="password" name="password" placeholder="例: coachtech1106" value="{{ old('password') }}">
                    </div>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                        @error('login')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="button-submit">ログイン</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection