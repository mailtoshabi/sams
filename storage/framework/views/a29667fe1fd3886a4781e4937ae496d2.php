<?php $__env->startSection('title'); ?> <?php echo e(__('Link Division & Disease')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/select2/select2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/libs/dropzone/dropzone.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('admin.dir_components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Modern Diseases <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Link <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo e('Link Division & Disease'); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="container mt-4">
        <h3 class="mb-4">Link Division & Disease</h3>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.modern_diseases.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="row g-3">
                <div id="dynamic-fields" class="col-12">
                    <div class="row g-3">

                        <!-- Division -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Division</label>
                            <select name="division_id" class="form-select select2-ajax"
                                data-url="<?php echo e(route('admin.ajax.divisions')); ?>" data-placeholder="Search division...">
                                <option value="">Select Division</option>
                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($division->id); ?>" <?php echo e(old('division_id') == $division->id ? 'selected' : ''); ?>>
                                        <?php echo e($division->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Disease -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Disease</label>
                            <select name="disease_id" class="form-select select2-ajax"
                                data-url="<?php echo e(route('admin.ajax.diseases')); ?>" data-placeholder="Search disease...">
                                <option value="">Select Disease</option>
                                <?php $__currentLoopData = $diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($disease->id); ?>" <?php echo e(old('disease_id') == $disease->id ? 'selected' : ''); ?>>
                                        <?php echo e($disease->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Medicines Section -->
                        <div class="col-12 mt-4">
                            <div class="card border-light shadow-sm">
                                <div class="card-header bg-light py-3 border-bottom-0">
                                    <h5 class="card-title mb-0 text-primary fw-semibold">
                                        <i class="bi bi-capsule me-2"></i>Link Medicines
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-9">
                                            <label class="form-label fw-semibold">Search Medicine</label>
                                            <select id="medicine-search-select" class="form-select select2-ajax"
                                                data-url="<?php echo e(route('admin.ajax.medicines')); ?>" data-placeholder="Type medicine name to search...">
                                                <option value="">Select Medicine</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" id="btn-add-medicine" class="btn btn-primary w-100">
                                                <i class="bi bi-plus-circle me-1"></i> Add to List
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label class="form-label fw-semibold mb-2">Selected Medicines List</label>
                                        <div id="medicines-container" class="row g-3">
                                            <?php if(count($oldMedicines) > 0): ?>
                                                <?php $__currentLoopData = $oldMedicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-md-6 medicine-item-card" data-id="<?php echo e($med->id); ?>">
                                                        <div class="card h-100 border-start border-primary border-3 shadow-sm mb-0">
                                                            <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-light rounded p-2 text-primary me-3">
                                                                        <i class="bi bi-capsule fs-5"></i>
                                                                    </div>
                                                                    <div>
                                                                        <span class="fw-semibold text-dark"><?php echo e($med->name); ?></span>
                                                                        <input type="hidden" name="medicines[]" value="<?php echo e($med->id); ?>">
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-sm btn-outline-danger remove-medicine-btn border-0">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div id="no-medicines-alert" class="col-12">
                                                    <div class="alert alert-info py-2 mb-0">
                                                        <i class="bi bi-info-circle me-2"></i>No medicines selected yet. Search and add medicines using the search box above.
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Procedures Section -->
                        <div class="col-12 mt-4">
                            <div class="card border-light shadow-sm">
                                <div class="card-header bg-light py-3 border-bottom-0">
                                    <h5 class="card-title mb-0 text-primary fw-semibold">
                                        <i class="bi bi-activity me-2"></i>Link Procedures
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-5">
                                            <label class="form-label fw-semibold">Search Procedure</label>
                                            <select id="procedure-search-select" class="form-select select2-ajax"
                                                data-url="<?php echo e(route('admin.ajax.proceedures')); ?>" data-placeholder="Type procedure name to search..."
                                                data-depends="[name=division_id]">
                                                <option value="">Select Procedure</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label fw-semibold">Procedure Description / Instructions</label>
                                            <input type="text" id="procedure-description-input" class="form-control" placeholder="Enter custom description or instruction...">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" id="btn-add-procedure" class="btn btn-primary w-100">
                                                <i class="bi bi-plus-circle me-1"></i> Add to List
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label class="form-label fw-semibold mb-2">Selected Procedures List</label>
                                        <div id="procedures-container" class="row g-3">
                                            <?php if(count($oldProceedures ?? []) > 0): ?>
                                                <?php $__currentLoopData = $oldProceedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-md-12 procedure-item-card" data-id="<?php echo e($proc->id); ?>">
                                                        <div class="card h-100 border-start border-success border-3 shadow-sm mb-0">
                                                            <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center flex-grow-1">
                                                                    <div class="bg-light rounded p-2 text-success me-3">
                                                                        <i class="bi bi-activity fs-5"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1 me-3">
                                                                        <span class="fw-semibold text-dark d-block"><?php echo e($proc->name); ?></span>
                                                                        <small class="text-muted d-block"><?php echo e($proc->old_description ?? 'No description'); ?></small>
                                                                        <input type="hidden" name="proceedures[<?php echo e($proc->id); ?>][description]" value="<?php echo e($proc->old_description); ?>">
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-sm btn-outline-danger remove-procedure-btn border-0">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div id="no-procedures-alert" class="col-12">
                                                    <div class="alert alert-info py-2 mb-0">
                                                        <i class="bi bi-info-circle me-2"></i>No procedures selected yet. Search, type a description, and add procedures using the fields above.
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Save
                </button>
                <a href="<?php echo e(route('admin.modern_diseases.index')); ?>" class="btn btn-secondary">Cancel</a>
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

            // Medicines dynamic adding logic
            const medicineSearchSelect = $('#medicine-search-select');
            const btnAddMedicine = document.getElementById('btn-add-medicine');
            const medicinesContainer = document.getElementById('medicines-container');

            btnAddMedicine.addEventListener('click', function () {
                const selectedData = medicineSearchSelect.select2('data');
                if (!selectedData || selectedData.length === 0 || !selectedData[0].id) {
                    alert('Please search and select a medicine first.');
                    return;
                }

                const medicineId = selectedData[0].id;
                const medicineName = selectedData[0].text;

                // Check if already added
                const existing = medicinesContainer.querySelector(`.medicine-item-card[data-id="${medicineId}"]`);
                if (existing) {
                    alert('This medicine is already added to the list.');
                    medicineSearchSelect.val(null).trigger('change');
                    return;
                }

                // Remove empty state alert if it exists
                const alertEl = document.getElementById('no-medicines-alert');
                if (alertEl) {
                    alertEl.remove();
                }

                // Append new medicine item card
                const itemHtml = `
                    <div class="col-md-6 medicine-item-card" data-id="${medicineId}">
                        <div class="card h-100 border-start border-primary border-3 shadow-sm mb-0">
                            <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded p-2 text-primary me-3">
                                        <i class="bi bi-capsule fs-5"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold text-dark">${medicineName}</span>
                                        <input type="hidden" name="medicines[]" value="${medicineId}">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-medicine-btn border-0">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                medicinesContainer.insertAdjacentHTML('beforeend', itemHtml);

                // Clear selection
                medicineSearchSelect.val(null).trigger('change');
            });

            // Event delegation for removal
            medicinesContainer.addEventListener('click', function (e) {
                const removeBtn = e.target.closest('.remove-medicine-btn');
                if (removeBtn) {
                    const card = removeBtn.closest('.medicine-item-card');
                    if (card) {
                        card.remove();

                        // If no items left, show empty alert
                        const remainingItems = medicinesContainer.querySelectorAll('.medicine-item-card');
                        if (remainingItems.length === 0) {
                            medicinesContainer.innerHTML = `
                                <div id="no-medicines-alert" class="col-12">
                                    <div class="alert alert-info py-2 mb-0">
                                        <i class="bi bi-info-circle me-2"></i>No medicines selected yet. Search and add medicines using the search box above.
                                    </div>
                                </div>
                            `;
                        }
                    }
                }
            });

            // Procedures dynamic adding logic
            const procedureSearchSelect = $('#procedure-search-select');
            const procedureDescriptionInput = document.getElementById('procedure-description-input');
            const btnAddProcedure = document.getElementById('btn-add-procedure');
            const proceduresContainer = document.getElementById('procedures-container');

            btnAddProcedure.addEventListener('click', function () {
                const selectedData = procedureSearchSelect.select2('data');
                if (!selectedData || selectedData.length === 0 || !selectedData[0].id) {
                    alert('Please search and select a procedure first.');
                    return;
                }

                const procedureId = selectedData[0].id;
                const procedureName = selectedData[0].text;
                const description = procedureDescriptionInput.value.trim();

                // Check if already added
                const existing = proceduresContainer.querySelector(`.procedure-item-card[data-id="${procedureId}"]`);
                if (existing) {
                    alert('This procedure is already added to the list.');
                    procedureSearchSelect.val(null).trigger('change');
                    procedureDescriptionInput.value = '';
                    return;
                }

                // Remove empty state alert if it exists
                const alertEl = document.getElementById('no-procedures-alert');
                if (alertEl) {
                    alertEl.remove();
                }

                // Append new procedure item card (with description)
                const itemHtml = `
                    <div class="col-md-12 procedure-item-card" data-id="${procedureId}">
                        <div class="card h-100 border-start border-success border-3 shadow-sm mb-0">
                            <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="bg-light rounded p-2 text-success me-3">
                                        <i class="bi bi-activity fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1 me-3">
                                        <span class="fw-semibold text-dark d-block">${procedureName}</span>
                                        <small class="text-muted d-block">${description || 'No description'}</small>
                                        <input type="hidden" name="proceedures[${procedureId}][description]" value="${description}">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-procedure-btn border-0">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                proceduresContainer.insertAdjacentHTML('beforeend', itemHtml);

                // Clear selection and inputs
                procedureSearchSelect.val(null).trigger('change');
                procedureDescriptionInput.value = '';
            });

            // Event delegation for removal
            proceduresContainer.addEventListener('click', function (e) {
                const removeBtn = e.target.closest('.remove-procedure-btn');
                if (removeBtn) {
                    const card = removeBtn.closest('.procedure-item-card');
                    if (card) {
                        card.remove();

                        // If no items left, show empty alert
                        const remainingItems = proceduresContainer.querySelectorAll('.procedure-item-card');
                        if (remainingItems.length === 0) {
                            proceduresContainer.innerHTML = `
                                <div id="no-procedures-alert" class="col-12">
                                    <div class="alert alert-info py-2 mb-0">
                                        <i class="bi bi-info-circle me-2"></i>No procedures selected yet. Search, type a description, and add procedures using the fields above.
                                    </div>
                                </div>
                            `;
                        }
                    }
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\modern_diseases\create.blade.php ENDPATH**/ ?>