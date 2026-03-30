@extends('layouts.app')

@section('title', 'お手伝いリスト編集')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/chore-records/form.css') }}">
@endpush

@section('content')
@include('chores._form', [
    'title'       => '✏️ お手伝いリスト編集',
    'subtitle'    => 'お手伝いの内容を変更します。',
    'action'      => route('chores.update', $chore),
    'method'      => 'PUT',
    'submitLabel' => '更新する',
])
@endsection
