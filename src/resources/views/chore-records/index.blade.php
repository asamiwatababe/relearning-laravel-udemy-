@extends('layouts.app')

@section('title', 'お手伝いポイント一覧')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/money-records/index.css') }}">
@endpush

@section('content')
<div class="card">
    @if (session('success'))
    <div class="success-box">
        {{ session('success') }}
    </div>
    @endif

    <div class="header">
        <div>
            <h1 class="page-title">お手伝いポイント一覧</h1>
            <p class="page-subtitle">今月のポイントと来月のお小遣いを確認できます</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('chore-records.create') }}" class="button">＋ お手伝い実績登録</a>
        </div>
    </div>

    <div class="summary">
        <div class="summary-box calendar-box">
            <div class="summary-label">表示月</div>

            <form method="GET" action="{{ route('chore-records.index') }}">
                <input
                    type="month"
                    name="month"
                    value="{{ $selectedMonth }}"
                    class="month-input"
                    onchange="this.form.submit()">
            </form>

            <p class="calendar-note">月を切り替えると一覧と集計が連動します</p>
        </div>

        <div class="summary-box">
            <div class="summary-label">ユーザー数</div>
            <div class="summary-value">{{ $users->count() }}人</div>
        </div>
    </div>

    <div class="summary">
        @foreach ($users as $user)
        @php
        $monthlyPoints = $user->choreRecords->sum('points');
        $nextAllowance = $monthlyPoints;
        @endphp

        <div class="summary-box">
            <div class="summary-label">{{ $user->name }}</div>
            <div class="summary-value">{{ $monthlyPoints }}pt</div>
            <p class="page-subtitle">来月のお小遣い: {{ number_format($nextAllowance) }}円</p>
        </div>
        @endforeach
    </div>

    <table>
        <thead>
            <tr>
                <th>ユーザー</th>
                <th>お手伝い</th>
                <th>日付</th>
                <th>ポイント</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($choreRecords as $record)
            <tr>
                <td>{{ $record->user->name }}</td>
                <td>{{ $record->chore->name }}</td>
                <td>{{ $record->record_date }}</td>
                <td>{{ $record->points }}pt</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('chore-records.edit', $record) }}" class="button button-secondary">編集</a>

                        <form action="{{ route('chore-records.destroy', $record) }}"
                            method="POST"
                            onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete-button">削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-message">まだ実績がありません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection