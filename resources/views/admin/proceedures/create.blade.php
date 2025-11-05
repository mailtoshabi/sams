@extends('admin.layouts.master')
@section('title', 'Add Proceedure')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add New Proceedure</h3>

    <form action="{{ route('admin.proceedures.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.proceedures._form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="{{ route('admin.proceedures.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
