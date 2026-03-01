@extends('admin.layouts.master')
@section('title', 'View Medicine Types')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-diagram-3"></i> {{ $medicine_types->name }}</h3>
        <div>
            <a href="{{ route('admin.medicine_types.edit', $medicine_types->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('admin.medicine_types.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Status:</strong>
                <span class="badge bg-{{ $medicine_types->status == 'published' ? 'success' : 'secondary' }}">
                    {{ ucfirst($medicine_types->status) }}
                </span>
            </p>
            <p><strong>Description:</strong></p>
            <div>{!! $medicine_types->description !!}</div>
        </div>
    </div>
</div>
@endsection
