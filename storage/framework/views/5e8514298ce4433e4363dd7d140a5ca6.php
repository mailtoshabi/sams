<div class="row g-3">

    <!-- Disease -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Disease</label>
        <select name="disease_id" class="form-select select2-ajax" data-url="<?php echo e(route('admin.ajax.diseases')); ?>" data-placeholder="Search disease...">
            <option value="">Select Disease</option>
            <?php $__currentLoopData = $diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($disease->id); ?>"
                    <?php echo e(old('disease_id', $selected->disease_id ?? '') == $disease->id ? 'selected' : ''); ?>>
                    <?php echo e($disease->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- Medicine -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Medicine</label>
        <select name="medicine_id" id="medicine_id" class="form-select select2-ajax"
                data-url="<?php echo e(route('admin.ajax.medicines')); ?>" data-placeholder="Search medicine...">
            <option value="">Select Medicine</option>

            <?php if(!empty($selected->medicine_id)): ?>
                <?php $m = \App\Models\Medicine::find($selected->medicine_id); ?>
                <?php if($m): ?>
                    <option value="<?php echo e($m->id); ?>" selected><?php echo e($m->name); ?></option>
                <?php endif; ?>
            <?php endif; ?>
        </select>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/content-items/partials/_disease_patent_fields.blade.php ENDPATH**/ ?>