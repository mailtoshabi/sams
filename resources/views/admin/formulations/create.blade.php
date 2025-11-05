@extends('admin.layouts.master')
@section('title', 'Add Formulations')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add Formulations</h3>

    <form action="{{ route('admin.formulations.store') }}" method="POST">
        @csrf
        @include('admin.formulations._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="{{ route('admin.formulations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
