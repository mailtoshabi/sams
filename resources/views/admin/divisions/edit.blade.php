@extends('admin.layouts.master')
@section('title', 'Edit Division')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Division: {{ $division->name }}</h3>

    <form action="{{ route('admin.divisions.update', $division->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.divisions._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.divisions.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
