<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!-- Sidebar Menu -->
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">

                <!-- Dashboard -->
                <li class="<?php echo e(request()->routeIs('admin.dashboard') ? 'mm-active' : ''); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <?php if($user->hasRole(['Administrator', 'Manager'])): ?>

                    
                    <li class="menu-title text-uppercase mt-3">Content Management</li>

                    <?php
                        $contentActive = request()->routeIs('admin.content-items.*') ||
                                         request()->routeIs('admin.specific.category') ||
                                         request()->routeIs('admin.specific.category.edit');

                        // $activeCategoryId = null;
                        try {
                            if(session('activeCategoryId')) {
                                $activeCategoryId = decrypt(session('activeCategoryId'));
                            }
                        } catch (Exception $e) {}
                    ?>

                    <li class="<?php echo e($contentActive ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e($contentActive ? 'mm-active' : ''); ?>">
                            <i class="fas fa-folder-open"></i>
                            <span>Content Items</span>
                        </a>

                        <ul class="sub-menu <?php echo e($contentActive ? 'mm-show' : ''); ?>" id="category-menu">
                            
                            <li>
                                <a href="<?php echo e(route('admin.content-items.index')); ?>"
                                   class="<?php echo e(request()->routeIs('admin.content-items.index') ? 'active' : ''); ?>">
                                    <i class="fas fa-list"></i> All Content Items
                                </a>
                            </li>

                            
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isActiveCategory = ($activeCategoryId == $category->id)
                                        || (request()->fullUrlIs('*' . encrypt($category->id) . '*'));
                                ?>
                                <li>
                                    <a href="<?php echo e(route('admin.specific.category', encrypt($category->id))); ?>"
                                       data-category-id="<?php echo e($category->id); ?>"
                                       class="<?php echo e($isActiveCategory ? 'active text-primary fw-bold' : ''); ?>">
                                        <i class="<?php echo e($category->fa_icon); ?>"></i> <?php echo e($category->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>

                    
                    <li class="menu-title text-uppercase mt-3">Master Data</li>

                    <li class="<?php echo e(request()->routeIs('admin.divisions.*') ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e(request()->routeIs('admin.divisions.*') ? 'mm-active' : ''); ?>">
                            <i class="fas fa-layer-group"></i> <span>Divisions</span>
                        </a>
                        <ul class="sub-menu <?php echo e(request()->routeIs('admin.divisions.*') ? 'mm-show' : ''); ?>">
                            <li><a href="<?php echo e(route('admin.divisions.index')); ?>" class="<?php echo e(request()->routeIs('admin.divisions.index') ? 'active' : ''); ?>"><i class="fas fa-list"></i> All Divisions</a></li>
                            <li><a href="<?php echo e(route('admin.divisions.create')); ?>" class="<?php echo e(request()->routeIs('admin.divisions.create') ? 'active' : ''); ?>"><i class="fas fa-plus-circle"></i> Add Division</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e(request()->routeIs('admin.chapters.*') ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e(request()->routeIs('admin.chapters.*') ? 'mm-active' : ''); ?>">
                            <i class="fas fa-book"></i> <span>Chapters</span>
                        </a>
                        <ul class="sub-menu <?php echo e(request()->routeIs('admin.chapters.*') ? 'mm-show' : ''); ?>">
                            <li><a href="<?php echo e(route('admin.chapters.index')); ?>" class="<?php echo e(request()->routeIs('admin.chapters.index') ? 'active' : ''); ?>"><i class="fas fa-list"></i> All Chapters</a></li>
                            <li><a href="<?php echo e(route('admin.chapters.create')); ?>" class="<?php echo e(request()->routeIs('admin.chapters.create') ? 'active' : ''); ?>"><i class="fas fa-plus-circle"></i> Add Chapter</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e(request()->routeIs('admin.formulations.*') ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e(request()->routeIs('admin.formulations.*') ? 'mm-active' : ''); ?>">
                            <i class="fas fa-vial"></i> <span>Formulations</span>
                        </a>
                        <ul class="sub-menu <?php echo e(request()->routeIs('admin.formulations.*') ? 'mm-show' : ''); ?>">
                            <li><a href="<?php echo e(route('admin.formulations.index')); ?>" class="<?php echo e(request()->routeIs('admin.formulations.index') ? 'active' : ''); ?>"><i class="fas fa-list"></i> All Formulations</a></li>
                            <li><a href="<?php echo e(route('admin.formulations.create')); ?>" class="<?php echo e(request()->routeIs('admin.formulations.create') ? 'active' : ''); ?>"><i class="fas fa-plus-circle"></i> Add Formulation</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e(request()->routeIs('admin.titles.*') ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e(request()->routeIs('admin.titles.*') ? 'mm-active' : ''); ?>">
                            <i class="fas fa-heading"></i> <span>Titles</span>
                        </a>
                        <ul class="sub-menu <?php echo e(request()->routeIs('admin.titles.*') ? 'mm-show' : ''); ?>">
                            <li><a href="<?php echo e(route('admin.titles.index')); ?>" class="<?php echo e(request()->routeIs('admin.titles.index') ? 'active' : ''); ?>"><i class="fas fa-list"></i> All Titles</a></li>
                            <li><a href="<?php echo e(route('admin.titles.create')); ?>" class="<?php echo e(request()->routeIs('admin.titles.create') ? 'active' : ''); ?>"><i class="fas fa-plus-circle"></i> Add Title</a></li>
                        </ul>
                    </li>

                    
                    <li class="menu-title text-uppercase mt-3">Medical Repository</li>

                    <li class="<?php echo e(request()->routeIs('admin.medicines.*') ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e(request()->routeIs('admin.medicines.*') ? 'mm-active' : ''); ?>">
                            <i class="fas fa-pills"></i> <span>Medicines</span>
                        </a>
                        <ul class="sub-menu <?php echo e(request()->routeIs('admin.medicines.*') ? 'mm-show' : ''); ?>">
                            <li><a href="<?php echo e(route('admin.medicines.index')); ?>" class="<?php echo e(request()->routeIs('admin.medicines.index') ? 'active' : ''); ?>"><i class="fas fa-list"></i> All Medicines</a></li>
                            <li><a href="<?php echo e(route('admin.medicines.create')); ?>" class="<?php echo e(request()->routeIs('admin.medicines.create') ? 'active' : ''); ?>"><i class="fas fa-plus-circle"></i> Add Medicine</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e(request()->routeIs('admin.diseases.*') ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e(request()->routeIs('admin.diseases.*') ? 'mm-active' : ''); ?>">
                            <i class="fas fa-virus"></i> <span>Diseases</span>
                        </a>
                        <ul class="sub-menu <?php echo e(request()->routeIs('admin.diseases.*') ? 'mm-show' : ''); ?>">
                            <li><a href="<?php echo e(route('admin.diseases.index')); ?>" class="<?php echo e(request()->routeIs('admin.diseases.index') ? 'active' : ''); ?>"><i class="fas fa-list"></i> All Diseases</a></li>
                            <li><a href="<?php echo e(route('admin.diseases.create')); ?>" class="<?php echo e(request()->routeIs('admin.diseases.create') ? 'active' : ''); ?>"><i class="fas fa-plus-circle"></i> Add Disease</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e(request()->routeIs('admin.proceedures.*') ? 'mm-active' : ''); ?>">
                        <a href="javascript:void(0);" class="has-arrow <?php echo e(request()->routeIs('admin.proceedures.*') ? 'mm-active' : ''); ?>">
                            <i class="fas fa-leaf"></i> <span>Proceedures</span>
                        </a>
                        <ul class="sub-menu <?php echo e(request()->routeIs('admin.proceedures.*') ? 'mm-show' : ''); ?>">
                            <li><a href="<?php echo e(route('admin.proceedures.index')); ?>" class="<?php echo e(request()->routeIs('admin.proceedures.index') ? 'active' : ''); ?>"><i class="fas fa-list"></i> All Proceedures</a></li>
                            <li><a href="<?php echo e(route('admin.proceedures.create')); ?>" class="<?php echo e(request()->routeIs('admin.proceedures.create') ? 'active' : ''); ?>"><i class="fas fa-plus-circle"></i> Add Proceedure</a></li>
                        </ul>
                    </li>

                    
                    <li class="menu-title text-uppercase mt-3">Appendix</li>
                    <li>
                        <a href="javascript:void(0);" class="has-arrow">
                            <i class="fas fa-clipboard-list"></i> <span>Appendix</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#"><i class="fas fa-vials"></i> COMMERCIAL OUSHADHA KALPANAS</a></li>
                            <li><a href="#"><i class="fas fa-flask"></i> NEW PHARMACEUTICAL FORMS</a></li>
                            <li><a href="#"><i class="fas fa-project-diagram"></i> DOSHA GUNA BASED CLASSIFICATION</a></li>
                            <li><a href="#"><i class="fas fa-notes-medical"></i> THERAPEUTIC DIFFERENCES</a></li>
                            <li><a href="#"><i class="fas fa-apple-alt"></i> MEDICATED FOOD SUBSTANCES</a></li>
                            <li><a href="#"><i class="fas fa-hourglass-half"></i> EXPIRY DATE FOR AYURVEDIC PRODUCTS</a></li>
                            <li><a href="#"><i class="fas fa-skull-crossbones"></i> LIST OF POISONOUS DRUGS</a></li>
                            <li><a href="#"><i class="fas fa-leaf"></i> NON-COMMERCIAL CLASSICAL MEDICINES</a></li>
                            <li><a href="#"><i class="fas fa-seedling"></i> RAW DRUG INDEX</a></li>
                            <li><a href="#"><i class="fas fa-yin-yang"></i> SIDDHA MEDICINES</a></li>
                            <li><a href="#"><i class="fas fa-newspaper"></i> ARTICLES</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<!-- 🔹 JS: Auto-highlight active category from URL -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const currentUrl = window.location.href;
    const categoryLinks = document.querySelectorAll('#category-menu a[data-category-id]');

    categoryLinks.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active', 'text-primary', 'fw-bold');
            const submenu = link.closest('.sub-menu');
            if (submenu) submenu.classList.add('mm-show');
            const parent = submenu?.previousElementSibling;
            if (parent) parent.classList.add('mm-active');
        }
    });
});
</script>
<!-- Left Sidebar End -->
<?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>