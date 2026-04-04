@extends('layouts.app')

@section('title', 'Admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<h2 class="page-title">Admin</h2>

@section('header-button')
<form action="/logout" method="post">
    @csrf
    <button type="submit" class="header__link-button">logout</button>
</form>
@endsection

<div class="admin__content">
    <div class="admin__search">
        <form action="/admin" method="get" class="search-form">
            <input class="search-form__keyword" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">

            <select class="search-form__select" name="gender">
                <option value="">性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>

            <select class="search-form__select" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>

            <input class="search-form__date" type="date" name="date">

            <div class="search-form__buttons">
                <button class="search-form__button-submit" type="submit">検索</button>
                <a href="/admin" class="search-form__button-reset">リセット</a>
            </div>
        </form>
    </div>

    <div class="admin__sub-header">
        <div class="admin__export">
            <form action="/export" method="get">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">

                <button class="admin__export-button" type="submit">エクスポート</button>
            </form>
        </div>

        <div class="admin__pagination">
            @if ($contacts->lastPage() > 1)
            <div class="pagination">
                @if ($contacts->onFirstPage())
                <span class="pagination__item pagination__item--disabled">&lt;</span>
                @else
                <a class="pagination__item href=" {{ $contacts->previousPageUrl() }}">&lt;</a>
                @endif

                @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                    @if ($i == $contacts->currentPage())
                    <span class="pagination__item pagination__item--active">{{ $i }}</span>
                    @else
                    <a class="pagination__item" href="{{ $contacts->url($i) }}">{{ $i }}</a>
                    @endif
                    @endfor

                    @if ($contacts->hasMorePages())
                    <a class="pagination__item" href="{{ $contacts->nextPageUrl() }}">&gt;</a>
                    @else
                    <span class="pagination__item pagination__ite--disable">&gt;</span>
                    @endif
            </div>
            @endif
        </div>
    </div>

    <div class="admin-table">
        <table class="admin-table__inner">
            <thead class="admin-table__header">
                <tr class="admin-table__row">
                    <th class="admin-table__label">お名前</th>
                    <th class="admin-table__label">性別</th>
                    <th class="admin-table__label">メールアドレス</th>
                    <th class="admin-table__label">お問い合わせの種類</th>
                    <th class="admin-table__label"></th>
                </tr>
            </thead>

            <tbody class="admin-table__body">
                @if ($contacts->isEmpty())
                    <tr>
                        <td colspan="5">該当するデータがありません</td>
                    </tr>
                @endif

                @foreach ($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__item">
                        {{ $contact->last_name }}{{ $contact->first_name }}
                    </td>
                    <td class="admin-table__item">
                        @if ($contact->gender == 1)
                        男性
                        @elseif ($contact->gender == 2)
                        女性
                        @else
                        その他
                        @endif
                    </td>
                    <td class="admin-table__item">{{ $contact->email }}</td>
                    <td class="admin-table__item">{{ $contact->category->content ?? '' }}</td>
                    <td class="admin-table__item">
                        <a href="#modal-{{ $contact->id }}" class="admin-table__detail-button">詳細</a>
                    </td>
                </tr>

                <div class="modal" id="modal-{{ $contact->id }}">
                    <a href="#!" class="modal__overlay"></a>

                    <div class="modal__content">
                        <a href="#!" class="modal__close">×</a>

                        <div class="modal__body">
                            <div class="modal__row">
                                <div class="modal__label">お名前</div>
                                <div class="modal__text">{{ $contact->last_name }} {{ $contact->first_name }}</div>
                            </div>

                            <div class="modal__row">
                                <div class="modal__label">性別</div>
                                <div class="modal__text">
                                    @if ($contact->gender == 1)
                                    男性
                                    @elseif ($contact->gender == 2)
                                    女性
                                    @else
                                    その他
                                    @endif
                                </div>
                            </div>

                            <div class="modal__row">
                                <div class="modal__label">メールアドレス</div>
                                <div class="modal__text">{{ $contact->email }}</div>
                            </div>

                            <div class="modal__row">
                                <div class="modal__label">電話番号</div>
                                <div class="modal__text">{{ $contact->tel }}</div>
                            </div>

                            <div class="modal__row">
                                <div class="modal__label">住所</div>
                                <div class="modal__text">{{ $contact->address }}</div>
                            </div>

                            <div class="modal__row">
                                <div class="modal__label">建物名</div>
                                <div class="modal__text">{{ $contact->building }}</div>
                            </div>

                            <div class="modal__row">
                                <div class="modal__label">お問い合わせの種類</div>
                                <div class="modal__text">{{ $contact->category->content ?? '' }}</div>
                            </div>

                            <div class="modal__row">
                                <div class="modal__label">お問い合わせ内容</div>
                                <div class="modal__text">{{ $contact->detail }}</div>
                            </div>
                            <div class="modal__footer">
                                <form method="post" action="/admin/delete/{{ $contact->id }}">
                                    @csrf
                                    <button class="modal__delete-button">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection