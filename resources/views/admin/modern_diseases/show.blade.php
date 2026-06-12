@extends('admin.layouts.master')
@section('title', 'Modern Disease Link Details')

@section('content')
<div class="container mt-4">
    @component('admin.dir_components.breadcrumb')
    @slot('li_1') Modern Diseases @endslot
    @slot('li_2') Link Details @endslot
    @slot('title') Modern Disease Link Details @endslot
    @endcomponent

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Link Details</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Division Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td>{{ $modernDisease->division?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td>{{ $modernDisease->division?->ayurveda_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $modernDisease->division?->slug ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ ($modernDisease->division?->status ?? 'draft') === 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($modernDisease->division?->status ?? 'draft') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Disease Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td>{{ $modernDisease->disease?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td>{{ $modernDisease->disease?->ayurveda_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $modernDisease->disease?->slug ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ ($modernDisease->disease?->status ?? 'draft') === 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($modernDisease->disease?->status ?? 'draft') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-light shadow-sm">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0 text-primary">
                                <i class="bi bi-capsule me-2"></i>Linked Medicines
                            </h6>
                        </div>
                        <div class="card-body">
                            @if($modernDisease->medicines->count() > 0)
                                <div class="row g-2">
                                    @foreach($modernDisease->medicines as $med)
                                        <div class="col-md-4">
                                            <div class="bg-light p-2 rounded border-start border-primary border-3 d-flex align-items-center">
                                                <i class="bi bi-capsule text-primary me-2"></i>
                                                <span class="fw-semibold text-dark">{{ $med->name }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">No medicines linked to this disease yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-light shadow-sm">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0 text-primary">
                                <i class="bi bi-activity me-2"></i>Linked Procedures
                            </h6>
                        </div>
                        <div class="card-body">
                            @if($modernDisease->proceedures->count() > 0)
                                <div class="row g-3">
                                    @foreach($modernDisease->proceedures as $proc)
                                        <div class="col-md-6">
                                            <div class="bg-light p-3 rounded border-start border-success border-3 h-100 d-flex flex-column justify-content-center">
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="bi bi-activity text-success me-2 fs-5"></i>
                                                    <span class="fw-semibold text-dark">{{ $proc->name }}</span>
                                                </div>
                                                @if($proc->pivot->description)
                                                    <p class="text-muted small mb-0 ms-4">{{ $proc->pivot->description }}</p>
                                                @else
                                                    <p class="text-muted small mb-0 ms-4 text-opacity-50"><i>No custom description provided.</i></p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">No procedures linked to this disease yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.modern_diseases.edit', $modernDisease->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Link
                </a>
                <a href="{{ route('admin.modern_diseases.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
