<?php $__env->startSection('title'); ?> <?php echo e(__('Link Classical Disease Fields')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/select2/select2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/libs/dropzone/dropzone.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('admin.dir_components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Classical Diseases <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Link <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo e('Link Classical Disease Fields'); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="container mt-4">
        <h3 class="mb-4">Link Classical Disease Fields</h3>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.classical_diseases.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="row g-3">
                <div id="dynamic-fields" class="col-12">
                    <div class="row g-3">

                        <!-- Division -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Division</label>
                            <select name="division_id" id="division_id" class="form-select select2-ajax"
                                data-url="<?php echo e(route('admin.ajax.divisions')); ?>" data-placeholder="Search division...">
                                <option value="">Select Division</option>
                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($division->id); ?>" <?php echo e(old('division_id') == $division->id ? 'selected' : ''); ?>>
                                        <?php echo e($division->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Chapter -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Chapter</label>
                            <select name="chapter_id" id="chapter_id" class="form-select select2-ajax"
                                data-url="<?php echo e(route('admin.ajax.chapters')); ?>" data-depends="#division_id"
                                data-placeholder="Search chapter...">
                                <option value="">Select Chapter</option>
                                <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($chapter->id); ?>" <?php echo e(old('chapter_id') == $chapter->id ? 'selected' : ''); ?>>
                                        <?php echo e($chapter->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Medicine Type -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Medicine Type</label>
                            <select name="medicine_type_id" id="medicine_type_id" class="form-select select2-ajax"
                                data-url="<?php echo e(route('admin.ajax.medicine_types')); ?>" data-depends="#division_id"
                                data-placeholder="Search Medicine Type...">
                                <option value="">Select Medicine Type</option>
                                <?php $__currentLoopData = $medicine_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($mt->id); ?>" <?php echo e(old('medicine_type_id') == $mt->id ? 'selected' : ''); ?>>
                                        <?php echo e($mt->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Formulation -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Formulation</label>
                            <select name="formulation_id" id="formulation_id" class="form-select select2-ajax"
                                data-url="<?php echo e(route('admin.ajax.formulations')); ?>" data-placeholder="Search formulation...">
                                <option value="">Select Formulation</option>
                                <?php $__currentLoopData = $formulations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formulation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($formulation->id); ?>" <?php echo e(old('formulation_id') == $formulation->id ? 'selected' : ''); ?>>
                                        <?php echo e($formulation->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Medicine -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Medicine</label>
                            <select name="medicine_id" id="medicine_id" class="form-select select2-ajax"
                                data-url="<?php echo e(route('admin.ajax.medicines', ['require_formulation' => 1])); ?>" data-depends="#formulation_id"
                                data-placeholder="Search medicine...">
                                <option value="">Select Medicine</option>
                                <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($medicine->id); ?>" <?php echo e(old('medicine_id') == $medicine->id ? 'selected' : ''); ?>>
                                        <?php echo e($medicine->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Link
                </button>
                <a href="<?php echo e(route('admin.classical_diseases.index')); ?>" class="btn btn-secondary">Cancel</a>
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
            document.querySelectorAll('.select2-ajax').forEach(function (el) {
                const url = el.dataset.url;
                const placeholder = el.dataset.placeholder || 'Search...';
                const dependsSelector = el.dataset.depends || null;

                $(el).select2({
                    theme: 'classic',
                    placeholder: placeholder,
                    allowClear: true,
                    width: '100%',
                    minimumInputLength: 1,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 300,
                        data: function (params) {
                            const query = {
                                q: params.term,
                                page: params.page || 1
                            };
                            if (dependsSelector) {
                                const dep = document.querySelector(dependsSelector);
                                if (dep && dep.value) query.dependency = dep.value;
                            }
                            return query;
                        },
                        processResults: function (data, params) {
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
                }).on('select2:open', function (e) {
                    // Focus the search field when opened
                    setTimeout(() => {
                        const searchField = document.querySelector('.select2-search__field');
                        if (searchField) {
                            searchField.focus();
                        }
                    }, 50);
                });

                // Automatically open Select2 on focus
                $(el).on('focus', function (e) {
                    if (!$(this).data('select2').isOpen()) {
                        $(this).select2('open');
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

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\classical_diseases\create.blade.php ENDPATH**/ ?>