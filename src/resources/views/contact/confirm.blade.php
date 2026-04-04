@extends('layouts.app')

@section('title', 'Confirm')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<h2 class="page-title">Confirm</h2>

<div class="confirm-table">
    <div class="confirm-table__row">
        <div class="confirm-table__header">お名前</div>
        <div class="confirm-table__text">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</div>
    </div>

    <div class="confirm-table__row">
        <div class="confirm-table__header">性別</div>
        <div class="confirm-table__text">{{ $genderLabel }}</div>
    </div>

    <div class="confirm-table__row">
        <div class="confirm-table__header">メールアドレス</div>
        <div class="confirm-table__text">{{ $contact['email'] }}</div>
    </div>

    <div class="confirm-table__row">
        <div class="confirm-table__header">電話番号</div>
        <div class="confirm-table__text">
            {{ $contact['tel1'] }}-{{ $contact['tel2'] }}-{{ $contact['tel3'] }}
        </div>
    </div>

    <div class="confirm-table__row">
        <div class="confirm-table__header">住所</div>
        <div class="confirm-table__text">{{ $contact['address'] }}</div>
    </div>

    <div class="confirm-table__row">
        <div class="confirm-table__header">建物名</div>
        <div class="confirm-table__text">{{ $contact['building'] }}</div>
    </div>

    <div class="confirm-table__row">
        <div class="confirm-table__header">お問い合わせの種類</div>
        <div class="confirm-table__text">{{ $categoryContent }}</div>
    </div>

    <div class="confirm-table__row">
        <div class="confirm-table__header">お問い合わせ内容</div>
        <div class="confirm-table__text">{{ $contact['detail'] }}</div>
    </div>
</div>

<form action="/thanks" method="post" class="confirm-form">
    @csrf
    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
    <input type="hidden" name="email" value="{{ $contact['email'] }}">
    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
    <input type="hidden" name="address" value="{{ $contact['address'] }}">
    <input type="hidden" name="building" value="{{ $contact['building'] }}">
    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
    <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

    <div class="confirm-form__button">
        <button class="confirm-form__button-submit" type="submit">送信</button>
    </div>
</form>

<div class="confirm-form__fix">
    <form action="/back" method="post" class="confirm-form">
        @csrf
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        <input type="hidden" name="email" value="{{ $contact['email'] }}">
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
        <input type="hidden" name="address" value="{{ $contact['address'] }}">
        <input type="hidden" name="building" value="{{ $contact['building'] }}">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

        <button type="submit" class="confirm-form__fix-button">修正</button>
    </form>
</div>
@endsection