@extends('admin.layouts.master')
@section('title', isset($pharmaceuticalForm) ? 'Edit Pharmaceutical Form' : 'Add Pharmaceutical Form')

@section('content')
<div class="container mt-4">
    @php $editMode = isset($pharmaceuticalForm); @endphp

    <h3 class="mb-4">
        {{ $editMode ? 'Edit Pharmaceutical Form: ' . $pharmaceuticalForm->name : 'Add Pharmaceutical Form' }}
    </h3>

    <form action="{{ $editMode ? route('admin.pharmaceutical_forms.update', $pharmaceuticalForm->id) : route('admin.pharmaceutical_forms.store') }}" method="POST">
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
                    <div class="col-12">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                               value="{{ old('name', $pharmaceuticalForm->name ?? '') }}"
                               placeholder="Enter pharmaceutical form name">
                        @error('name')
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
            <a href="{{ route('admin.pharmaceutical_forms.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
