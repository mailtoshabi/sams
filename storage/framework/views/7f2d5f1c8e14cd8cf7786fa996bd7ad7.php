<div class="row g-3">

    <!-- Disease -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Disease</label>
        <select name="disease_id" class="form-select">
            <option value="">Select Disease</option>
            <?php $__currentLoopData = $diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($disease->id); ?>"
                    <?php echo e(old('disease_id', $selected->disease_id ?? '') == $disease->id ? 'selected' : ''); ?>>
                    <?php echo e($disease->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\partials\_disease_fields.blade.php ENDPATH**/ ?>