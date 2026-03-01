<?php $__env->startSection('title'); ?> <?php echo e(__('Edit Content')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/select2/select2.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/libs/dropzone/dropzone.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.dir_components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Content Management <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Contents <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo e('Edit Content'); ?> <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="container mt-4">
    <h3 class="mb-4"><?php echo e($default_category->name); ?></h3>

    <form action="<?php echo e(route('admin.content-items.update', $contentItem->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php echo $__env->make('admin.content-items._form', [
            'default_category' => $default_category,
            'contentItem' => $contentItem
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="mt-3">
            <button class="btn btn-success">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="<?php echo e(route('admin.content-items.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('assets/libs/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/pages/ecommerce-select2.init.js')); ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Global select2 init for AJAX selects
        document.querySelectorAll('.select2-ajax').forEach(function(el) {
            const url = el.dataset.url;
            const placeholder = el.dataset.placeholder || 'Search...';
            const dependsSelector = el.dataset.depends || null;

            $(el).select2({
                theme: 'classic', // optional (or remove to use default)
                placeholder: placeholder,
                allowClear: true,
                width: '100%',
                minimumInputLength: 1,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        const query = {
                            q: params.term, // search term
                            page: params.page || 1
                        };
                        // pass dependent select value if exists
                        if (dependsSelector) {
                            const dep = document.querySelector(dependsSelector);
                            if (dep && dep.value) query.dependency = dep.value;
                        }
                        return query;
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination && data.pagination.more
                            }
                        };
                    },
                    cache: true
                }
            });

            // If this select depends on another, reload when parent changes
            if (dependsSelector) {
                const parent = document.querySelector(dependsSelector);
                if (parent) {
                    parent.addEventListener('change', function () {
                        // clear current selection
                        $(el).val(null).trigger('change');

                        // optionally preload first page results or leave empty
                    });
                }
            }
        });

    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\content-items\edit.blade.php ENDPATH**/ ?>