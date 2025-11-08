<?php $editMode = isset($formulation); ?>

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label fw-semibold">Name</label>
        <input type="text" name="name" class="form-control" required
               value="<?php echo e(old('name', $formulation->name ?? '')); ?>" placeholder="Formulations name">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Ayurveda Name</label>
        <input type="text" name="ayurveda_name" class="form-control"
            value="<?php echo e(old('ayurveda_name', $formulation->ayurveda_name ?? '')); ?>"
            placeholder="Enter Ayurveda name">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="published" <?php echo e(old('status', $formulation->status ?? '') == 'published' ? 'selected' : ''); ?>>Published</option>
            <option value="draft" <?php echo e(old('status', $formulation->status ?? '') == 'draft' ? 'selected' : ''); ?>>Draft</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" class="form-control" rows="4"><?php echo e(old('description', $formulation->description ?? '')); ?></textarea>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\formulations\_form.blade.php ENDPATH**/ ?>