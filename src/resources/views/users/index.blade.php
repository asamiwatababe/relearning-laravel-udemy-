@extends('layouts.app')

@section('title', 'ユーザー一覧')

@section('content')
<div class="card">
    @if (session('success'))
    <div class="success-box">
        {{ session('success') }}
    </div>
    @endif

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <h1 class="page-title">ユーザー一覧</h1>
            <p class="page-subtitle">登録済みユーザーを表示します</p>
        </div>
        <a href="{{ route('users.create') }}" class="button">＋ ユーザー登録</a>
    </div>

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th style="text-align:left; padding:14px; background:#f3f4f6;">名前</th>
                <th style="text-align:left; padding:14px; background:#f3f4f6;">登録日</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td style="padding:14px; border-bottom:1px solid #eee;">{{ $user->name }}</td>
                <td style="padding:14px; border-bottom:1px solid #eee;">{{ $user->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" style="padding:20px; text-align:center; color:#777;">まだユーザーが登録されていません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection