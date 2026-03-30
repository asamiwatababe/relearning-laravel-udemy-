@extends('layouts.app')

@section('title', 'お小遣い登録')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/money-records/form.css') }}">
@endpush

@section('content')
<div class="card form-card">
    <h1 class="page-title">💴 お小遣い登録</h1>
    <p class="page-subtitle">お小遣いの記録を追加します</p>

    @if ($errors->any())
    <div class="error-box">
        入力内容を確認してください。
    </div>
    @endif

    <form action="{{ route('money-records.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">👤 ユーザー</label>
            <select name="user_id" id="user_id">
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

        <div class="form-group">
            <label for="amount">💴 金額</label>
            <input type="number" name="amount" id="amount" placeholder="例: 3000" value="{{ old('amount') }}">
            @error('amount')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="record_date">📅 日付</label>
            <input
            type="date"
            name="record_date"
            id="record_date"
            value="{{ old('record_date', date('Y-m-d')) }}"
            max="{{ date('Y-m-d') }}"
            >
        </div>

        <div class="form-group">
            <label for="note">📝 メモ</label>
            <textarea name="note" id="note" placeholder="例: 3月分のお小遣い">{{ old('note') }}</textarea>
            @error('note')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-area">
            <a href="{{ route('money-records.index') }}" class="button button-secondary">一覧へ戻る</a>
            <button type="submit" class="button">登録する</button>
        </div>
    </form>
</div>
@endsection