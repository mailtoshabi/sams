@extends('admin.layouts.master')
@section('title', isset($newPharmaceuticalForm) ? 'Edit New Pharmaceutical Form' : 'Add New Pharmaceutical Form')

@section('content')
<div class="container mt-4">
    @php $editMode = isset($newPharmaceuticalForm); @endphp

    <h3 class="mb-4">
        {{ $editMode ? 'Edit New Pharmaceutical Form: ' . $newPharmaceuticalForm->name : 'Add New Pharmaceutical Form' }}
    </h3>

    <form action="{{ $editMode ? route('admin.new_pharmaceutical_forms.update', $newPharmaceuticalForm->id) : route('admin.new_pharmaceutical_forms.store') }}" method="POST">
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
                    {{-- Pharmaceutical Form --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pharmaceutical Form <span class="text-danger">*</span></label>
                        <select name="pharmaceutical_form_id" class="form-select @error('pharmaceutical_form_id') is-invalid @enderror" required>
                            <option value="">-- Select Pharmaceutical Form --</option>
                            @foreach($pharmaceuticalForms as $form)
                                <option value="{{ $form->id }}"
                                    {{ old('pharmaceutical_form_id', $newPharmaceuticalForm->pharmaceutical_form_id ?? '') == $form->id ? 'selected' : '' }}>
                                    {{ $form->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pharmaceutical_form_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                               value="{{ old('name', $newPharmaceuticalForm->name ?? '') }}"
                               placeholder="Enter new pharmaceutical form name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Manufacturing Companies --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Manufacturing Companies <span class="text-danger">*</span></label>
                        <div class="@error('manufacturing_company_ids') border border-danger rounded p-2 @endif">
                            @foreach($manufacturingCompanies as $company)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="manufacturing_company_ids[]"
                                           value="{{ $company->id }}" id="company_{{ $company->id }}"
                                           {{ in_array($company->id, old('manufacturing_company_ids', $selectedCompanies ?? [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="company_{{ $company->id }}">
                                        {{ $company->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('manufacturing_company_ids')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-{{ $editMode ? 'success' : 'primary' }}">
                <i class="bi bi-save"></i> {{ $editMode ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.new_pharmaceutical_forms.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
