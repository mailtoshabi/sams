<?php $__env->startSection('title', 'New Pharmaceutical Forms'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">New Pharmaceutical Forms</h3>
        <a href="<?php echo e(route('admin.new_pharmaceutical_forms.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Pharmaceutical Form
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <form method="GET" action="<?php echo e(route('admin.new_pharmaceutical_forms.index')); ?>" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                   value="<?php echo e(request('search')); ?>">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="<?php echo e(route('admin.new_pharmaceutical_forms.index')); ?>" class="btn btn-outline-secondary">
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
                        <th>Pharmaceutical Form</th>
                        <th>Manufacturing Companies</th>
                        <th>Created</th>
                        <th width="150" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td><span class="badge bg-info"><?php echo e($item->pharmaceuticalForm->name ?? 'N/A'); ?></span></td>
                            <td>
                                <?php $__currentLoopData = $item->manufacturingCompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-secondary"><?php echo e($company->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td><?php echo e($item->created_at->diffForHumans()); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.new_pharmaceutical_forms.edit', $item->id)); ?>" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('admin.new_pharmaceutical_forms.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="text-center text-muted py-3">No items found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-center"><?php echo e($items->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\new_pharmaceutical_forms\index.blade.php ENDPATH**/ ?>