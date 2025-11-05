<div class="row g-3">

    <!-- Division -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Division</label>
        <select name="division_id" class="form-select">
            <option value="">Select Division</option>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}"
                    {{ old('division_id', $selected->division_id ?? '') == $division->id ? 'selected' : '' }}>
                    {{ $division->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Chapter -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Chapter</label>
        <select name="chapter_id" class="form-select">
            <option value="">Select Chapter</option>
            @foreach($chapters as $chapter)
                <option value="{{ $chapter->id }}"
                    {{ old('chapter_id', $selected->chapter_id ?? '') == $chapter->id ? 'selected' : '' }}>
                    {{ $chapter->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Formulation -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Formulation</label>
        <select name="formulation_id" class="form-select">
            <option value="">Select Formulation</option>
            @foreach($formulations as $formulation)
                <option value="{{ $formulation->id }}"
                    {{ old('formulation_id', $selected->formulation_id ?? '') == $formulation->id ? 'selected' : '' }}>
                    {{ $formulation->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Medicine -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Medicine</label>
        <select name="medicine_id" class="form-select">
            <option value="">Select Medicine</option>
            @foreach($medicines as $medicine)
                <option value="{{ $medicine->id }}"
                    {{ old('medicine_id', $selected->medicine_id ?? '') == $medicine->id ? 'selected' : '' }}>
                    {{ $medicine->name }}
                </option>
            @endforeach
        </select>
    </div>

</div>
