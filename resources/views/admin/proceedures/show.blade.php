@extends('admin.layouts.master')
@section('title', 'View Proceedure')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fas fa-leaf"></i> {{ $proceedure->name }}
        </h3>
        <div>
            <a href="{{ route('admin.proceedures.edit', $proceedure->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.proceedures.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4 align-items-start">
                {{-- Proceedure Image --}}
                <div class="col-md-3 text-center">
                    @if($proceedure->image_path)
                        <img src="{{ asset('storage/'.$proceedure->image_path) }}" class="img-fluid rounded shadow-sm" alt="{{ $proceedure->name }}">
                    @else
                        <img src="{{ asset('assets/images/placeholder.jpg') }}" class="img-fluid rounded shadow-sm" alt="No image">
                    @endif
                </div>

                {{-- Basic Info --}}
                <div class="col-md-9">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="180">Name</th>
                            <td>{{ $proceedure->name }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $proceedure->status === 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($proceedure->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $proceedure->description !!}</td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>{{ $proceedure->user?->name ?? 'System' }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $proceedure->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Titles --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light fw-semibold">
            <i class="bi bi-journal-text"></i> Detailed Sections
        </div>
        <div class="card-body">
            @forelse($proceedure->titles as $title)
                <div class="mb-4 pb-3 border-bottom">
                    <h5 class="fw-bold text-primary">{{ $title->name }}</h5>

                    @if(!empty($title->pivot->heading))
                        <h6 class="text-muted mb-2">{{ $title->pivot->heading }}</h6>
                    @endif

                    @if($title->pivot->image_path)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$title->pivot->image_path) }}" class="img-thumbnail rounded" width="200" alt="{{ $title->name }}">
                        </div>
                    @endif

                    @if(!empty($title->pivot->description))
                        <div>{!! $title->pivot->description !!}</div>
                    @else
                        <p class="text-muted fst-italic">No description available.</p>
                    @endif
                </div>
            @empty
                <p class="text-muted text-center py-3">No detailed sections added yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
