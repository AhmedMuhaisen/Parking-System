<?php $__env->startSection('title_form', 'Create target_audience'); ?>
<!-- General Form Elements -->
<?php $__env->startSection('form'); ?>
    <form action="<?php echo e(route('Dashboard.target_audience.store')); ?>" method="post">
        <?php echo csrf_field(); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.Target_Audience.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Target_Audience/create.blade.php ENDPATH**/ ?>