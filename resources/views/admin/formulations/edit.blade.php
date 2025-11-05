@extends('admin.layouts.master')
@section('title', 'Edit Formulations')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Formulations: {{ $formulation->name }}</h3>

    <form action="{{ route('admin.formulations.update', $formulation->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.formulations._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.formulations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
