@extends('admin.layouts.master')
@section('title', 'Edit Chapter')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Chapter: {{ $chapter->name }}</h3>

    <form action="{{ route('admin.chapters.update', $chapter->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.chapters._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.chapters.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
