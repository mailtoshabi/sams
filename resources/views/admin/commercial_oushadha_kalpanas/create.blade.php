@extends('admin.layouts.master')
@section('title', isset($commercialOushadhaKalpana) ? 'Edit Commercial Oushadha Kalpana' : 'Add Commercial Oushadha Kalpana')

@section('content')
<div class="container mt-4">
    @php $editMode = isset($commercialOushadhaKalpana); @endphp

    <h3 class="mb-4">
        {{ $editMode ? 'Edit Commercial Oushadha Kalpana: ' . $commercialOushadhaKalpana->name : 'Add Commercial Oushadha Kalpana' }}
    </h3>

    <form action="{{ $editMode ? route('admin.commercial_oushadha_kalpanas.update', $commercialOushadhaKalpana->id) : route('admin.commercial_oushadha_kalpanas.store') }}" method="POST">
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
                    {{-- Formulation --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Formulation <span class="text-danger">*</span></label>
                        <select name="formulation_id" class="form-select @error('formulation_id') is-invalid @enderror" required>
                            <option value="">-- Select Formulation --</option>
                            @foreach($formulations as $formulation)
                                <option value="{{ $formulation->id }}"
                                    {{ old('formulation_id', $commercialOushadhaKalpana->formulation_id ?? '') == $formulation->id ? 'selected' : '' }}>
                                    {{ $formulation->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('formulation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                               value="{{ old('name', $commercialOushadhaKalpana->name ?? '') }}"
                               placeholder="Enter commercial oushadha kalpana name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                  placeholder="Enter description">{{ old('description', $commercialOushadhaKalpana->description ?? '') }}</textarea>
                        @error('description')
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
            <a href="{{ route('admin.commercial_oushadha_kalpanas.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
