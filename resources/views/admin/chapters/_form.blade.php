@php $editMode = isset($chapter); @endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Name</label>
        <input type="text" name="name" class="form-control" required
               value="{{ old('name', $chapter->name ?? '') }}" placeholder="Chapter name">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="published" {{ old('status', $chapter->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ old('status', $chapter->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $chapter->description ?? '') }}</textarea>
    </div>
</div>
