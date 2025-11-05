<div class="row g-3">

    <!-- Division -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Division</label>
        <select name="division_id" class="form-select">
            <option value="">Select Division</option>
            <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($division->id); ?>"
                    <?php echo e(old('division_id', $selected->division_id ?? '') == $division->id ? 'selected' : ''); ?>>
                    <?php echo e($division->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- Chapter -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Chapter</label>
        <select name="chapter_id" class="form-select">
            <option value="">Select Chapter</option>
            <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($chapter->id); ?>"
                    <?php echo e(old('chapter_id', $selected->chapter_id ?? '') == $chapter->id ? 'selected' : ''); ?>>
                    <?php echo e($chapter->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

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
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\partials\_classical_fields.blade.php ENDPATH**/ ?>