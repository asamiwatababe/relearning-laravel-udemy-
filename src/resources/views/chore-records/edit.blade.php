@extends('layouts.app')

@section('title', 'お手伝い実績編集')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/chore-records/form.css') }}">
@endpush

@section('content')
    @include('chore-records._form', [
        'title' => 'お手伝い実績編集',
        'subtitle' => '登録済みのお手伝い実績を更新します',
        'action' => route('chore-records.update', $choreRecord),
        'method' => 'PUT',
        'submitLabel' => '更新する',
        'choreRecord' => $choreRecord,
    ])
@endsection