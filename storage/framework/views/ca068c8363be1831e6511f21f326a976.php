<?php $__env->startSection('title', isset($newPharmaceuticalForm) ? 'Edit New Pharmaceutical Form' : 'Add New Pharmaceutical Form'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <?php $editMode = isset($newPharmaceuticalForm); ?>

    <h3 class="mb-4">
        <?php echo e($editMode ? 'Edit New Pharmaceutical Form: ' . $newPharmaceuticalForm->name : 'Add New Pharmaceutical Form'); ?>

    </h3>

    <form action="<?php echo e($editMode ? route('admin.new_pharmaceutical_forms.update', $newPharmaceuticalForm->id) : route('admin.new_pharmaceutical_forms.store')); ?>" method="POST">
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
                        <label class="form-label fw-semibold">Pharmaceutical Form <span class="text-danger">*</span></label>
                        <select name="pharmaceutical_form_id" class="form-select <?php $__errorArgs = ['pharmaceutical_form_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Select Pharmaceutical Form --</option>
                            <?php $__currentLoopData = $pharmaceuticalForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($form->id); ?>"
                                    <?php echo e(old('pharmaceutical_form_id', $newPharmaceuticalForm->pharmaceutical_form_id ?? '') == $form->id ? 'selected' : ''); ?>>
                                    <?php echo e($form->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['pharmaceutical_form_id'];
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
                               value="<?php echo e(old('name', $newPharmaceuticalForm->name ?? '')); ?>"
                               placeholder="Enter new pharmaceutical form name">
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
                        <label class="form-label fw-semibold">Manufacturing Companies <span class="text-danger">*</span></label>
                        <div class="<?php $__errorArgs = ['manufacturing_company_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border border-danger rounded p-2 <?php endif; ?>">
                            <?php $__currentLoopData = $manufacturingCompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="manufacturing_company_ids[]"
                                           value="<?php echo e($company->id); ?>" id="company_<?php echo e($company->id); ?>"
                                           <?php echo e(in_array($company->id, old('manufacturing_company_ids', $selectedCompanies ?? [])) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="company_<?php echo e($company->id); ?>">
                                        <?php echo e($company->name); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $__errorArgs = ['manufacturing_company_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
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
            <a href="<?php echo e(route('admin.new_pharmaceutical_forms.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\new_pharmaceutical_forms\create.blade.php ENDPATH**/ ?>