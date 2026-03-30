@extends('layouts.app')

@section('title', '新規ユーザー登録')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
@endpush

@section('content')
<div class="card form-card">

    <h1 class="page-title">👤 新規ユーザー登録</h1>
    <p class="page-subtitle">名前を入力するだけで登録できます</p>

    @if ($errors->any())
    <div class="error-box">
        入力内容を確認してください。
    </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">👤 名前</label>
            <input
                type="text"
                name="name"
                id="name"
                placeholder="例：たろう"
                value="{{ old('name') }}">
            @error('name')
            <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="button-area">
            <a href="{{ route('users.index') }}" class="button button-secondary">← 一覧へ戻る</a>
            <button type="submit" class="button">➕ 登録する</button>
        </div>
    </form>
</div>
@endsection
