<?php $__env->startSection('title', 'Articles'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Articles</h3>
        <a href="<?php echo e(route('admin.articles.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Article
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            
            <form method="GET" action="<?php echo e(route('admin.articles.index')); ?>" class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search by heading or content..."
                           value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <select name="author_id" class="form-select">
                        <option value="">All Authors</option>
                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($author->id); ?>" <?php echo e(request('author_id') == $author->id ? 'selected' : ''); ?>>
                                <?php echo e($author->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>

            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            
            <?php if($articles->count()): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Heading</th>
                                <th>Author</th>
                                <th>Content Preview</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$key); ?></td>
                                    <td class="fw-semibold"><?php echo e($article->heading); ?></td>
                                    <td>
                                        <span class="badge bg-info"><?php echo e($article->author->name); ?></span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo e(\Illuminate\Support\Str::limit(strip_tags($article->article), 50)); ?>

                                        </small>
                                    </td>
                                    <td>
                                        <small><?php echo e($article->created_at->format('d M, Y')); ?></small>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.articles.edit', $article->id)); ?>" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.articles.destroy', $article->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="mt-3">
                    <?php echo e($articles->appends(request()->query())->links('pagination::bootstrap-5')); ?>

                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> No articles found.
                    <a href="<?php echo e(route('admin.articles.create')); ?>">Create your first article</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/articles/index.blade.php ENDPATH**/ ?>