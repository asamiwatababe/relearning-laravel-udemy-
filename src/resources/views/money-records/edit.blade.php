@extends('layouts.app')

@section('title', 'お小遣い編集')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/money-records/form.css') }}">
@endpush

@section('content')
<div class="card form-card">
    <h1 class="page-title">お小遣い編集</h1>
    <p class="page-subtitle">登録済みのお小遣いを更新します</p>

    @if ($errors->any())
    <div class="error-box">
        入力内容を確認してください。
    </div>
    @endif

    <form action="{{ route('money-records.update', $moneyRecord) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">ユーザー</label>
            <select name="user_id" id="user_id">
                <option value="">選択してください</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $moneyRecord->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
            @error('user_id')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">金額</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', $moneyRecord->amount) }}">
            @error('amount')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="record_date">日付</label>
            <input type="date" name="record_date" id="record_date" value="{{ old('record_date', $moneyRecord->record_date) }}">
            @error('record_date')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="note">メモ</label>
            <textarea name="note" id="note">{{ old('note', $moneyRecord->note) }}</textarea>
            @error('note')
            <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-area">
            <a href="{{ route('money-records.index') }}" class="button button-secondary">一覧へ戻る</a>
            <button type="submit" class="button">更新する</button>
        </div>
    </form>
</div>
@endsection