<?php $__env->startSection('title', 'Therapeutic Differences'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Therapeutic Differences</h3>
        <a href="<?php echo e(route('admin.therapeutic_differences.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Therapeutic Difference
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <form method="GET" action="<?php echo e(route('admin.therapeutic_differences.index')); ?>" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by introduction or medicine name"
                   value="<?php echo e(request('search')); ?>">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="<?php echo e(route('admin.therapeutic_differences.index')); ?>" class="btn btn-outline-secondary">
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
                        <th>Medicine 1</th>
                        <th>Medicine 2</th>
                        <th>Introduction</th>
                        <th>Points</th>
                        <th>Created</th>
                        <th width="150" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><span class="badge bg-info"><?php echo e($item->medicine1->name ?? 'N/A'); ?></span></td>
                            <td><span class="badge bg-warning"><?php echo e($item->medicine2->name ?? 'N/A'); ?></span></td>
                            <td><?php echo e(Str::limit($item->introduction, 50)); ?></td>
                            <td><span class="badge bg-success"><?php echo e($item->points->count()); ?></span></td>
                            <td><?php echo e($item->created_at->diffForHumans()); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.therapeutic_differences.edit', $item->id)); ?>" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('admin.therapeutic_differences.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this difference?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="text-center text-muted py-3">No items found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-center"><?php echo e($items->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\therapeutic_differences\index.blade.php ENDPATH**/ ?>