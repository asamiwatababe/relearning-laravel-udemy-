@extends('layouts.app')

@section('title', 'お金管理一覧')

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
            <h1 class="page-title">お金管理一覧</h1>
        </div>
    </div>

    <div class="summary">
        <x-money-records.living-expense-check :currentMonthLivingExpense="$currentMonthLivingExpense" />
        <x-money-records.month-picker :selectedMonth="$selectedMonth" />
    </div>

    <table>
        <thead>
            <tr>
                <th>ユーザー</th>
                <th>金額</th>
                <th>日付</th>
                <th>メモ</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($moneyRecords as $moneyRecord)
            <tr>
                <td>{{ $moneyRecord->user?->name ?? '未設定' }}</td>
                <td>{{ number_format($moneyRecord->amount) }}円</td>
                <td>{{ $moneyRecord->record_date }}</td>
                <td>{{ $moneyRecord->note }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('money-records.edit', $moneyRecord) }}" class="button button-secondary">編集</a>

                        <form action="{{ route('money-records.destroy', $moneyRecord) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete-button">削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-message">この月のお小遣い記録はまだありません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    window.moneyRecordToggleConfig = {
        csrfToken: '{{ csrf_token() }}'
    };
</script>
<script src="{{ asset('js/money-records/index.js') }}"></script>
@endpush