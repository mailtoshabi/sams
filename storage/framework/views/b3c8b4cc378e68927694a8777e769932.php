<?php $__env->startSection('title', 'Modern Disease Link Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <?php $__env->startComponent('admin.dir_components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Modern Diseases <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Link Details <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> Modern Disease Link Details <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Link Details</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Division Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($modernDisease->division?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($modernDisease->division?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><?php echo e($modernDisease->division?->slug ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-<?php echo e(($modernDisease->division?->status ?? 'draft') === 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($modernDisease->division?->status ?? 'draft')); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Disease Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($modernDisease->disease?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($modernDisease->disease?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><?php echo e($modernDisease->disease?->slug ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-<?php echo e(($modernDisease->disease?->status ?? 'draft') === 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($modernDisease->disease?->status ?? 'draft')); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="<?php echo e(route('admin.modern_diseases.edit', $modernDisease->id)); ?>" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Link
                </a>
                <a href="<?php echo e(route('admin.modern_diseases.index')); ?>" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\modern_diseases\show.blade.php ENDPATH**/ ?>