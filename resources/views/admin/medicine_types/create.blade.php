@extends('admin.layouts.master')
@section('title', 'Add Medicine Types')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add Medicine Types</h3>

    <form action="{{ route('admin.medicine_types.store') }}" method="POST">
        @csrf
        @include('admin.medicine_types._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="{{ route('admin.medicine_types.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
