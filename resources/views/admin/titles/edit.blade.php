@extends('admin.layouts.master')
@section('title', 'Edit Title')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Title</h3>
    <form action="{{ route('admin.titles.update', $title->id) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.titles._form', ['title' => $title])
        <div class="mt-3">
            <button class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.titles.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
