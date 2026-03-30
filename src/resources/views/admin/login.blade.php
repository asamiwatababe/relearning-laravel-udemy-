@extends('layouts.app')

@section('title', '管理者ログイン')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
@endpush

@section('content')
<div class="card form-card" style="max-width:420px;">

    <div style="text-align:center; margin-bottom:28px;">
        <div style="font-size:52px; margin-bottom:12px;">🔐</div>
        <h1 class="page-title" style="justify-content:center;">管理者ログイン</h1>
        <p class="page-subtitle">管理者パスワードを入力してください</p>
    </div>

    @if (session('error'))
    <div class="error-box">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="password">🔑 パスワード</label>
            <input
                type="password"
                name="password"
                id="password"
                placeholder="パスワードを入力"
                autofocus>
            @error('password')
            <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="button-area" style="margin-top:20px;">
            <button type="submit" class="button" style="width:100%;">ログイン</button>
        </div>
    </form>

    <div style="margin-top:20px; text-align:center;">
        <a href="{{ route('money-records.index') }}" style="color:#8b8ba7; font-size:13px; text-decoration:none;">
            ← 閲覧画面に戻る
        </a>
    </div>
</div>
@endsection
