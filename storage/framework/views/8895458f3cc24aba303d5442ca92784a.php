<?php $__env->startSection('title', 'Edit Chapter'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="mb-4">Edit Chapter: <?php echo e($chapter->name); ?></h3>

    <form action="<?php echo e(route('admin.chapters.update', $chapter->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.chapters._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="<?php echo e(route('admin.chapters.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\chapters\edit.blade.php ENDPATH**/ ?>