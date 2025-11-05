<?php $__env->startSection('title', 'Titles'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Titles</h3>
        <a href="<?php echo e(route('admin.titles.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Title
        </a>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                   value="<?php echo e(request('search')); ?>">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="all">All Status</option>
                <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Draft</option>
                <option value="published" <?php echo e(request('status') == 'published' ? 'selected' : ''); ?>>Published</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-primary"><i class="bi bi-search"></i> Filter</button>
            <a href="<?php echo e(route('admin.titles.index')); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-repeat"></i> Reset</a>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($t->name); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($t->status == 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($t->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($t->updated_at->diffForHumans()); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.titles.edit', $t->id)); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('admin.titles.destroy', $t->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button onclick="return confirm('Delete this title?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted py-3">No titles found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <?php echo e($titles->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/titles/index.blade.php ENDPATH**/ ?>