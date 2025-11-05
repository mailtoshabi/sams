@php
    $contentItem = $contentItem ?? null;
    $selectedCategory = $contentItem->category_id ?? $default_category->id ?? null;
@endphp


<div class="row g-3">
    <input type="hidden" id="category_id" name="category_id" value="{{ $selectedCategory }}" >

    <!-- Dynamic sub-fields -->
    <div id="dynamic-fields" class="col-12">
        @if(isset($contentItem) && $selectedCategory)
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
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dynamicDiv = document.getElementById('dynamic-fields');
    const categoryId = '{{ $default_category->id }}';

    if (categoryId) {
        dynamicDiv.innerHTML = '<div class="text-muted">Loading fields...</div>';
        axios.get(`/super/admin/ajax/category-fields/${categoryId}`)
            .then(res => dynamicDiv.innerHTML = res.data.html)
            .catch(() => dynamicDiv.innerHTML = '<div class="text-danger">Error loading fields</div>');
    }

    // Initialize CKEditor
    document.querySelectorAll('.ckeditor').forEach(editor => {
        ClassicEditor.create(editor).catch(error => console.error(error));
    });
});
</script>
@endpush
