@php $editMode = isset($formulation); @endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Name</label>
        <input type="text" name="name" class="form-control" required
               value="{{ old('name', $formulation->name ?? '') }}" placeholder="Formulations name">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="published" {{ old('status', $formulation->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ old('status', $formulation->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $formulation->description ?? '') }}</textarea>
    </div>
</div>
