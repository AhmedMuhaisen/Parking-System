<?php $__env->startSection('title_form', 'Edit Category'); ?>
<?php $__env->startSection('form'); ?>
    <form action="<?php echo e(route('Dashboard.category.update', $category->id)); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.Category.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Category/edit.blade.php ENDPATH**/ ?>