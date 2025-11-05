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

    <!-- Proceedure -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Procedure</label>
        <select name="proceedure_id" class="form-select">
            <option value="">Select Procedure</option>
            @foreach($proceedures as $proceedure)
                <option value="{{ $proceedure->id }}"
                    {{ old('proceedure_id', $selected->proceedure_id ?? '') == $proceedure->id ? 'selected' : '' }}>
                    {{ $proceedure->name }}
                </option>
            @endforeach
        </select>
    </div>

</div>
