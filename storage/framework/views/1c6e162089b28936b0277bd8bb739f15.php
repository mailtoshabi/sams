<?php $__env->startSection('title'); ?> <?php echo e(__('Add Content')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/select2/select2.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/libs/dropzone/dropzone.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.dir_components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Content Management <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Contents <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo e('Add Content'); ?> <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="container mt-4">
    <h3 class="mb-4"><?php echo e($default_category->name); ?></h3>

    <form action="<?php echo e(route('admin.content-items.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.content-items._form', ['default_category'=>$default_category], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="mt-3">
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Save
            </button>
            <a href="<?php echo e(route('admin.content-items.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\create.blade.php ENDPATH**/ ?>