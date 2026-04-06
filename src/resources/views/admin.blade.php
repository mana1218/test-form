@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-btn')
<div class="header__btn">
    <a href="/logout" class="logout-btn">logout</a>
</div>
@endsection

@section('content')
<div class="form__content">
    <div class="form__header">
        <h2>Admin</h2>
    </div>
    <div class="search-box">
        <input type="text" placeholder="名前やメールアドレスを入力してください">
        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
        </select>
        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"{{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
            @endforeach
        </select>
        <input type="date" name="date" value="{{ request('date') }}">
        <button class="search-btn">検索</button>
        <button class="reset-btn">リセット</button>
    </div>
    <div class="form__item">
        <button class="export-btn">エクスポート</button>
        <div class="pagination">{{ $contacts->links() }}</div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                @if($contact->gender == 1) 男性
                @elseif($contact->gender == 2) 女性
                @else その他
                @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content ?? '' }}</td>
                <td>
                    <button class="detail-btn" onclick="openModal({{ $contact->id }})">詳細</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@foreach ($contacts as $contact)
<div id="modal-{{ $contact->id }}" class="modal">
    <div class="modal-content">

        <span class="close" onclick="closeModal({{ $contact->id }})">&times;</span>

        <div class="modal-inner">
            <p><strong>お名前</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
            <p><strong>性別</strong>
                @if($contact->gender == 1) 男性
                @elseif($contact->gender == 2) 女性
                @else その他
                @endif
            </p>
            <p><strong>メールアドレス</strong> {{ $contact->email }}</p>
            <p><strong>電話番号</strong> {{ $contact->tel }}</p>
            <p><strong>住所</strong> {{ $contact->address }}</p>
            <p><strong>建物名</strong> {{ $contact->building }}</p>
            <p><strong>お問い合わせの種類</strong> {{ $contact->category->content ?? '' }}</p>
            <p><strong>お問い合わせ内容</strong><br>{{ $contact->detail }}</p>

            <form method="post" action="/admin/delete/{{ $contact->id }}">
                @csrf
                @method('DELETE')
                <button class="delete-btn">削除</button>
            </form>
        </div>

    </div>
</div>
@endforeach
<script>
function openModal(id) {
    document.getElementById('modal-' + id).style.display = 'block';
}

function closeModal(id) {
    document.getElementById('modal-' + id).style.display = 'none';
}
</script>