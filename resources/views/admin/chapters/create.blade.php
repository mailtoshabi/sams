@extends('admin.layouts.master')
@section('title', 'Add Chapter')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add Chapter</h3>

    <form action="{{ route('admin.chapters.store') }}" method="POST">
        @csrf
        @include('admin.chapters._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="{{ route('admin.chapters.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
