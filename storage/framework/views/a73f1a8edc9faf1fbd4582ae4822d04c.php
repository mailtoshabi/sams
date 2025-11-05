<?php $__env->startSection('title', 'Content Items'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Content Items</h3>
        
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <form method="GET" action="<?php echo e(route('admin.content-items.index')); ?>" class="card shadow-sm mb-4">
        <div class="card-body row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = \App\Models\Category::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="published" <?php echo e(request('status') == 'published' ? 'selected' : ''); ?>>Published</option>
                    <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Draft</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Type</label>
                <select name="type" class="form-select">
                    <option value="">All</option>
                    <option value="medicine" <?php echo e(request('type') == 'medicine' ? 'selected' : ''); ?>>Medicine</option>
                    <option value="disease" <?php echo e(request('type') == 'disease' ? 'selected' : ''); ?>>Disease</option>
                    <option value="proceedure" <?php echo e(request('type') == 'proceedure' ? 'selected' : ''); ?>>Proceedure</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Keyword</label>
                <input type="text" name="search" class="form-control" placeholder="Search keyword..." value="<?php echo e(request('search')); ?>">
            </div>

            <div class="col-md-2 text-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </div>
    </form>

    
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

                                
                                <td><strong><?php echo e($item->category?->name ?? '—'); ?></strong></td>

                                
                                <td>
                                    <?php if($item->division): ?>
                                        <div><i class="bi bi-diagram-3"></i> <?php echo e($item->division->name); ?></div>
                                    <?php endif; ?>
                                    <?php if($item->chapter): ?>
                                        <div><i class="bi bi-book"></i> <?php echo e($item->chapter->name); ?></div>
                                    <?php endif; ?>
                                </td>

                                
                                <td><?php echo e($item->formulation?->name ?? '—'); ?></td>

                                
                                <td>
                                    <?php if($item->medicine): ?>
                                        <span class="badge bg-info text-dark">Medicine</span> <?php echo e($item->medicine->name); ?>

                                    <?php elseif($item->disease): ?>
                                        <span class="badge bg-danger">Disease</span> <?php echo e($item->disease->name); ?>

                                    <?php elseif($item->proceedure): ?>
                                        <span class="badge bg-success">Proceedure</span> <?php echo e($item->proceedure->name); ?>

                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>

                                
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-sm toggle-status-btn
                                            <?php echo e($item->status === 'published' ? 'btn-success' : 'btn-secondary'); ?>"
                                        data-id="<?php echo e($item->id); ?>"
                                        data-status="<?php echo e($item->status); ?>">
                                        <i class="bi <?php echo e($item->status === 'published' ? 'bi-check-circle' : 'bi-circle'); ?>"></i>
                                        <?php echo e(ucfirst($item->status)); ?>

                                    </button>
                                </td>


                                
                                <td><?php echo e($item->updated_at->diffForHumans()); ?></td>

                                
                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.specific.category.edit', [encrypt($item->category_id), encrypt($item->id)])); ?>" class="btn btn-sm btn-warning">
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
                                <td colspan="8" class="text-center text-muted py-4">No content items found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="d-flex justify-content-center mt-3">
                <?php echo e($contentItems->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.toggle-status-btn').on('click', function() {
        const button = $(this);
        const id = button.data('id');

        button.prop('disabled', true);
        button.html('<i class="bi bi-hourglass-split"></i> Updating...');

        $.ajax({
            url: `/super/admin/content-items/${id}/toggle-status`,
            type: 'POST',
            data: { _token: '<?php echo e(csrf_token()); ?>' },
            success: function(res) {
                if (res.success) {
                    const newStatus = res.status;
                    const isPublished = newStatus === 'published';

                    button
                        .data('status', newStatus)
                        .toggleClass('btn-success', isPublished)
                        .toggleClass('btn-secondary', !isPublished)
                        .html(`<i class="bi ${isPublished ? 'bi-check-circle' : 'bi-circle'}"></i> ${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}`);

                    // Optional toast notification
                    toastr.success(res.message);
                } else {
                    toastr.error('Failed to update status.');
                }
            },
            error: function() {
                toastr.error('Error updating status.');
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });
});
</script>

<!-- Optional: Toastr for nice notifications -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/content-items/index.blade.php ENDPATH**/ ?>