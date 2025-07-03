<?php $__env->startSection('title_form', 'Create notification_rule'); ?>
<!-- General Form Elements -->
<?php $__env->startSection('form'); ?>
    <form action="<?php echo e(route('Dashboard.notification_rule.store')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.Notification_Rule.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Notification_Rule/create.blade.php ENDPATH**/ ?>