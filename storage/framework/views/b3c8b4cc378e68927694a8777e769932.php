<?php $__env->startSection('title', 'Modern Disease Link Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <?php $__env->startComponent('admin.dir_components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Modern Diseases <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Link Details <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> Modern Disease Link Details <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Link Details</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Division Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($modernDisease->division?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($modernDisease->division?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><?php echo e($modernDisease->division?->slug ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-<?php echo e(($modernDisease->division?->status ?? 'draft') === 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($modernDisease->division?->status ?? 'draft')); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Disease Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($modernDisease->disease?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($modernDisease->disease?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><?php echo e($modernDisease->disease?->slug ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-<?php echo e(($modernDisease->disease?->status ?? 'draft') === 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($modernDisease->disease?->status ?? 'draft')); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-light shadow-sm">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0 text-primary">
                                <i class="bi bi-capsule me-2"></i>Linked Medicines
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php if($modernDisease->medicines->count() > 0): ?>
                                <div class="row g-2">
                                    <?php $__currentLoopData = $modernDisease->medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4">
                                            <div class="bg-light p-2 rounded border-start border-primary border-3 d-flex align-items-center">
                                                <i class="bi bi-capsule text-primary me-2"></i>
                                                <span class="fw-semibold text-dark"><?php echo e($med->name); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0">No medicines linked to this disease yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-light shadow-sm">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0 text-primary">
                                <i class="bi bi-activity me-2"></i>Linked Procedures
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php if($modernDisease->proceedures->count() > 0): ?>
                                <div class="row g-3">
                                    <?php $__currentLoopData = $modernDisease->proceedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="bg-light p-3 rounded border-start border-success border-3 h-100 d-flex flex-column justify-content-center">
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="bi bi-activity text-success me-2 fs-5"></i>
                                                    <span class="fw-semibold text-dark"><?php echo e($proc->name); ?></span>
                                                </div>
                                                <?php if($proc->pivot->description): ?>
                                                    <p class="text-muted small mb-0 ms-4"><?php echo e($proc->pivot->description); ?></p>
                                                <?php else: ?>
                                                    <p class="text-muted small mb-0 ms-4 text-opacity-50"><i>No custom description provided.</i></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0">No procedures linked to this disease yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="<?php echo e(route('admin.modern_diseases.edit', $modernDisease->id)); ?>" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Link
                </a>
                <a href="<?php echo e(route('admin.modern_diseases.index')); ?>" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\modern_diseases\show.blade.php ENDPATH**/ ?>