@extends('admin.layouts.master')
@section('title', 'View Chapter')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-diagram-3"></i> {{ $chapter->name }}</h3>
        <div>
            <a href="{{ route('admin.chapters.edit', $chapter->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('admin.chapters.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Status:</strong>
                <span class="badge bg-{{ $chapter->status == 'published' ? 'success' : 'secondary' }}">
                    {{ ucfirst($chapter->status) }}
                </span>
            </p>
            <p><strong>Description:</strong></p>
            <div>{!! $chapter->description !!}</div>
        </div>
    </div>
</div>
@endsection
