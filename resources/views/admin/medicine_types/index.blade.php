@extends('admin.layouts.master')
@section('title', 'Medicine Types')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Medicine Types</h3>
        <a href="{{ route('admin.medicine_types.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Medicine Types
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔍 Search + Filter --}}
    <form method="GET" action="{{ route('admin.medicine_types.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="all">All Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('admin.medicine_types.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Reset
            </a>
        </div>
    </form>

    {{-- ✅ Table --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th width="150" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicine_types as $medicine_type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $medicine_type->name }}</td>
                            <td>
                                <span class="badge bg-{{ $medicine_type->status === 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($medicine_type->status) }}
                                </span>
                            </td>
                            <td>{{ $medicine_type->updated_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.medicine_types.show', $medicine_type->id) }}" class="btn btn-sm btn-info" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.medicine_types.edit', $medicine_type->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.medicine_types.destroy', $medicine_type->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this Medicine Type?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">No Medicine Type found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-center">{{ $medicine_types->links() }}</div>
    </div>
</div>
@endsection
