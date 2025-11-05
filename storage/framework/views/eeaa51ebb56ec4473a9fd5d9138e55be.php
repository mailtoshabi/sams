<?php $__env->startSection('title', 'Edit Title'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="mb-4">Edit Title</h3>
    <form action="<?php echo e(route('admin.titles.update', $title->id)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.titles._form', ['title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="mt-3">
            <button class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="<?php echo e(route('admin.titles.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\titles\edit.blade.php ENDPATH**/ ?>