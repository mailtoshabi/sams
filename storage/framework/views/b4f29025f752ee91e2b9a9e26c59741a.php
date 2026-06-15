<?php $__env->startSection('title', 'Classical Disease Link Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <?php $__env->startComponent('admin.dir_components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Classical Diseases <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Link Details <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> Classical Disease Link Details <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Link Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6>Division</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($classicalDisease->division?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($classicalDisease->division?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>Chapter</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($classicalDisease->chapter?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($classicalDisease->chapter?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>Medicine Type</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($classicalDisease->medicineType?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($classicalDisease->medicineType?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>Formulation</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><?php echo e($classicalDisease->formulation?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($classicalDisease->formulation?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-12 mb-3">
                    <h6>Medicine</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="15%">Name</th>
                            <td><?php echo e($classicalDisease->medicine?->name ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td><?php echo e($classicalDisease->medicine?->ayurveda_name ?? 'N/A'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="<?php echo e(route('admin.classical_diseases.edit', $classicalDisease->id)); ?>" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Link
                </a>
                <a href="<?php echo e(route('admin.classical_diseases.index')); ?>" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\sams\resources\views\admin\classical_diseases\show.blade.php ENDPATH**/ ?>