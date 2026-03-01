@extends('admin.layouts.master')
@section('title', 'Edit Medicine Types')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Medicine Types: {{ $medicine_type->name }}</h3>

    <form action="{{ route('admin.medicine_types.update', $medicine_type->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.medicine_types._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.medicine_types.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
