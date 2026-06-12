@extends('admin.layouts.master')
@section('title', 'Classical Disease Links')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Classical Disease Links</h3>
        <a href="{{ route('admin.classical_diseases.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Link Classical Disease Fields
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.classical_diseases.index') }}" class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Search by Division, Chapter, Type, Formulation or Medicine name"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('admin.classical_diseases.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Reset
            </a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th width="50">#</th>
                    <th>Division</th>
                    <th>Chapter</th>
                    <th>Medicine Type</th>
                    <th>Formulation</th>
                    <th>Medicine</th>
                    <th class="text-center" width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classicalDiseases as $link)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $link->division?->name ?? 'N/A' }}</strong><br>
                            <small class="text-muted">{{ $link->division?->slug }}</small>
                        </td>
                        <td>
                            <strong>{{ $link->chapter?->name ?? 'N/A' }}</strong><br>
                            <small class="text-muted">{{ $link->chapter?->slug }}</small>
                        </td>
                        <td>
                            <strong>{{ $link->medicineType?->name ?? 'N/A' }}</strong><br>
                            <small class="text-muted">{{ $link->medicineType?->slug }}</small>
                        </td>
                        <td>
                            <strong>{{ $link->formulation?->name ?? 'N/A' }}</strong><br>
                            <small class="text-muted">{{ $link->formulation?->slug }}</small>
                        </td>
                        <td>
                            <strong>{{ $link->medicine?->name ?? 'N/A' }}</strong><br>
                            <small class="text-muted">{{ $link->medicine?->slug }}</small>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.classical_diseases.edit', $link->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.classical_diseases.destroy', $link->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this link?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">No links found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $classicalDiseases->links() }}
</div>
@endsection
