<?php $__env->startSection('title', 'Add Title'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="mb-4">Add Title</h3>
    <form action="<?php echo e(route('admin.titles.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.titles._form', ['title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="mt-3">
            <button class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
            <a href="<?php echo e(route('admin.titles.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\titles\create.blade.php ENDPATH**/ ?>