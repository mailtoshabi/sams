@extends('admin.layouts.master')
@section('title', isset($author) ? 'Edit Author' : 'Add Author')

@section('content')
<div class="container mt-4">
    @php $editMode = isset($author); @endphp

    <h3 class="mb-4">
        {{ $editMode ? 'Edit Author: ' . $author->name : 'Add Author' }}
    </h3>

    <form action="{{ $editMode ? route('admin.authors.update', $author->id) : route('admin.authors.store') }}" method="POST">
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
                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                               value="{{ old('name', $author->name ?? '') }}"
                               placeholder="Enter author name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Designation --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Designation</label>
                        <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"
                               value="{{ old('designation', $author->designation ?? '') }}"
                               placeholder="Enter designation">
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-{{ $editMode ? 'success' : 'primary' }}">
                <i class="bi bi-save"></i> {{ $editMode ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
