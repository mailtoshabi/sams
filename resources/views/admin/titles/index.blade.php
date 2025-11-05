@extends('admin.layouts.master')
@section('title', 'Titles')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Titles</h3>
        <a href="{{ route('admin.titles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Title
        </a>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="all">All Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-primary"><i class="bi bi-search"></i> Filter</button>
            <a href="{{ route('admin.titles.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-repeat"></i> Reset</a>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($titles as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->name }}</td>
                            <td>
                                <span class="badge bg-{{ $t->status == 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>
                            <td>{{ $t->updated_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.titles.edit', $t->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.titles.destroy', $t->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Delete this title?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">No titles found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $titles->links() }}
        </div>
    </div>
</div>
@endsection
