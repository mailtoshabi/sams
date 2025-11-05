@extends('admin.layouts.master')
@section('title', 'Add Title')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add Title</h3>
    <form action="{{ route('admin.titles.store') }}" method="POST">
        @csrf
        @include('admin.titles._form', ['title' => $title])
        <div class="mt-3">
            <button class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="{{ route('admin.titles.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
