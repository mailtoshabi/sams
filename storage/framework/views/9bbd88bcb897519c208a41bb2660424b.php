<?php $__env->startSection('title', isset($therapeuticDifference) ? 'Edit Therapeutic Difference' : 'Add Therapeutic Difference'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <?php $editMode = isset($therapeuticDifference); ?>

    <h3 class="mb-4">
        <?php echo e($editMode ? 'Edit Therapeutic Difference' : 'Add Therapeutic Difference'); ?>

    </h3>

    <form action="<?php echo e($editMode ? route('admin.therapeutic_differences.update', $therapeuticDifference->id) : route('admin.therapeutic_differences.store')); ?>" method="POST" id="therapeuticDifferenceForm">
        <?php echo csrf_field(); ?>
        <?php if($editMode): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Medicine 1 <span class="text-danger">*</span></label>
                        <select name="medicine_1_id" class="form-select <?php $__errorArgs = ['medicine_1_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required id="medicine1Select">
                            <option value="">-- Select Medicine 1 --</option>
                            <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($medicine->id); ?>"
                                    <?php echo e(old('medicine_1_id', $therapeuticDifference->medicine_1_id ?? '') == $medicine->id ? 'selected' : ''); ?>>
                                    <?php echo e($medicine->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['medicine_1_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Medicine 2 <span class="text-danger">*</span></label>
                        <select name="medicine_2_id" class="form-select <?php $__errorArgs = ['medicine_2_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required id="medicine2Select">
                            <option value="">-- Select Medicine 2 --</option>
                            <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($medicine->id); ?>"
                                    <?php echo e(old('medicine_2_id', $therapeuticDifference->medicine_2_id ?? '') == $medicine->id ? 'selected' : ''); ?>>
                                    <?php echo e($medicine->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['medicine_2_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-12">
                        <label class="form-label fw-semibold">Introduction</label>
                        <textarea name="introduction" class="form-control <?php $__errorArgs = ['introduction'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"
                                  placeholder="Enter introduction"><?php echo e(old('introduction', $therapeuticDifference->introduction ?? '')); ?></textarea>
                        <?php $__errorArgs = ['introduction'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Difference Points</h5>
                <button type="button" class="btn btn-sm btn-success" id="addPointBtn">
                    <i class="bi bi-plus-circle"></i> Add New Point
                </button>
            </div>
            <div class="card-body">
                <div id="pointsContainer">
                    
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-<?php echo e($editMode ? 'success' : 'primary'); ?>">
                <i class="bi bi-save"></i> <?php echo e($editMode ? 'Update' : 'Save'); ?>

            </button>
            <a href="<?php echo e(route('admin.therapeutic_differences.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
let pointCount = 0;

function addPointRow(medicine1Desc = '', medicine2Desc = '') {
    pointCount++;
    const html = `
        <div class="point-row card mb-3" id="point-${pointCount}">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Point ${pointCount}</span>
                <button type="button" class="btn btn-sm btn-danger" onclick="removePointRow(${pointCount})">
                    <i class="bi bi-trash"></i> Remove
                </button>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span id="med1-label">Medicine 1</span> Description <span class="text-danger">*</span>
                        </label>
                        <textarea name="points[${pointCount - 1}][medicine_1_description]"
                                  class="form-control"
                                  rows="3" required
                                  placeholder="Describe for Medicine 1">${medicine1Desc}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span id="med2-label">Medicine 2</span> Description <span class="text-danger">*</span>
                        </label>
                        <textarea name="points[${pointCount - 1}][medicine_2_description]"
                                  class="form-control"
                                  rows="3" required
                                  placeholder="Describe for Medicine 2">${medicine2Desc}</textarea>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.getElementById('pointsContainer').insertAdjacentHTML('beforeend', html);
    updateMedicineLabels();
}

function removePointRow(id) {
    document.getElementById(`point-${id}`).remove();
}

function updateMedicineLabels() {
    const medicine1Selector = document.getElementById('medicine1Select');
    const medicine2Selector = document.getElementById('medicine2Select');

    const med1Label = medicine1Selector.options[medicine1Selector.selectedIndex]?.text || 'Medicine 1';
    const med2Label = medicine2Selector.options[medicine2Selector.selectedIndex]?.text || 'Medicine 2';

    document.querySelectorAll('#med1-label').forEach(el => el.textContent = med1Label);
    document.querySelectorAll('#med2-label').forEach(el => el.textContent = med2Label);
}

// Initialize medicine change listeners
document.getElementById('medicine1Select').addEventListener('change', updateMedicineLabels);
document.getElementById('medicine2Select').addEventListener('change', updateMedicineLabels);

// Add point button listener
document.getElementById('addPointBtn').addEventListener('click', function () {
    addPointRow();
});

// On page load, load existing points (if editing) or add first point row
document.addEventListener('DOMContentLoaded', function () {
    <?php if($editMode && $therapeuticDifference->points->count() > 0): ?>
        <?php $__currentLoopData = $therapeuticDifference->points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            addPointRow(`<?php echo e($point->medicine_1_description); ?>`, `<?php echo e($point->medicine_2_description); ?>`);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        addPointRow();
    <?php endif; ?>
    updateMedicineLabels();
});
</script>

<style>
.point-row {
    border-left: 4px solid #007bff;
    animation: slideIn 0.3s ease-in-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\therapeutic_differences\create.blade.php ENDPATH**/ ?>