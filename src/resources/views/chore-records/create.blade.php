@extends('layouts.app')

@section('title', 'お手伝い実績登録')

@section('content')
<div class="card" style="max-width:720px; margin:0 auto;">
    <h1 class="page-title">お手伝い実績登録</h1>
    <p class="page-subtitle">誰がどのお手伝いをしたか記録します</p>

    @if ($errors->any())
    <div class="error-box">入力内容を確認してください。</div>
    @endif

    <form action="{{ route('chore-records.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:22px;">
            <label for="user_id">ユーザー</label>
            <select name="user_id" id="user_id" style="width:100%; padding:14px; border:1px solid #d1d5db; border-radius:12px;">
                <option value="">選択してください</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
            @error('user_id')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:22px;">
            <label for="chore_id">お手伝い</label>
            <select name="chore_id" id="chore_id" style="width:100%; padding:14px; border:1px solid #d1d5db; border-radius:12px;">
                <option value="">選択してください</option>
                @foreach ($chores as $chore)
                <option value="{{ $chore->id }}" {{ old('chore_id') == $chore->id ? 'selected' : '' }}>
                    {{ $chore->category }} / {{ $chore->name }}
                </option>
                @endforeach
            </select>
            @error('chore_id')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:22px;">
            <label for="record_date">日付</label>
            <input type="date" name="record_date" id="record_date" value="{{ old('record_date', date('Y-m-d')) }}"
                style="width:100%; padding:14px; border:1px solid #d1d5db; border-radius:12px;">
            @error('record_date')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:flex; gap:14px;">
            <a href="{{ route('chore-records.index') }}" class="button button-secondary">一覧へ戻る</a>
            <button type="submit" class="button">登録する</button>
        </div>
    </form>
</div>
@endsection