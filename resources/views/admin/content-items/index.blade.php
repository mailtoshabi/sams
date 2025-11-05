@extends('admin.layouts.master')
@section('title', 'Content Items')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Content Items</h3>
        {{-- <a href="{{ route('admin.content-items.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Content Item
        </a> --}}
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔎 Filter & Search Bar --}}
    <form method="GET" action="{{ route('admin.content-items.index') }}" class="card shadow-sm mb-4">
        <div class="card-body row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach(\App\Models\Category::orderBy('name')->get() as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Type</label>
                <select name="type" class="form-select">
                    <option value="">All</option>
                    <option value="medicine" {{ request('type') == 'medicine' ? 'selected' : '' }}>Medicine</option>
                    <option value="disease" {{ request('type') == 'disease' ? 'selected' : '' }}>Disease</option>
                    <option value="proceedure" {{ request('type') == 'proceedure' ? 'selected' : '' }}>Proceedure</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Keyword</label>
                <input type="text" name="search" class="form-control" placeholder="Search keyword..." value="{{ request('search') }}">
            </div>

            <div class="col-md-2 text-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </div>
    </form>

    {{-- Content Items Table --}}
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
                                <td><strong>{{ $item->category?->name ?? '—' }}</strong></td>

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
                                <td>{{ $item->formulation?->name ?? '—' }}</td>

                                {{-- Linked Item --}}
                                <td>
                                    @if($item->medicine)
                                        <span class="badge bg-info text-dark">Medicine</span> {{ $item->medicine->name }}
                                    @elseif($item->disease)
                                        <span class="badge bg-danger">Disease</span> {{ $item->disease->name }}
                                    @elseif($item->proceedure)
                                        <span class="badge bg-success">Proceedure</span> {{ $item->proceedure->name }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-sm toggle-status-btn
                                            {{ $item->status === 'published' ? 'btn-success' : 'btn-secondary' }}"
                                        data-id="{{ $item->id }}"
                                        data-status="{{ $item->status }}">
                                        <i class="bi {{ $item->status === 'published' ? 'bi-check-circle' : 'bi-circle' }}"></i>
                                        {{ ucfirst($item->status) }}
                                    </button>
                                </td>


                                {{-- Updated --}}
                                <td>{{ $item->updated_at->diffForHumans() }}</td>

                                {{-- Actions --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.specific.category.edit', [encrypt($item->category_id), encrypt($item->id)]) }}" class="btn btn-sm btn-warning">
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
                                <td colspan="8" class="text-center text-muted py-4">No content items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $contentItems->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.toggle-status-btn').on('click', function() {
        const button = $(this);
        const id = button.data('id');

        button.prop('disabled', true);
        button.html('<i class="bi bi-hourglass-split"></i> Updating...');

        $.ajax({
            url: `/super/admin/content-items/${id}/toggle-status`,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(res) {
                if (res.success) {
                    const newStatus = res.status;
                    const isPublished = newStatus === 'published';

                    button
                        .data('status', newStatus)
                        .toggleClass('btn-success', isPublished)
                        .toggleClass('btn-secondary', !isPublished)
                        .html(`<i class="bi ${isPublished ? 'bi-check-circle' : 'bi-circle'}"></i> ${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}`);

                    // Optional toast notification
                    toastr.success(res.message);
                } else {
                    toastr.error('Failed to update status.');
                }
            },
            error: function() {
                toastr.error('Error updating status.');
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });
});
</script>

<!-- Optional: Toastr for nice notifications -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
