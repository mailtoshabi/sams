<div class="row g-3">

    <!-- Disease -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Disease</label>
        <select name="disease_id" class="form-select select2-ajax" data-url="{{ route('admin.ajax.diseases') }}" data-placeholder="Search disease...">
            <option value="">Select Disease</option>
            @foreach($diseases as $disease)
                <option value="{{ $disease->id }}"
                    {{ old('disease_id', $selected->disease_id ?? '') == $disease->id ? 'selected' : '' }}>
                    {{ $disease->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Medicine -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Medicine</label>
        <select name="medicine_id" id="medicine_id" class="form-select select2-ajax"
                data-url="{{ route('admin.ajax.medicines') }}" data-placeholder="Search medicine...">
            <option value="">Select Medicine</option>

            @if(!empty($selected->medicine_id))
                @php $m = \App\Models\Medicine::find($selected->medicine_id); @endphp
                @if($m)
                    <option value="{{ $m->id }}" selected>{{ $m->name }}</option>
                @endif
            @endif
        </select>
    </div>

</div>
