@extends('admin.layouts.master')
@section('title', 'Add Division')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add Division</h3>

    <form action="{{ route('admin.divisions.store') }}" method="POST">
        @csrf
        @include('admin.divisions._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="{{ route('admin.divisions.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
