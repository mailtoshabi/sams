<?php $__env->startSection('title', 'Modern Disease Links'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Modern Disease Links</h3>
        <a href="<?php echo e(route('admin.modern_diseases.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Link Division & Disease
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form method="GET" action="<?php echo e(route('admin.modern_diseases.index')); ?>" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by Division or Disease name"
                   value="<?php echo e(request('search')); ?>">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="<?php echo e(route('admin.modern_diseases.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Reset
            </a>
        </div>
    </form>

     <div class="table-responsive">
          <table class="table table-bordered align-middle">
              <thead class="table-light">
                  <tr>
                      <th width="80">#</th>
                      <th>Division Name</th>
                      <th>Disease Name</th>
                      <th>Linked Medicines</th>
                      <th>Linked Procedures</th>
                      <th>Linked Date</th>
                      <th class="text-center" width="180">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $modernDiseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td>
                              <strong><?php echo e($link->division?->name ?? 'No Division'); ?></strong><br>
                              <small class="text-muted"><?php echo e($link->division?->slug); ?></small>
                          </td>
                          <td>
                              <strong><?php echo e($link->disease?->name ?? 'No Disease'); ?></strong><br>
                              <small class="text-muted"><?php echo e($link->disease?->slug); ?></small>
                          </td>
                          <td>
                              <?php if($link->medicines->count() > 0): ?>
                                  <?php $__currentLoopData = $link->medicines->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <span class="badge bg-info me-1 mb-1"><?php echo e($med->name); ?></span>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($link->medicines->count() > 5): ?>
                                      <span class="badge bg-secondary me-1 mb-1">+<?php echo e($link->medicines->count() - 5); ?> more</span>
                                  <?php endif; ?>
                              <?php else: ?>
                                  <span class="text-muted small">None linked</span>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php if($link->proceedures->count() > 0): ?>
                                  <?php $__currentLoopData = $link->proceedures->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <span class="badge bg-success me-1 mb-1" title="<?php echo e($proc->pivot->description ?? 'No description'); ?>"><?php echo e($proc->name); ?></span>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($link->proceedures->count() > 5): ?>
                                      <span class="badge bg-secondary me-1 mb-1">+<?php echo e($link->proceedures->count() - 5); ?> more</span>
                                  <?php endif; ?>
                              <?php else: ?>
                                  <span class="text-muted small">None linked</span>
                              <?php endif; ?>
                          </td>
                          <td><?php echo e($link->created_at ? $link->created_at->diffForHumans() : 'N/A'); ?></td>
                          <td class="text-center">
                              <a href="<?php echo e(route('admin.modern_diseases.show', $link->id)); ?>" class="btn btn-sm btn-info" title="View Details">
                                  <i class="bi bi-eye"></i>
                              </a>
                              <a href="<?php echo e(route('admin.modern_diseases.edit', $link->id)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                  <i class="bi bi-pencil"></i>
                              </a>
                              <form action="<?php echo e(route('admin.modern_diseases.destroy', $link->id)); ?>" method="POST" class="d-inline">
                                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this link?')" title="Delete">
                                      <i class="bi bi-trash"></i>
                                  </button>
                              </form>
                          </td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <tr><td colspan="7" class="text-center text-muted">No links found</td></tr>
                  <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo e($modernDiseases->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sams\resources\views/admin/modern_diseases/index.blade.php ENDPATH**/ ?>