@extends('layouts.app')

@section('title', 'お手伝い実績登録')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/chore-records/form.css') }}">
@endpush

@section('content')
    @include('chore-records._form', [
        'title' => 'お手伝い実績登録',
        'subtitle' => 'お手伝い実績を登録します',
        'action' => route('chore-records.store'),
        'submitLabel' => '登録する',
    ])
@endsection