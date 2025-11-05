@php
    $selectedCategory = $contentItem->category_id ?? $default_category->id;
@endphp

<div class="row g-3">

    <!-- Category -->
    {{-- <div class="col-md-6">
        <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
        <select id="category_id" name="category_id" class="form-select" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div> --}}
    <input type="hidden" id="category_id" name="category_id" value="{{ $selectedCategory }}" >

    <!-- Dynamic sub-fields -->
    <div id="dynamic-fields" class="col-12">
        @if(isset($contentItem) && $selectedCategory)
            {{-- Preload correct field set for editing --}}
            @includeWhen($contentItem->category->id === Utility::CATEGORY_CLASSICAL_DISEASE, 'admin.content-items.partials._classical_fields', [
                'divisions' => App\Models\Division::all(),
                'chapters' => App\Models\Chapter::all(),
                'formulations' => App\Models\Formulation::all(),
                'medicines' => App\Models\Medicine::all(),
                'selected' => $contentItem,
            ])
            @includeWhen($contentItem->category->id === Utility::CATEGORY_COMMERCIAL_CLASSICAL_MEDICINE || $contentItem->category->id === Utility::CATEGORY_PROPRIETARY_MEDICINE, 'admin.content-items.partials._medicine_fields', [
                'formulations' => App\Models\Formulation::all(),
                'medicines' => App\Models\Medicine::all(),
                'selected' => $contentItem,
            ])
            @includeWhen($contentItem->category->id === Utility::CATEGORY_PATENT_MEDICINE || $contentItem->category->id === Utility::CATEGORY_MORDERN_DISEASE, 'admin.content-items.partials._disease_fields', [
                'diseases' => App\Models\Disease::all(),
                'selected' => $contentItem,
            ])
            @includeWhen($contentItem->category->id === Utility::CATEGORY_AYURVEDIC_PROCEEDURES, 'admin.content-items.partials._proceedure_fields', [
                'divisions' => App\Models\Division::all(),
                'proceedures' => App\Models\Proceedure::all(),
                'selected' => $contentItem,
            ])
        @endif
    </div>

    <!-- Title -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Title</label>
        <select name="title_id" class="form-select">
            <option value="">Select Title</option>
            @foreach($titles as $title)
                <option value="{{ $title->id }}"
                    {{ old('title_id', $contentItem->title_id ?? '') == $title->id ? 'selected' : '' }}>
                    {{ $title->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Heading -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Heading</label>
        <input type="text" name="heading" class="form-control"
            value="{{ old('heading', $contentItem->heading ?? '') }}"
            placeholder="Enter heading">
    </div>

    <!-- Description -->
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" id="editor" class="form-control" rows="8">{{ old('description', $contentItem->description ?? '') }}</textarea>
    </div>

    <!-- Image -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Image</label>
        <input type="file" name="image" id="imageInput" class="form-control">
        <div class="mt-2" id="previewContainer">
            @if(!empty($contentItem->image_path))
                <img id="previewImage" src="{{ asset('storage/'.$contentItem->image_path) }}" width="120" class="rounded border">
            @else
                <img id="previewImage" src="#" width="120" class="rounded border d-none">
            @endif
        </div>
    </div>
</div>

@push('scripts')
<!-- Axios for AJAX -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // 🔹 Dynamic category field loading
    const categorySelect = document.getElementById('category_id');
    const dynamicDiv = document.getElementById('dynamic-fields');

    // categorySelect.addEventListener('change', function() {
    //     const categoryId = this.value;
    //     if (!categoryId) return;

    //     dynamicDiv.innerHTML = '<div class="text-muted">Loading fields...</div>';

    //     axios.get(`/super/admin/ajax/category-fields/${categoryId}`)
    //         .then(res => dynamicDiv.innerHTML = res.data.html)
    //         .catch(() => dynamicDiv.innerHTML = '<div class="text-danger">Error loading fields</div>');
    // });

    $(document).ready(function() {
        const categoryId = '{{ $default_category->id }}';
        if (!categoryId) return;

        dynamicDiv.innerHTML = '<div class="text-muted">Loading fields...</div>';

        axios.get(`/super/admin/ajax/category-fields/${categoryId}`)
            .then(res => dynamicDiv.innerHTML = res.data.html)
            .catch(() => dynamicDiv.innerHTML = '<div class="text-danger">Error loading fields</div>');
    });

    // 🔹 Initialize CKEditor 5
    ClassicEditor.create(document.querySelector('#editor'), {
        toolbar: [
            'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
            '|', 'blockQuote', 'insertTable', 'undo', 'redo'
        ]
    }).catch(error => console.error(error));

    // 🔹 Live Image Preview
    const imageInput = document.getElementById('imageInput');
    const previewImg = document.getElementById('previewImage');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            previewImg.src = event.target.result;
            previewImg.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
