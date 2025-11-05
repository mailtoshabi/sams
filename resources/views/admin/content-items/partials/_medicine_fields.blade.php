<div class="row g-3">

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
