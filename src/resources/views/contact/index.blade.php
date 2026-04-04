@extends('layouts.app')

@section('title', 'Contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<h2 class="page-title">Contact</h2>

<form action="/confirm" method="post">
    @csrf

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label">お名前
                <span class="form__required">※</span>
            </label>
        </div>
        <div class="form__group-content">
            <div class="form__name-group">
                <input class="form__input form__input--name" type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}">
                <input class="form__input form__input--name" type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
            </div>
            @error('last_name')
                <p class="form__error">{{ $message }}</p>
            @enderror
            @error('first_name')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label">性別
                <span class="form__required">※</span>
            </label>
        </div>
        <div class="form__group-content">
            <div class="form__radio-group">
                <label class="form__radio-label">
                    <input class="form__radio" type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : ''}}>
                    男性
                </label>
                <label class="form__radio-label">
                    <input class="form__radio" type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : ''}}>
                    女性
                </label>
                <label class="form__radio-label">
                    <input class="form__radio" type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : ''}}>
                    その他
                </label>
            </div>
            @error('gender')
            <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label" for="email">メールアドレス
                <span class="form__required">※</span>
            </label>
        </div>
        <div class="form__group-content">
            <input class="form__input" type="text" id="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
            @error('email')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label" for="tel">電話番号
                <span class="form__required">※</span>
            </label>
        </div>
        <div class="form__group-content">
            <div class="form__tel-group">
                <input class="form__input form__input--tel" type="text" id="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                <span>-</span>
                <input class="form__input form__input--tel" type="text" id="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                <span>-</span>
                <input class="form__input form__input--tel" type="text" id="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
            </div>
            @error('tel')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label" for="address">住所
                <span class="form__required">※</span>
            </label>
        </div>
        <div class="form__group-content">
            <input class="form__input" type="text" id="address" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
            @error('address')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label" for="building">建物名</label>
        </div>
        <div class="form__group-content">
            <input class="form__input" type="text" id="building" name="building" value="{{ old('building') }}">
        </div>
    </div>

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label" for="category_id">お問い合わせの種類
                <span class="form__required">※</span>
            </label>
        </div>
        <div class="form__group-content">
            <select class="form__select" id="category_id" name="category_id">
                <option value="">選択してください</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            
            @error('category_id')
            <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form__group">
        <div class="form__group-title">
            <label class="form__label" for="detail">お問合せ内容
                <span class="form__required">※</span>
            </label>
        </div>
        <div class="form__group-content">
            <textarea class="form__textarea" id="detail" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            @error('detail')
            <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form__button">
        <button class="form__button-submit" type="submit">確認画面</button>
    </div>
</form>
@endsection