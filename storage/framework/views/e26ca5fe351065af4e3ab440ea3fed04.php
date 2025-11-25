<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
    <meta name="title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">

    <!-- Author -->
    <meta name="author" content="Samhitha of Ayurvedic Medical Specialities">

    <link href="<?php echo e(asset('front/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('front/css/global.css')); ?>" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <?php if(app()->getLocale() === 'ml'): ?>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Malayalam&display=swap" rel="stylesheet">
    <?php else: ?>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <?php endif; ?>

    <!-- Standard favicon -->
    <link rel="icon" href="<?php echo e(asset('favicon/favicon.png')); ?>" type="image/x-icon">

      <!-- Theme Color (browser UI) -->
    <meta name="theme-color" content="#ec1d23">
    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body class="d-flex flex-column min-vh-100 locale-<?php echo e(app()->getLocale()); ?>">
    <div id="loading-overlay" style="display: none;">
        <div class="loading-spinner"></div>
    </div>
<?php /**PATH C:\xampp\htdocs\sams\resources\views\layouts\header.blade.php ENDPATH**/ ?>