<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Title Name</label>
        <input type="text" name="name"
               value="<?php echo e(old('name', $title->name ?? '')); ?>"
               class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type</label>
        <select name="type" class="form-select" required>
            <option value="">Select Type</option>
            <option value="medicine" <?php echo e(old('type', $title->type ?? '') == 'medicine' ? 'selected' : ''); ?>>Medicine</option>
            <option value="disease" <?php echo e(old('type', $title->type ?? '') == 'disease' ? 'selected' : ''); ?>>Disease</option>
            <option value="procedure" <?php echo e(old('type', $title->type ?? '') == 'procedure' ? 'selected' : ''); ?>>Procedure</option>
        </select>
    </div>

    

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5" class="form-control"><?php echo e(old('description', $title->description ?? '')); ?></textarea>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\titles\_form.blade.php ENDPATH**/ ?>