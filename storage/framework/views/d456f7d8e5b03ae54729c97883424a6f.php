<html>

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->

    <!-- Main Style Css -->
    <link href="<?php echo e(asset('assets/website/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/website/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/website/vendor/aos/aos.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/website/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/website/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('assets/website/css/style.css')); ?>">
</head>

<body>
    <div class="page-content" style="height: 100vh">
        <div class="form-v10-content ">
            <form class="form-detail mb-0" action="<?php echo e(route('login')); ?>" method="post" id="myform">
                <?php echo csrf_field(); ?>
                <div class="form-left">
                    <h2>Personal Information</h2>
                    <div class="form-group">

                        <div class="form-row form-row-1">
                            <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a = $attributes; } ?>
<?php $component = App\View\Components\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => '','title' => 'email','type' => 'email','name' => 'email']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $attributes = $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $component = $__componentOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>
                        </div>


                        <div class="form-row form-row-1">
                            <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a = $attributes; } ?>
<?php $component = App\View\Components\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => '','title' => 'password','type' => 'password','name' => 'password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $attributes = $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $component = $__componentOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>

                        </div>
                        <div class="form-row-last">
                            <button type="submit" name="login" class="btn btn-primary login mx-3 px-5"
                                value=" ">Login
                        </div>
                        <div class="form-row form-row-1 d-flex pt-3 my-3 px-0">
                            <div class="form-row form-row-2 ">
                                <a href="<?php echo e(route('reset_password')); ?>" class="text">forget password</a>
                            </div>
                            <div class="form-row form-row-2 ">
                                <a href="<?php echo e(route('log_register_request')); ?>" class="text">i dont have account</a>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-right login-background">




                </div>

            </form>
        </div>
    </div>
<?php if(session('msg') != null): ?>
    <script>
        alert("<?php echo e(session('msg')); ?>");
    </script>
<?php endif; ?>

</body>

</html>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/auth/login.blade.php ENDPATH**/ ?>