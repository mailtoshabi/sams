@extends('admin.layouts.master')
@section('title', 'Raw Drug Index')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Raw Drug Index</h3>
        <a href="{{ route('admin.raw_drug_indices.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Drug
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔍 Search --}}
    <form method="GET" action="{{ route('admin.raw_drug_indices.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search drug information"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('admin.raw_drug_indices.index') }}" class="btn btn-outline-secondary">
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
                        <th>Local Name</th>
                        <th>Sanskrit Name</th>
                        <th>Botanical Name</th>
                        <th>Part Used</th>
                        <th width="150" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->local_name ?? '-' }}</td>
                            <td>{{ $item->sanskrit_name ?? '-' }}</td>
                            <td>{{ $item->botanical_name ?? '-' }}</td>
                            <td>{{ $item->part_used ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.raw_drug_indices.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.raw_drug_indices.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this drug?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-3">No drugs found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-center">{{ $items->links() }}</div>
    </div>
</div>
@endsection
