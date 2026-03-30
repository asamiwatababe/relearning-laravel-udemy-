@extends('layouts.app')

@section('title', 'ユーザー管理')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
@endpush

@section('content')
<div class="card">
    @if (session('success'))
    <div class="success-box">
        {{ session('success') }}
    </div>
    @endif

    <div class="page-header">
        <div>
            <h1 class="page-title">👥 ユーザー管理</h1>
            <p class="page-subtitle">登録済みのユーザーを管理します</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('admin.index') }}" class="button button-secondary">← 管理画面</a>
            <a href="{{ route('users.create') }}" class="button">➕ 新規登録</a>
        </div>
    </div>

    <table class="shared-table">
        <thead>
            <tr>
                <th>👤 名前</th>
                <th>📅 登録日</th>
                <th class="center">⚙️ 操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>
                    <span style="font-size:22px; margin-right:8px;">🧒</span>
                    <strong>{{ $user->name }}</strong>
                </td>
                <td style="color:#8b8ba7;">{{ $user->created_at->format('Y年n月j日') }}</td>
                <td class="center">
                    <div class="action-buttons" style="justify-content:center;">
                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                              onsubmit="return confirm('「{{ $user->name }}」を削除しますか？\n関連するデータも削除されます。');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete-button">🗑️ 削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="empty-message">まだユーザーが登録されていません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
