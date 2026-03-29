@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('content')
<div class="card" style="max-width: 720px; margin: 0 auto;">
    <h1 class="page-title">ユーザー登録</h1>
    <p class="page-subtitle">名前だけでユーザー登録できます</p>

    @if ($errors->any())
    <div class="error-box">
        入力内容を確認してください。
    </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 22px;">
            <label for="name" style="display:block; margin-bottom:8px; font-weight:bold;">名前</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                style="width:100%; padding:14px; border:1px solid #d1d5db; border-radius:12px; font-size:15px; box-sizing:border-box;">
            @error('name')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:flex; gap:14px;">
            <a href="{{ route('users.index') }}" class="button button-secondary">一覧へ戻る</a>
            <button type="submit" class="button">登録する</button>
        </div>
    </form>
</div>
@endsection