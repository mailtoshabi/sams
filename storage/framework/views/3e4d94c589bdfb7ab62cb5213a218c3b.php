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

    <!-- Proceedure -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Procedure</label>
        <select name="proceedure_id" class="form-select">
            <option value="">Select Procedure</option>
            <?php $__currentLoopData = $proceedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($proceedure->id); ?>"
                    <?php echo e(old('proceedure_id', $selected->proceedure_id ?? '') == $proceedure->id ? 'selected' : ''); ?>>
                    <?php echo e($proceedure->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\partials\_proceedure_fields.blade.php ENDPATH**/ ?>