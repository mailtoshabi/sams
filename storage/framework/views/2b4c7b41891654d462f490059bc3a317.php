<?php $__env->startSection('title', 'Medicines'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Medicines</h3>
        <a href="<?php echo e(route('admin.medicines.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Medicine
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Titles</th>
                    <th>Updated</th>
                    <th class="text-center" width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                            <strong><?php echo e($medicine->name); ?></strong><br>
                            <small class="text-muted"><?php echo e($medicine->slug); ?></small>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($medicine->status === 'published' ? 'success' : 'secondary'); ?>">
                                <?php echo e(ucfirst($medicine->status)); ?>

                            </span>
                        </td>
                        <td>
                            <?php $__currentLoopData = $medicine->titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-info text-dark"><?php echo e($title->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td><?php echo e($medicine->updated_at->diffForHumans()); ?></td>
                        <td class="text-center">
                            <a href="<?php echo e(route('admin.medicines.show', $medicine->id)); ?>" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?php echo e(route('admin.medicines.edit', $medicine->id)); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admin.medicines.destroy', $medicine->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this medicine?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted">No medicines found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo e($medicines->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/medicines/index.blade.php ENDPATH**/ ?>