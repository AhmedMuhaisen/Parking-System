<?php $__env->startSection('title_form', 'Edit target_audience'); ?>

<?php $__env->startSection('form'); ?>
    <form action="<?php echo e(route('Dashboard.target_audience.update', $target_audience->id)); ?>" method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.Target_Audience.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Target_Audience/edit.blade.php ENDPATH**/ ?>