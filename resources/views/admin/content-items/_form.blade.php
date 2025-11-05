@php
    $contentItem = $contentItem ?? null;
    $selectedCategory = $contentItem->category_id ?? $default_category->id ?? null;
@endphp

<div class="row g-3">
    <input type="hidden" id="category_id" name="category_id" value="{{ $selectedCategory }}">

    <!-- Dynamic sub-fields -->
    <div id="dynamic-fields" class="col-12">
        @if($selectedCategory)
            @includeWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_CLASSICAL_DISEASE, 'admin.content-items.partials._classical_fields', [
                'divisions' => App\Models\Division::all(),
                'chapters' => App\Models\Chapter::all(),
                'formulations' => App\Models\Formulation::all(),
                'medicines' => App\Models\Medicine::all(),
                'selected' => $contentItem,
            ])

            @includeWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_COMMERCIAL_CLASSICAL_MEDICINE || $selectedCategory === \App\Http\Utilities\Utility::CATEGORY_PROPRIETARY_MEDICINE, 'admin.content-items.partials._medicine_fields', [
                'formulations' => App\Models\Formulation::all(),
                'medicines' => App\Models\Medicine::all(),
                'selected' => $contentItem,
            ])

            @includeWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_PATENT_MEDICINE || $selectedCategory === \App\Http\Utilities\Utility::CATEGORY_MORDERN_DISEASE, 'admin.content-items.partials._disease_fields', [
                'diseases' => App\Models\Disease::all(),
                'selected' => $contentItem,
            ])

            @includeWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_AYURVEDIC_PROCEEDURES, 'admin.content-items.partials._proceedure_fields', [
                'divisions' => App\Models\Division::all(),
                'proceedures' => App\Models\Proceedure::all(),
                'selected' => $contentItem,
            ])
        @endif
    </div>
</div>
