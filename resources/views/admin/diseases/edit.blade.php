@extends('admin.layouts.master')
@section('title', 'Edit Disease')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Disease: {{ $disease->name }}</h3>

    <form action="{{ route('admin.diseases.update', $disease->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.diseases._form')

        <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.diseases.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
