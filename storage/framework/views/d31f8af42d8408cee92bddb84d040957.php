<div class="row g-3">

    <!-- Formulation -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Formulation</label>
        <select name="formulation_id" class="form-select">
            <option value="">Select Formulation</option>
            <?php $__currentLoopData = $formulations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formulation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($formulation->id); ?>"
                    <?php echo e(old('formulation_id', $selected->formulation_id ?? '') == $formulation->id ? 'selected' : ''); ?>>
                    <?php echo e($formulation->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- Medicine -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Medicine</label>
        <select name="medicine_id" class="form-select">
            <option value="">Select Medicine</option>
            <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($medicine->id); ?>"
                    <?php echo e(old('medicine_id', $selected->medicine_id ?? '') == $medicine->id ? 'selected' : ''); ?>>
                    <?php echo e($medicine->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\partials\_medicine_fields.blade.php ENDPATH**/ ?>