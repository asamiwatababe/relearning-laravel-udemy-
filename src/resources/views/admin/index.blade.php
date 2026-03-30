@extends('layouts.app')

@section('title', '管理画面')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
@endpush

@section('content')

{{-- ── ヘッダー ── --}}
<div class="page-header">
    <div>
        <h1 class="page-title">⚙️ 管理画面</h1>
        <p class="page-subtitle">{{ $now->format('Y年n月') }}</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('users.index') }}" class="button button-secondary">👥 ユーザー管理</a>
        <a href="{{ route('users.create') }}" class="button">➕ ユーザー登録</a>
    </div>
</div>

{{-- ── クイックリンク ── --}}
<div class="card" style="margin-bottom: 20px;">
    <h2 class="section-title">🔗 クイックリンク</h2>
    <div style="display:flex; gap:12px; flex-wrap:wrap;">
        <a href="{{ route('money-records.index') }}" class="button" style="background:linear-gradient(135deg,#6c63ff,#9b59f5);">📋 お小遣い一覧</a>
        <a href="{{ route('money-records.create') }}" class="button" style="background:linear-gradient(135deg,#43b7fe,#5b86e5);">💴 お小遣い登録</a>
        <a href="{{ route('chore-records.index') }}" class="button" style="background:linear-gradient(135deg,#43e97b,#38f9d7); color:#1e1b4b;">🧹 お手伝い一覧</a>
        <a href="{{ route('chore-records.create') }}" class="button" style="background:linear-gradient(135deg,#fa8231,#f9ca24); color:#1e1b4b;">➕ お手伝い登録</a>
        <a href="{{ route('users.index') }}" class="button" style="background:linear-gradient(135deg,#f43f5e,#f97316);">👥 ユーザー管理</a>
        <a href="{{ route('chores.index') }}" class="button" style="background:linear-gradient(135deg,#7c3aed,#4f46e5);">📋 お手伝いリスト</a>
    </div>
</div>

{{-- ── 直近の記録 ── --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

    {{-- 直近お小遣い --}}
    <div class="card">
        <h2 class="section-title">💴 直近のお小遣い</h2>
        <table class="shared-table">
            <thead>
                <tr>
                    <th>👤 名前</th>
                    <th>💴 金額</th>
                    <th>📅 日付</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentMoneyRecords as $record)
                <tr>
                    <td>{{ $record->user?->name ?? '未設定' }}</td>
                    <td style="font-weight:800;color:#6c63ff;">{{ number_format($record->amount) }}円</td>
                    <td style="color:#8b8ba7;">{{ \Carbon\Carbon::parse($record->record_date)->format('n/j') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-message">記録がありません</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 直近お手伝い --}}
    <div class="card">
        <h2 class="section-title">🧹 直近のお手伝い</h2>
        <table class="shared-table">
            <thead>
                <tr>
                    <th>👤 名前</th>
                    <th>🧹 内容</th>
                    <th>⭐ pt</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentChoreRecords as $record)
                <tr>
                    <td>{{ $record->user->name }}</td>
                    <td style="color:#4b4b6b;">{{ $record->chore->name }}</td>
                    <td style="font-weight:800;color:#16a34a;">{{ $record->points }}pt</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-message">記録がありません</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
