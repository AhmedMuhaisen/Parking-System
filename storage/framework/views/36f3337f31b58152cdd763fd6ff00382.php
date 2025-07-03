<?php $__env->startSection('title_form', 'Create Testimonial'); ?>
<!-- General Form Elements -->
<?php $__env->startSection('form'); ?>
    <form action="<?php echo e(route('Dashboard.testimonial.store')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.Testimonial.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Testimonial/create.blade.php ENDPATH**/ ?>