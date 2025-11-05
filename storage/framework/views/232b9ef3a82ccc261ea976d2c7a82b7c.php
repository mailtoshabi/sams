<?php $__env->startSection('title', 'Divisions'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Divisions</h3>
        <a href="<?php echo e(route('admin.divisions.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Division
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <form method="GET" action="<?php echo e(route('admin.divisions.index')); ?>" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                   value="<?php echo e(request('search')); ?>">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="all">All Status</option>
                <option value="published" <?php echo e(request('status') == 'published' ? 'selected' : ''); ?>>Published</option>
                <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Draft</option>
            </select>
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="<?php echo e(route('admin.divisions.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Reset
            </a>
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
                        <th width="150" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($division->name); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($division->status === 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($division->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($division->updated_at->diffForHumans()); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.divisions.show', $division->id)); ?>" class="btn btn-sm btn-info" title="View"><i class="bi bi-eye"></i></a>
                                <a href="<?php echo e(route('admin.divisions.edit', $division->id)); ?>" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('admin.divisions.destroy', $division->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this division?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted py-3">No divisions found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-center"><?php echo e($divisions->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\divisions\index.blade.php ENDPATH**/ ?>