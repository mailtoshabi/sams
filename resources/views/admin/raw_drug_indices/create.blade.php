@extends('admin.layouts.master')
@section('title', isset($rawDrugIndex) ? 'Edit Raw Drug' : 'Add Raw Drug')

@section('content')
<div class="container mt-4">
    @php $editMode = isset($rawDrugIndex); @endphp

    <h3 class="mb-4">
        {{ $editMode ? 'Edit Raw Drug: ' . $rawDrugIndex->name : 'Add Raw Drug' }}
    </h3>

    <form action="{{ $editMode ? route('admin.raw_drug_indices.update', $rawDrugIndex->id) : route('admin.raw_drug_indices.store') }}" method="POST">
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
                               value="{{ old('name', $rawDrugIndex->name ?? '') }}"
                               placeholder="Enter drug name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Local Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Local Name</label>
                        <input type="text" name="local_name" class="form-control @error('local_name') is-invalid @enderror"
                               value="{{ old('local_name', $rawDrugIndex->local_name ?? '') }}"
                               placeholder="Enter local name">
                        @error('local_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Sanskrit Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Sanskrit Name</label>
                        <input type="text" name="sanskrit_name" class="form-control @error('sanskrit_name') is-invalid @enderror"
                               value="{{ old('sanskrit_name', $rawDrugIndex->sanskrit_name ?? '') }}"
                               placeholder="Enter sanskrit name">
                        @error('sanskrit_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botanical Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Botanical Name</label>
                        <input type="text" name="botanical_name" class="form-control @error('botanical_name') is-invalid @enderror"
                               value="{{ old('botanical_name', $rawDrugIndex->botanical_name ?? '') }}"
                               placeholder="Enter botanical name">
                        @error('botanical_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Part Used --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Part Used</label>
                        <input type="text" name="part_used" class="form-control @error('part_used') is-invalid @enderror"
                               value="{{ old('part_used', $rawDrugIndex->part_used ?? '') }}"
                               placeholder="Enter part used (e.g., Root, Leaf, Bark)">
                        @error('part_used')
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
            <a href="{{ route('admin.raw_drug_indices.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
