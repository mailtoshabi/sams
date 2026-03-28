<?php $__env->startSection('title', isset($commercialOushadhaKalpana) ? 'Edit Commercial Oushadha Kalpana' : 'Add Commercial Oushadha Kalpana'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <?php $editMode = isset($commercialOushadhaKalpana); ?>

    <h3 class="mb-4">
        <?php echo e($editMode ? 'Edit Commercial Oushadha Kalpana: ' . $commercialOushadhaKalpana->name : 'Add Commercial Oushadha Kalpana'); ?>

    </h3>

    <form action="<?php echo e($editMode ? route('admin.commercial_oushadha_kalpanas.update', $commercialOushadhaKalpana->id) : route('admin.commercial_oushadha_kalpanas.store')); ?>" method="POST">
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

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Formulation <span class="text-danger">*</span></label>
                        <select name="formulation_id" class="form-select <?php $__errorArgs = ['formulation_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Select Formulation --</option>
                            <?php $__currentLoopData = $formulations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formulation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($formulation->id); ?>"
                                    <?php echo e(old('formulation_id', $commercialOushadhaKalpana->formulation_id ?? '') == $formulation->id ? 'selected' : ''); ?>>
                                    <?php echo e($formulation->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['formulation_id'];
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
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                               value="<?php echo e(old('name', $commercialOushadhaKalpana->name ?? '')); ?>"
                               placeholder="Enter commercial oushadha kalpana name">
                        <?php $__errorArgs = ['name'];
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
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="5"
                                  placeholder="Enter description"><?php echo e(old('description', $commercialOushadhaKalpana->description ?? '')); ?></textarea>
                        <?php $__errorArgs = ['description'];
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

        <div class="mt-3">
            <button type="submit" class="btn btn-<?php echo e($editMode ? 'success' : 'primary'); ?>">
                <i class="bi bi-save"></i> <?php echo e($editMode ? 'Update' : 'Save'); ?>

            </button>
            <a href="<?php echo e(route('admin.commercial_oushadha_kalpanas.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\commercial_oushadha_kalpanas\create.blade.php ENDPATH**/ ?>