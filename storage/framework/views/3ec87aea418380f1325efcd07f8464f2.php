<?php $__env->startSection('title', 'View Proceedure'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fas fa-leaf"></i> <?php echo e($proceedure->name); ?>

        </h3>
        <div>
            <a href="<?php echo e(route('admin.proceedures.edit', $proceedure->id)); ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="<?php echo e(route('admin.proceedures.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4 align-items-start">
                
                <div class="col-md-3 text-center">
                    <?php if($proceedure->image_path): ?>
                        <img src="<?php echo e(asset('storage/'.$proceedure->image_path)); ?>" class="img-fluid rounded shadow-sm" alt="<?php echo e($proceedure->name); ?>">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/images/placeholder.jpg')); ?>" class="img-fluid rounded shadow-sm" alt="No image">
                    <?php endif; ?>
                </div>

                
                <div class="col-md-9">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="180">Name</th>
                            <td><?php echo e($proceedure->name); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-<?php echo e($proceedure->status === 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($proceedure->status)); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?php echo $proceedure->description; ?></td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td><?php echo e($proceedure->user?->name ?? 'System'); ?></td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td><?php echo e($proceedure->updated_at->format('d M Y, h:i A')); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card shadow-sm">
        <div class="card-header bg-light fw-semibold">
            <i class="bi bi-journal-text"></i> Detailed Sections
        </div>
        <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $proceedure->titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="mb-4 pb-3 border-bottom">
                    <h5 class="fw-bold text-primary"><?php echo e($title->name); ?></h5>

                    <?php if(!empty($title->pivot->heading)): ?>
                        <h6 class="text-muted mb-2"><?php echo e($title->pivot->heading); ?></h6>
                    <?php endif; ?>

                    <?php if($title->pivot->image_path): ?>
                        <div class="mb-3">
                            <img src="<?php echo e(asset('storage/'.$title->pivot->image_path)); ?>" class="img-thumbnail rounded" width="200" alt="<?php echo e($title->name); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($title->pivot->description)): ?>
                        <div><?php echo $title->pivot->description; ?></div>
                    <?php else: ?>
                        <p class="text-muted fst-italic">No description available.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted text-center py-3">No detailed sections added yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\proceedures\show.blade.php ENDPATH**/ ?>