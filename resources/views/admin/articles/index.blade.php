@extends('admin.layouts.master')
@section('title', 'Articles')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Articles</h3>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Article
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Search & Filter --}}
            <form method="GET" action="{{ route('admin.articles.index') }}" class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search by heading or content..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="author_id" class="form-select">
                        <option value="">All Authors</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Articles Table --}}
            @if($articles->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Heading</th>
                                <th>Author</th>
                                <th>Content Preview</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $key => $article)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td class="fw-semibold">{{ $article->heading }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $article->author->name }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($article->article), 50) }}
                                        </small>
                                    </td>
                                    <td>
                                        <small>{{ $article->created_at->format('d M, Y') }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $articles->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> No articles found.
                    <a href="{{ route('admin.articles.create') }}">Create your first article</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
