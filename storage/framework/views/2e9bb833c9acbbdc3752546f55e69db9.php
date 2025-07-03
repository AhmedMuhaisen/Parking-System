<?php $__env->startSection('title_form', 'Edit Gate'); ?>
<?php $__env->startSection('form'); ?>
    <form action="<?php echo e(route('Dashboard.gate.update', $gate->id)); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.Gate.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Gate/edit.blade.php ENDPATH**/ ?>