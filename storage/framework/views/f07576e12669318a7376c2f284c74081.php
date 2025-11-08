<?php
    $editMode = isset($medicine);
?>

<div class="row g-3">

    
    <div class="col-md-6">
        <label class="form-label fw-semibold">Medicine Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control"
               value="<?php echo e(old('name', $medicine->name ?? '')); ?>" required
               placeholder="Enter medicine name">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Ayurveda Name</label>
        <input type="text" name="ayurveda_name" class="form-control"
            value="<?php echo e(old('ayurveda_name', $medicine->ayurveda_name ?? '')); ?>"
            placeholder="Enter Ayurveda name">
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="published" <?php echo e(old('status', $medicine->status ?? '') === 'published' ? 'selected' : ''); ?>>Published</option>
            <option value="draft" <?php echo e(old('status', $medicine->status ?? '') === 'draft' ? 'selected' : ''); ?>>Draft</option>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label fw-semibold">Main Image</label>
        <input type="file" name="image" id="mainImageInput" class="form-control">
        <div class="mt-2" id="mainPreviewContainer">
            <?php if(!empty($medicine->image_path)): ?>
                <img id="mainPreviewImage" src="<?php echo e(asset('storage/'.$medicine->image_path)); ?>" width="120" class="rounded border">
            <?php else: ?>
                <img id="mainPreviewImage" src="#" width="120" class="rounded border d-none">
            <?php endif; ?>
        </div>
    </div>

    
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" id="mainEditor" class="form-control" rows="5"><?php echo e(old('description', $medicine->description ?? '')); ?></textarea>
    </div>

</div>

<hr class="my-4">


<h5 class="mb-3">Titles & Detailed Information</h5>
<?php if($titles->count() > 0): ?>
    <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $pivot = $editMode
                ? $medicine->titles->firstWhere('id', $title->id)?->pivot
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
                        <input type="text"
                            name="titles[<?php echo e($title->id); ?>][heading]"
                            class="form-control"
                            value="<?php echo e(old('titles.'.$title->id.'.heading', $pivot->heading ?? '')); ?>"
                            placeholder="Enter heading for <?php echo e($title->name); ?>">
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" name="titles[<?php echo e($title->id); ?>][image]" class="form-control image-input" data-preview="preview_<?php echo e($title->id); ?>">
                        <div class="mt-2">
                            <?php if(!empty($pivot?->image_path)): ?>
                                <img id="preview_<?php echo e($title->id); ?>" src="<?php echo e(asset('storage/'.$pivot->image_path)); ?>" width="120" class="rounded border">
                            <?php else: ?>
                                <img id="preview_<?php echo e($title->id); ?>" src="#" width="120" class="rounded border d-none">
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="titles[<?php echo e($title->id); ?>][description]" id="editor_<?php echo e($title->id); ?>" class="form-control" rows="4"><?php echo e(old('titles.'.$title->id.'.description', $pivot->description ?? '')); ?></textarea>
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
        document.addEventListener('DOMContentLoaded', function() {

            // Initialize CKEditor for main description
            if (document.querySelector('#mainEditor')) {
                ClassicEditor.create(document.querySelector('#mainEditor')).catch(console.error);
            }

            // Initialize CKEditor for title descriptions
            document.querySelectorAll('textarea[id^="editor_"]').forEach(function (el) {
                ClassicEditor.create(el).catch(console.error);
            });

            // Live preview for main image
            const mainInput = document.getElementById('mainImageInput');
            const mainPreview = document.getElementById('mainPreviewImage');
            if (mainInput) {
                mainInput.addEventListener('change', function(e) {
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
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const previewId = e.target.dataset.preview;
                    const previewEl = document.getElementById(previewId);
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
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\medicines\_form.blade.php ENDPATH**/ ?>