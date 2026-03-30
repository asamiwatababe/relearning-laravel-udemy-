@extends('layouts.app')

@section('title', 'お手伝いリスト')

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
            <h1 class="page-title">📋 お手伝いリスト</h1>
            <p class="page-subtitle">登録されているお手伝いの種類とポイントを管理します。</p>
        </div>
        @if (session('is_admin'))
        <div class="header-actions">
            <a href="{{ route('chores.create') }}" class="button">➕ 新規登録</a>
        </div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>📂 カテゴリ</th>
                <th>🧹 お手伝い名</th>
                <th>⭐ ポイント</th>
                @if (session('is_admin'))
                <th>⚙️ 操作</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($chores as $chore)
            <tr>
                <td>{{ $chore->category }}</td>
                <td>{{ $chore->name }}</td>
                <td>{{ $chore->points }}pt</td>
                @if (session('is_admin'))
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('chores.edit', $chore) }}" class="button button-secondary">✏️ 編集</a>
                        <form action="{{ route('chores.destroy', $chore) }}"
                            method="POST"
                            onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete-button">🗑️ 削除</button>
                        </form>
                    </div>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="{{ session('is_admin') ? 4 : 3 }}" class="empty-message">まだお手伝いが登録されていません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
