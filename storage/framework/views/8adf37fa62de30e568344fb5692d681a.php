<!doctype html >
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8" />
    <title> <?php echo $__env->yieldContent('title'); ?> | SAMS - Samhitha of Ayurvedic Medical Specialities</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="SAMS - Samhitha of Ayurvedic Medical Specialities" name="description" />
    <meta content="Web Mahal Web Service" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>


    <!-- Standard favicon -->
    <link rel="icon" href="<?php echo e(asset('favicon/favicon.png')); ?>" type="image/x-icon">

    <!-- For modern browsers -->
    

    <!-- Apple Touch Icon (iPhone/iPad) -->
    

    <!-- Android Chrome Icons -->
    

    <!-- Microsoft Tiles -->
    

    <!-- Theme Color (browser UI) -->
    <meta name="theme-color" content="#ec1d23">
    <?php echo $__env->make('admin.layouts.head-css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<?php $__env->startSection('body'); ?>
    <?php echo $__env->make('admin.layouts.body', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldSection(); ?>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php echo $__env->make('admin.layouts.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('admin.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?php echo $__env->make('admin.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <?php echo $__env->make('admin.layouts.right-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    <?php echo $__env->make('admin.layouts.vendor-scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>" ></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const activeMenu = document.querySelector('.mm-active');
    if (activeMenu && activeMenu.closest('ul.sub-menu')) {
        activeMenu.closest('ul.sub-menu').classList.add('mm-show');
    }
});
</script>
</html>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\admin\layouts\master.blade.php ENDPATH**/ ?>