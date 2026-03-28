@extends('admin.layouts.master')
@section('title', isset($therapeuticDifference) ? 'Edit Therapeutic Difference' : 'Add Therapeutic Difference')

@section('content')
<div class="container mt-4">
    @php $editMode = isset($therapeuticDifference); @endphp

    <h3 class="mb-4">
        {{ $editMode ? 'Edit Therapeutic Difference' : 'Add Therapeutic Difference' }}
    </h3>

    <form action="{{ $editMode ? route('admin.therapeutic_differences.update', $therapeuticDifference->id) : route('admin.therapeutic_differences.store') }}" method="POST" id="therapeuticDifferenceForm">
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

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    {{-- Medicine 1 --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Medicine 1 <span class="text-danger">*</span></label>
                        <select name="medicine_1_id" class="form-select @error('medicine_1_id') is-invalid @enderror" required id="medicine1Select">
                            <option value="">-- Select Medicine 1 --</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}"
                                    {{ old('medicine_1_id', $therapeuticDifference->medicine_1_id ?? '') == $medicine->id ? 'selected' : '' }}>
                                    {{ $medicine->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('medicine_1_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Medicine 2 --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Medicine 2 <span class="text-danger">*</span></label>
                        <select name="medicine_2_id" class="form-select @error('medicine_2_id') is-invalid @enderror" required id="medicine2Select">
                            <option value="">-- Select Medicine 2 --</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}"
                                    {{ old('medicine_2_id', $therapeuticDifference->medicine_2_id ?? '') == $medicine->id ? 'selected' : '' }}>
                                    {{ $medicine->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('medicine_2_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Introduction --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Introduction</label>
                        <textarea name="introduction" class="form-control @error('introduction') is-invalid @enderror" rows="3"
                                  placeholder="Enter introduction">{{ old('introduction', $therapeuticDifference->introduction ?? '') }}</textarea>
                        @error('introduction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Points Section --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Difference Points</h5>
                <button type="button" class="btn btn-sm btn-success" id="addPointBtn">
                    <i class="bi bi-plus-circle"></i> Add New Point
                </button>
            </div>
            <div class="card-body">
                <div id="pointsContainer">
                    {{-- Points will be added here by JavaScript --}}
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-{{ $editMode ? 'success' : 'primary' }}">
                <i class="bi bi-save"></i> {{ $editMode ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.therapeutic_differences.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
let pointCount = 0;

function addPointRow(medicine1Desc = '', medicine2Desc = '') {
    pointCount++;
    const html = `
        <div class="point-row card mb-3" id="point-${pointCount}">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Point ${pointCount}</span>
                <button type="button" class="btn btn-sm btn-danger" onclick="removePointRow(${pointCount})">
                    <i class="bi bi-trash"></i> Remove
                </button>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span id="med1-label">Medicine 1</span> Description <span class="text-danger">*</span>
                        </label>
                        <textarea name="points[${pointCount - 1}][medicine_1_description]"
                                  class="form-control"
                                  rows="3" required
                                  placeholder="Describe for Medicine 1">${medicine1Desc}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span id="med2-label">Medicine 2</span> Description <span class="text-danger">*</span>
                        </label>
                        <textarea name="points[${pointCount - 1}][medicine_2_description]"
                                  class="form-control"
                                  rows="3" required
                                  placeholder="Describe for Medicine 2">${medicine2Desc}</textarea>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.getElementById('pointsContainer').insertAdjacentHTML('beforeend', html);
    updateMedicineLabels();
}

function removePointRow(id) {
    document.getElementById(`point-${id}`).remove();
}

function updateMedicineLabels() {
    const medicine1Selector = document.getElementById('medicine1Select');
    const medicine2Selector = document.getElementById('medicine2Select');

    const med1Label = medicine1Selector.options[medicine1Selector.selectedIndex]?.text || 'Medicine 1';
    const med2Label = medicine2Selector.options[medicine2Selector.selectedIndex]?.text || 'Medicine 2';

    document.querySelectorAll('#med1-label').forEach(el => el.textContent = med1Label);
    document.querySelectorAll('#med2-label').forEach(el => el.textContent = med2Label);
}

// Initialize medicine change listeners
document.getElementById('medicine1Select').addEventListener('change', updateMedicineLabels);
document.getElementById('medicine2Select').addEventListener('change', updateMedicineLabels);

// Add point button listener
document.getElementById('addPointBtn').addEventListener('click', function () {
    addPointRow();
});

// On page load, load existing points (if editing) or add first point row
document.addEventListener('DOMContentLoaded', function () {
    @if($editMode && $therapeuticDifference->points->count() > 0)
        @foreach($therapeuticDifference->points as $point)
            addPointRow(`{{ $point->medicine_1_description }}`, `{{ $point->medicine_2_description }}`);
        @endforeach
    @else
        addPointRow();
    @endif
    updateMedicineLabels();
});
</script>

<style>
.point-row {
    border-left: 4px solid #007bff;
    animation: slideIn 0.3s ease-in-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection
