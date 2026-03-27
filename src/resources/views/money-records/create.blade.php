@extends('layouts.app')

@section('title', 'お金記録の登録')

@section('styles')
<style>
    .form-card {
        max-width: 760px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 22px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 14px;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        font-size: 15px;
        box-sizing: border-box;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-group input {
        width: auto;
    }

    .button-area {
        display: flex;
        gap: 14px;
        margin-top: 30px;
    }
</style>
@endsection

@section('content')
<div class="card form-card">
    <h1 class="page-title">お金記録の登録</h1>
    <p class="page-subtitle">お小遣いまたは生活費の記録を追加します</p>

    @if ($errors->any())
    <div class="error-box">
        入力内容を確認してください。
    </div>
    @endif

    <form action="{{ route('money-records.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="type">種類</label>
            <select name="type" id="type">
                <option value="">選択してください</option>
                <option value="allowance" {{ old('type') === 'allowance' ? 'selected' : '' }}>お小遣い</option>
                <option value="living_expense" {{ old('type') === 'living_expense' ? 'selected' : '' }}>生活費</option>
            </select>
            @error('type')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">金額</label>
            <input type="number" name="amount" id="amount" placeholder="例: 80000" value="{{ old('amount') }}">
            @error('amount')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="record_date">日付</label>
            <input type="date" name="record_date" id="record_date" value="{{ old('record_date') }}">
            @error('record_date')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="note">メモ</label>
            <textarea name="note" id="note" placeholder="例: 4月分の生活費">{{ old('note') }}</textarea>
            @error('note')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" name="is_received" id="is_received" value="1" {{ old('is_received') ? 'checked' : '' }}>
            <label for="is_received">受け取り済みにする</label>
        </div>

        <div class="button-area">
            <a href="{{ route('money-records.index') }}" class="button button-secondary">一覧へ戻る</a>
            <button type="submit" class="button">登録する</button>
        </div>
    </form>
</div>
@endsection