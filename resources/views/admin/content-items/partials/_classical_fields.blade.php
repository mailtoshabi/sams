<div class="row g-3">

    <!-- Division -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Division</label>
        <select name="division_id" id="division_id" class="form-select select2-ajax"
                data-url="{{ route('admin.ajax.divisions') }}" data-placeholder="Search division...">
            <option value="">Select Division</option>

            {{-- If editing, ensure selected value is present so select2 shows it --}}
            @if(!empty($selected->division_id))
                @php $div = \App\Models\Division::find($selected->division_id); @endphp
                @if($div)
                    <option value="{{ $div->id }}" selected>{{ $div->name }}</option>
                @endif
            @endif
        </select>
    </div>

    <!-- Chapter -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Chapter</label>
        <select name="chapter_id" id="chapter_id" class="form-select select2-ajax"
                data-url="{{ route('admin.ajax.chapters') }}"
                data-depends="#division_id"
                data-placeholder="Search chapter...">
            <option value="">Select Chapter</option>

            @if(!empty($selected->chapter_id))
                @php $chap = \App\Models\Chapter::find($selected->chapter_id); @endphp
                @if($chap)
                    <option value="{{ $chap->id }}" selected>{{ $chap->name }}</option>
                @endif
            @endif
        </select>
    </div>

    <!-- Formulation -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Formulation</label>
        <select name="formulation_id" id="formulation_id" class="form-select select2-ajax"
                data-url="{{ route('admin.ajax.formulations') }}" data-placeholder="Search formulation...">
            <option value="">Select Formulation</option>

            @if(!empty($selected->formulation_id))
                @php $f = \App\Models\Formulation::find($selected->formulation_id); @endphp
                @if($f)
                    <option value="{{ $f->id }}" selected>{{ $f->name }}</option>
                @endif
            @endif
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
