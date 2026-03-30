@extends('layouts.app')

@section('title', 'お手伝いリスト登録')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/chore-records/form.css') }}">
@endpush

@section('content')
@include('chores._form', [
    'title'       => '📝 お手伝いリスト登録',
    'subtitle'    => '新しいお手伝いの種類を登録します。',
    'action'      => route('chores.store'),
    'submitLabel' => '登録する',
])
@endsection
