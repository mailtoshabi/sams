<div class="row g-3">

    <!-- Division -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Division</label>
        <select name="division_id" id="division_id" class="form-select select2-ajax"
                data-url="<?php echo e(route('admin.ajax.divisions')); ?>" data-placeholder="Search division...">
            <option value="">Select Division</option>

            
            <?php if(!empty($selected->division_id)): ?>
                <?php $div = \App\Models\Division::find($selected->division_id); ?>
                <?php if($div): ?>
                    <option value="<?php echo e($div->id); ?>" selected><?php echo e($div->name); ?></option>
                <?php endif; ?>
            <?php endif; ?>
        </select>
    </div>

    <!-- Chapter -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Chapter</label>
        <select name="chapter_id" id="chapter_id" class="form-select select2-ajax"
                data-url="<?php echo e(route('admin.ajax.chapters')); ?>"
                data-depends="#division_id"
                data-placeholder="Search chapter...">
            <option value="">Select Chapter</option>

            <?php if(!empty($selected->chapter_id)): ?>
                <?php $chap = \App\Models\Chapter::find($selected->chapter_id); ?>
                <?php if($chap): ?>
                    <option value="<?php echo e($chap->id); ?>" selected><?php echo e($chap->name); ?></option>
                <?php endif; ?>
            <?php endif; ?>
        </select>
    </div>

    <!-- Formulation -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Formulation</label>
        <select name="formulation_id" id="formulation_id" class="form-select select2-ajax"
                data-url="<?php echo e(route('admin.ajax.formulations')); ?>" data-placeholder="Search formulation...">
            <option value="">Select Formulation</option>

            <?php if(!empty($selected->formulation_id)): ?>
                <?php $f = \App\Models\Formulation::find($selected->formulation_id); ?>
                <?php if($f): ?>
                    <option value="<?php echo e($f->id); ?>" selected><?php echo e($f->name); ?></option>
                <?php endif; ?>
            <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/content-items/partials/_classical_fields.blade.php ENDPATH**/ ?>