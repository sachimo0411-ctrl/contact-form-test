@extends('layouts.app')

@section('title', 'Thanks')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<h2 class="page-title">Thanks</h2>

<div class="thanks__content">
    <div class="thanks__message">
        お問い合わせありがとうございました
    </div>

    <div class="thanks__button">
        <a href="/" class="thanks__button-home button">HOME</a>
    </div>
</div>
@endsection