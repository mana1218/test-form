@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__header">
        <h2>Contact</h2>
    </div>
    <form action="/contacts/confirm" class="form" method="post">
        @csrf
        <div class="contact-form__inner">
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name', $contact['last_name'] ?? '') }}">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name', $contact['first_name'] ?? '') }}">
                    </div>
                    <div class="form__error">
                        @error('first_name')
                            <span>{{ $message }}</span>
                        @enderror
                        @error('last_name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--label">
                        <label><input type="radio" name="gender" value="1" {{ old('gender', $contact['gender'] ?? '') == 1 ? 'checked' : '' }}>男性</label>
                        <label><input type="radio" name="gender" value="2" {{ old('gender', $contact['gender'] ?? '') == 2 ? 'checked' : '' }}>女性</label>
                        <label><input type="radio" name="gender" value="3" {{ old('gender', $contact['gender'] ?? '') == 3 ? 'checked' : '' }}>その他</label>
                    </div>
                    <div class="form__error">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email', $contact['email'] ?? '') }}">
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1', $contact['tel1'] ?? '') }}">
                        <span>-</span>
                        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2', $contact['tel2'] ?? '') }}">
                        <span>-</span>
                        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3', $contact['tel3'] ?? '') }}">
                    </div>
                    <div class="form__error">
                        @error('tel')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $contact['address'] ?? '') }}">
                    </div>
                    <div class="form__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building', $contact['building'] ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--select">
                        <select class="form__select" name="category_id">
                            <option value="" disabled selected>選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__error">
                        @error('content')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $contact['detail'] ?? '') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </div>
    </form>
</div>
@endsection