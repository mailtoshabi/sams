@extends('admin.layouts.master')
@section('title', 'Commercial Oushadha Kalpanas')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Commercial Oushadha Kalpanas</h3>
        <a href="{{ route('admin.commercial_oushadha_kalpanas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Commercial Oushadha Kalpana
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔍 Search --}}
    <form method="GET" action="{{ route('admin.commercial_oushadha_kalpanas.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('admin.commercial_oushadha_kalpanas.index') }}" class="btn btn-outline-secondary">
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
                        <th>Formulation</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th width="150" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td><span class="badge bg-info">{{ $item->formulation->name ?? 'N/A' }}</span></td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.commercial_oushadha_kalpanas.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.commercial_oushadha_kalpanas.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-3">No items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-center">{{ $items->links() }}</div>
    </div>
</div>
@endsection
