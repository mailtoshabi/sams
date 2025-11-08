@php
    $editMode = isset($disease);
@endphp

<div class="row g-3">

    {{-- Disease Name --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Disease Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $disease->name ?? '') }}" required
               placeholder="Enter disease name">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Ayurveda Name</label>
        <input type="text" name="ayurveda_name" class="form-control"
            value="{{ old('ayurveda_name', $disease->ayurveda_name ?? '') }}"
            placeholder="Enter Ayurveda name">
    </div>

    {{-- Status --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="published" {{ old('status', $disease->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ old('status', $disease->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div>

    {{-- Image --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Main Image</label>
        <input type="file" name="image" id="mainImageInput" class="form-control">
        <div class="mt-2" id="mainPreviewContainer">
            @if(!empty($disease->image_path))
                <img id="mainPreviewImage" src="{{ asset('storage/'.$disease->image_path) }}" width="120" class="rounded border">
            @else
                <img id="mainPreviewImage" src="#" width="120" class="rounded border d-none">
            @endif
        </div>
    </div>

    {{-- Description --}}
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" id="mainEditor" class="form-control" rows="5">{{ old('description', $disease->description ?? '') }}</textarea>
    </div>

</div>

<hr class="my-4">

{{-- Title-based Dynamic Sections --}}
<h5 class="mb-3">Titles & Detailed Information</h5>
@if($titles->count() > 0)
@foreach($titles as $title)
    @php
        $pivot = $editMode
            ? $disease->titles->firstWhere('id', $title->id)?->pivot
            : null;
    @endphp

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-light fw-bold">
            {{ $title->name }}
        </div>
        <div class="card-body">
            <div class="row g-3 align-items-start">
                <div class="col-md-6">
                    <label class="form-label">Heading</label>
                    <input type="text"
                           name="titles[{{ $title->id }}][heading]"
                           class="form-control"
                           value="{{ old('titles.'.$title->id.'.heading', $pivot->heading ?? '') }}"
                           placeholder="Enter heading for {{ $title->name }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="titles[{{ $title->id }}][image]" class="form-control image-input" data-preview="preview_{{ $title->id }}">
                    <div class="mt-2">
                        @if(!empty($pivot?->image_path))
                            <img id="preview_{{ $title->id }}" src="{{ asset('storage/'.$pivot->image_path) }}" width="120" class="rounded border">
                        @else
                            <img id="preview_{{ $title->id }}" src="#" width="120" class="rounded border d-none">
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="titles[{{ $title->id }}][description]" id="editor_{{ $title->id }}" class="form-control" rows="4">{{ old('titles.'.$title->id.'.description', $pivot->description ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endforeach
@else
No Titles Found. <a href="{{ route('admin.titles.create') }}">Add a New Title</a>
@endif
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('#mainEditor')) {
                ClassicEditor.create(document.querySelector('#mainEditor')).catch(console.error);
            }
            document.querySelectorAll('textarea[id^="editor_"]').forEach(el => {
                ClassicEditor.create(el).catch(console.error);
            });

            const mainInput = document.getElementById('mainImageInput');
            const mainPreview = document.getElementById('mainPreviewImage');
            if (mainInput) {
                mainInput.addEventListener('change', e => {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = ev => {
                            mainPreview.src = ev.target.result;
                            mainPreview.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            document.querySelectorAll('.image-input').forEach(input => {
                input.addEventListener('change', e => {
                    const file = e.target.files[0];
                    const previewEl = document.getElementById(e.target.dataset.preview);
                    if (file && previewEl) {
                        const reader = new FileReader();
                        reader.onload = ev => {
                            previewEl.src = ev.target.result;
                            previewEl.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
@endpush
