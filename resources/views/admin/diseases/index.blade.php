@extends('admin.layouts.master')
@section('title', 'Diseases')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Diseases</h3>
        <a href="{{ route('admin.diseases.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Disease
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Titles</th>
                    <th>Updated</th>
                    <th class="text-center" width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($diseases as $disease)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $disease->name }}</strong><br>
                            <small class="text-muted">{{ $disease->slug }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $disease->status === 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($disease->status) }}
                            </span>
                        </td>
                        <td>
                            @foreach($disease->titles as $title)
                                <span class="badge bg-info text-dark">{{ $title->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $disease->updated_at->diffForHumans() }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.diseases.show', $disease->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.diseases.edit', $disease->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.diseases.destroy', $disease->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this disease?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">No diseases found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $diseases->links() }}
</div>
@endsection
