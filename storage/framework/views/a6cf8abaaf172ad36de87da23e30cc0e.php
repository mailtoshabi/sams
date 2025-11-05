<?php $__env->startSection('title', 'Content Items'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Content Items</h3>
        <a href="<?php echo e(route('admin.content-items.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Content Item
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Division / Chapter</th>
                            <th>Formulation</th>
                            <th>Linked Item</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th width="150" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $contentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>

                                
                                <td>
                                    <strong><?php echo e($item->category?->name ?? '—'); ?></strong>
                                </td>

                                
                                <td>
                                    <?php if($item->division): ?>
                                        <div><i class="bi bi-diagram-3"></i> <?php echo e($item->division->name); ?></div>
                                    <?php endif; ?>
                                    <?php if($item->chapter): ?>
                                        <div><i class="bi bi-book"></i> <?php echo e($item->chapter->name); ?></div>
                                    <?php endif; ?>
                                </td>

                                
                                <td>
                                    <?php echo e($item->formulation?->name ?? '—'); ?>

                                </td>

                                
                                <td>
                                    <?php if($item->medicine): ?>
                                        <span class="badge bg-info text-dark">Medicine</span>
                                        <?php echo e($item->medicine->name); ?>

                                    <?php elseif($item->disease): ?>
                                        <span class="badge bg-danger">Disease</span>
                                        <?php echo e($item->disease->name); ?>

                                    <?php elseif($item->proceedure): ?>
                                        <span class="badge bg-success">Proceedure</span>
                                        <?php echo e($item->proceedure->name); ?>

                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>

                                
                                <td>
                                    <span class="badge bg-<?php echo e($item->status === 'published' ? 'success' : 'secondary'); ?>">
                                        <?php echo e(ucfirst($item->status)); ?>

                                    </span>
                                </td>

                                
                                <td><?php echo e($item->updated_at->diffForHumans()); ?></td>

                                
                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.content-items.edit', $item->id)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.content-items.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No content items found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="d-flex justify-content-center mt-3">
                <?php echo e($contentItems->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\index-old.blade.php ENDPATH**/ ?>