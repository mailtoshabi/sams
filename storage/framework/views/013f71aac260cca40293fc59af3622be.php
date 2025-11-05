<?php
    $contentItem = $contentItem ?? null;
    $selectedCategory = $contentItem->category_id ?? $default_category->id ?? null;
?>

<div class="row g-3">
    <input type="hidden" id="category_id" name="category_id" value="<?php echo e($selectedCategory); ?>">

    <!-- Dynamic sub-fields -->
    <div id="dynamic-fields" class="col-12">
        <?php if($selectedCategory): ?>
            <?php echo $__env->renderWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_CLASSICAL_DISEASE, 'admin.content-items.partials._classical_fields', [
                'divisions' => App\Models\Division::all(),
                'chapters' => App\Models\Chapter::all(),
                'formulations' => App\Models\Formulation::all(),
                'medicines' => App\Models\Medicine::all(),
                'selected' => $contentItem,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

            <?php echo $__env->renderWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_COMMERCIAL_CLASSICAL_MEDICINE || $selectedCategory === \App\Http\Utilities\Utility::CATEGORY_PROPRIETARY_MEDICINE, 'admin.content-items.partials._medicine_fields', [
                'formulations' => App\Models\Formulation::all(),
                'medicines' => App\Models\Medicine::all(),
                'selected' => $contentItem,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

            <?php echo $__env->renderWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_PATENT_MEDICINE || $selectedCategory === \App\Http\Utilities\Utility::CATEGORY_MORDERN_DISEASE, 'admin.content-items.partials._disease_fields', [
                'diseases' => App\Models\Disease::all(),
                'selected' => $contentItem,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

            <?php echo $__env->renderWhen($selectedCategory === \App\Http\Utilities\Utility::CATEGORY_AYURVEDIC_PROCEEDURES, 'admin.content-items.partials._proceedure_fields', [
                'divisions' => App\Models\Division::all(),
                'proceedures' => App\Models\Proceedure::all(),
                'selected' => $contentItem,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\_form.blade.php ENDPATH**/ ?>