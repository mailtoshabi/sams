@extends('admin.layouts.master')
@section('title', isset($article) ? 'Edit Article' : 'Add Article')

@section('content')
<div class="container mt-4">
    @php $editMode = isset($article); @endphp

    <h3 class="mb-4">
        {{ $editMode ? 'Edit Article: ' . $article->heading : 'Add Article' }}
    </h3>

    <form action="{{ $editMode ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}" method="POST">
        @csrf
        @if($editMode)
            @method('PUT')
        @endif

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    {{-- Heading --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" required
                               value="{{ old('heading', $article->heading ?? '') }}"
                               placeholder="Enter article heading">
                        @error('heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Author --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Author <span class="text-danger">*</span></label>
                        <select name="author_id" class="form-select @error('author_id') is-invalid @enderror" required>
                            <option value="">-- Select Author --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id', $article->author_id ?? '') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Article Content --}}
                <div class="mt-3">
                    <label class="form-label fw-semibold">Article Content <span class="text-danger">*</span></label>
                    <textarea name="article" class="form-control @error('article') is-invalid @enderror" required
                              rows="10" placeholder="Enter article content here...">{{ old('article', $article->article ?? '') }}</textarea>
                    @error('article')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-{{ $editMode ? 'success' : 'primary' }}">
                <i class="bi bi-save"></i> {{ $editMode ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
