<?php $__env->startSection('title', 'View Division'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-diagram-3"></i> <?php echo e($division->name); ?></h3>
        <div>
            <a href="<?php echo e(route('admin.divisions.edit', $division->id)); ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="<?php echo e(route('admin.divisions.index')); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Status:</strong>
                <span class="badge bg-<?php echo e($division->status == 'published' ? 'success' : 'secondary'); ?>">
                    <?php echo e(ucfirst($division->status)); ?>

                </span>
            </p>
            <p><strong>Description:</strong></p>
            <div><?php echo $division->description; ?></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\divisions\show.blade.php ENDPATH**/ ?>