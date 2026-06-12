<?php
    $editMode = isset($proceedure);
?>

<div class="row g-3">
    
    <div class="col-md-6">
        <label class="form-label fw-semibold">Division</label>
        <select name="division_id" id="division_id" class="form-select select2-ajax"
            data-url="<?php echo e(route('admin.ajax.divisions')); ?>" data-placeholder="Search division...">
            <option value="">Select Division</option>
            <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $selectedDivId = old('division_id', $proceedure->division_id ?? null);
                ?>
                <option value="<?php echo e($division->id); ?>" <?php echo e($selectedDivId == $division->id ? 'selected' : ''); ?>>
                    <?php echo e($division->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="published" <?php echo e(old('status', $proceedure->status ?? '') === 'published' ? 'selected' : ''); ?>>
                Published</option>
            <option value="draft" <?php echo e(old('status', $proceedure->status ?? '') === 'draft' ? 'selected' : ''); ?>>Draft
            </option>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label fw-semibold">Proceedure Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $proceedure->name ?? '')); ?>" required
            placeholder="Enter proceedure name">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Ayurveda Name</label>
        <input type="text" name="ayurveda_name" class="form-control"
            value="<?php echo e(old('ayurveda_name', $proceedure->ayurveda_name ?? '')); ?>" placeholder="Enter Ayurveda name">
    </div>

    
    <div class="col-md-6">
        <label class="form-label fw-semibold">Main Image</label>
        <input type="file" name="image" id="mainImageInput" class="form-control">
        <div class="mt-2" id="mainPreviewContainer">
            <?php if(!empty($proceedure->image_path)): ?>
                <img id="mainPreviewImage" src="<?php echo e(asset('storage/' . $proceedure->image_path)); ?>" width="120"
                    class="rounded border">
            <?php else: ?>
                <img id="mainPreviewImage" src="#" width="120" class="rounded border d-none">
            <?php endif; ?>
        </div>
    </div>

    
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" id="mainEditor" class="form-control"
            rows="5"><?php echo e(old('description', $proceedure->description ?? '')); ?></textarea>
    </div>

</div>

<hr class="my-4">


<h5 class="mb-3">Titles & Detailed Information</h5>
<?php if($titles->count() > 0): ?>
    <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $pivot = $editMode
                ? $proceedure->titles->firstWhere('id', $title->id)?->pivot
                : null;
        ?>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-light fw-bold">
                <?php echo e($title->name); ?>

            </div>
            <div class="card-body">
                <div class="row g-3 align-items-start">

                    
                    <div class="col-md-6">
                        <label class="form-label">Heading</label>
                        <input type="text" name="titles[<?php echo e($title->id); ?>][heading]" class="form-control"
                            value="<?php echo e(old('titles.' . $title->id . '.heading', $pivot->heading ?? '')); ?>"
                            placeholder="Enter heading for <?php echo e($title->name); ?>">
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" name="titles[<?php echo e($title->id); ?>][image]" class="form-control image-input"
                            data-preview="preview_<?php echo e($title->id); ?>">
                        <div class="mt-2">
                            <?php if(!empty($pivot?->image_path)): ?>
                                <img id="preview_<?php echo e($title->id); ?>" src="<?php echo e(asset('storage/' . $pivot->image_path)); ?>" width="120"
                                    class="rounded border">
                            <?php else: ?>
                                <img id="preview_<?php echo e($title->id); ?>" src="#" width="120" class="rounded border d-none">
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="titles[<?php echo e($title->id); ?>][description]" id="editor_<?php echo e($title->id); ?>" class="form-control"
                            rows="4"><?php echo e(old('titles.' . $title->id . '.description', $pivot->description ?? '')); ?></textarea>
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    No Titles Found. <a href="<?php echo e(route('admin.titles.create')); ?>">Add a New Title</a>
<?php endif; ?>
<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // CKEditor for main and title descriptions
            if (document.querySelector('#mainEditor')) {
                ClassicEditor.create(document.querySelector('#mainEditor')).catch(console.error);
            }
            document.querySelectorAll('textarea[id^="editor_"]').forEach(el => {
                ClassicEditor.create(el).catch(console.error);
            });

            // Live preview for main image
            const mainInput = document.getElementById('mainImageInput');
            const mainPreview = document.getElementById('mainPreviewImage');
            if (mainInput) {
                mainInput.addEventListener('change', e => {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = ev => {
                            mainPreview.src = ev.target.result;
                            mainPreview.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Live preview for title images
            document.querySelectorAll('.image-input').forEach(input => {
                input.addEventListener('change', e => {
                    const file = e.target.files[0];
                    const previewEl = document.getElementById(e.target.dataset.preview);
                    if (file && previewEl) {
                        const reader = new FileReader();
                        reader.onload = ev => {
                            previewEl.src = ev.target.result;
                            previewEl.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Select2 AJAX initialization
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
                    setTimeout(() => {
                        const searchField = document.querySelector('.select2-search__field');
                        if (searchField) {
                            searchField.focus();
                        }
                    }, 50);
                });

                $(el).on('focus', function (e) {
                    if (!$(this).data('select2').isOpen()) {
                        $(this).select2('open');
                    }
                });

                if (dependsSelector) {
                    const parent = document.querySelector(dependsSelector);
                    if (parent) {
                        parent.addEventListener('change', function () {
                            $(el).val(null).trigger('change');
                        });
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/proceedures/_form.blade.php ENDPATH**/ ?>