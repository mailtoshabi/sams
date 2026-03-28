<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Title Name</label>
        <input type="text" name="name"
               value="{{ old('name', $title->name ?? '') }}"
               class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type</label>
        <select name="type" class="form-select" required>
            <option value="">Select Type</option>
            <option value="medicine" {{ old('type', $title->type ?? '') == 'medicine' ? 'selected' : '' }}>Medicine</option>
            <option value="disease" {{ old('type', $title->type ?? '') == 'disease' ? 'selected' : '' }}>Disease</option>
            <option value="procedure" {{ old('type', $title->type ?? '') == 'procedure' ? 'selected' : '' }}>Procedure</option>
        </select>
    </div>

    {{-- <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select" required>
            <option value="published" {{ old('status', $title->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ old('status', $title->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div> --}}

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5" class="form-control">{{ old('description', $title->description ?? '') }}</textarea>
    </div>

</div>
