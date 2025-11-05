<?php $__env->startSection('title', 'Add Proceedure'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="mb-4">Add New Proceedure</h3>

    <form action="<?php echo e(route('admin.proceedures.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.proceedures._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="<?php echo e(route('admin.proceedures.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/proceedures/create.blade.php ENDPATH**/ ?>