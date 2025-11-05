@extends('admin.layouts.master')
@section('title', 'Content Items')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Content Items</h3>
        <a href="{{ route('admin.content-items.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Content Item
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Division / Chapter</th>
                            <th>Formulation</th>
                            <th>Linked Item</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th width="150" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contentItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Category --}}
                                <td>
                                    <strong>{{ $item->category?->name ?? '—' }}</strong>
                                </td>

                                {{-- Division / Chapter --}}
                                <td>
                                    @if($item->division)
                                        <div><i class="bi bi-diagram-3"></i> {{ $item->division->name }}</div>
                                    @endif
                                    @if($item->chapter)
                                        <div><i class="bi bi-book"></i> {{ $item->chapter->name }}</div>
                                    @endif
                                </td>

                                {{-- Formulation --}}
                                <td>
                                    {{ $item->formulation?->name ?? '—' }}
                                </td>

                                {{-- Medicine / Disease / Proceedure --}}
                                <td>
                                    @if($item->medicine)
                                        <span class="badge bg-info text-dark">Medicine</span>
                                        {{ $item->medicine->name }}
                                    @elseif($item->disease)
                                        <span class="badge bg-danger">Disease</span>
                                        {{ $item->disease->name }}
                                    @elseif($item->proceedure)
                                        <span class="badge bg-success">Proceedure</span>
                                        {{ $item->proceedure->name }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td>
                                    <span class="badge bg-{{ $item->status === 'published' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                {{-- Updated --}}
                                <td>{{ $item->updated_at->diffForHumans() }}</td>

                                {{-- Actions --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.content-items.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.content-items.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No content items found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $contentItems->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
