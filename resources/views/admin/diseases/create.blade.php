@extends('admin.layouts.master')
@section('title', 'Add Disease')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add New Disease</h3>

    <form action="{{ route('admin.diseases.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.diseases._form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="{{ route('admin.diseases.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
