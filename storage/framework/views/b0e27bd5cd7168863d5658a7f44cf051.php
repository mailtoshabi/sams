<?php $__env->startSection('title', 'Classical Disease Links'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Classical Disease Links</h3>
        <a href="<?php echo e(route('admin.classical_diseases.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Link Classical Disease Fields
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form method="GET" action="<?php echo e(route('admin.classical_diseases.index')); ?>" class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Search by Division, Chapter, Type, Formulation or Medicine name"
                   value="<?php echo e(request('search')); ?>">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="<?php echo e(route('admin.classical_diseases.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Reset
            </a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th width="50">#</th>
                    <th>Division</th>
                    <th>Chapter</th>
                    <th>Medicine Type</th>
                    <th>Formulation</th>
                    <th>Medicine</th>
                    <th class="text-center" width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $classicalDiseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                            <strong><?php echo e($link->division?->name ?? 'N/A'); ?></strong><br>
                            <small class="text-muted"><?php echo e($link->division?->slug); ?></small>
                        </td>
                        <td>
                            <strong><?php echo e($link->chapter?->name ?? 'N/A'); ?></strong><br>
                            <small class="text-muted"><?php echo e($link->chapter?->slug); ?></small>
                        </td>
                        <td>
                            <strong><?php echo e($link->medicineType?->name ?? 'N/A'); ?></strong><br>
                            <small class="text-muted"><?php echo e($link->medicineType?->slug); ?></small>
                        </td>
                        <td>
                            <strong><?php echo e($link->formulation?->name ?? 'N/A'); ?></strong><br>
                            <small class="text-muted"><?php echo e($link->formulation?->slug); ?></small>
                        </td>
                        <td>
                            <strong><?php echo e($link->medicine?->name ?? 'N/A'); ?></strong><br>
                            <small class="text-muted"><?php echo e($link->medicine?->slug); ?></small>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo e(route('admin.classical_diseases.edit', $link->id)); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admin.classical_diseases.destroy', $link->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this link?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-muted">No links found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo e($classicalDiseases->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\sams\resources\views\admin\classical_diseases\index.blade.php ENDPATH**/ ?>