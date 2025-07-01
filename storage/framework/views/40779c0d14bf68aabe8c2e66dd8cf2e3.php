<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Strategy Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicons -->
    <link href="<?php echo e(asset('assets/website/img/favicon.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('assets/website/img/apple-touch-icon.png')); ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo e(asset('assets/website/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/website/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/website/vendor/aos/aos.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/website/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/website/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?php echo e(asset('assets/website/css/main.css')); ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Strategy
  * Template URL: https://bootstrapmade.com/strategy-bootstrap-agency-template/
  * Updated: May 09 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
    <?php
        $Settings = App\Models\Setting::first();

    ?>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="<?php echo e(url('website')); ?>" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="<?php echo e(asset('assets/website/img/logo.webp')); ?>" alt=""> -->
                <h1 class="sitename"><?php echo e($settings->website_logo); ?></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="<?php echo e(url('website')); ?>" class="active">Home</a></li>
                    <li><a href="<?php echo e(url('website/#about')); ?>">About</a></li>
                    <li><a href="<?php echo e(url('website/#Advantages')); ?>">Advantages</a></li>
                    <li><a href="<?php echo e(url('website/#How_Work')); ?>">How Work</a></li>
                    <li><a href="<?php echo e(url('website/#Testimonials')); ?>">Testimonials</a></li>
                    <li><a href="<?php echo e(url('website/#contact')); ?>">Contact</a></li>
                    <?php if(Auth::user()): ?>
                        <li><a href="<?php echo e(route('website.profile')); ?>">profile</a></li>
                    <?php endif; ?>

                             <?php if(Auth::user()): ?>   <?php if(Auth::user()->type =='admin'): ?>
                        <li><a href="<?php echo e(route('Dashboard.')); ?>">Dashboard</a></li>
                    <?php endif; ?>  <?php endif; ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <?php if(Auth::user()): ?>
                <form action="<?php echo e(route('logout')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-getstarted border-0">logout</button>
                </form>
            <?php else: ?>
                <a class="btn-getstarted" href="<?php echo e(route('login')); ?>">login</a>
            <?php endif; ?>



        </div>
    </header>
    <?php echo $__env->yieldContent('content'); ?>


    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename"><?php echo e($settings->website_Name); ?></span>
                    </a>
                    <p><?php echo e($settings->About_title); ?></p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Why should you register on our platform?</h4>
                    <ul>
                        <?php $__currentLoopData = json_decode($settings->advantages, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advantage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($advantage); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>

                    <p><?php echo e($settings->Address); ?></p>

                    <p class="mt-4"><strong>Phone:</strong> <span><?php echo e($settings->Website_phone); ?></span></p>
                    <p><strong>Email:</strong> <span><?php echo e($settings->Website_Email); ?></span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename"><?php echo e($settings->website_Name); ?></strong> <span>All
                    Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">Ahmed Muhaisen</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?php echo e(asset('assets/website/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website/vendor/php-email-form/validate.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website/vendor/aos/aos.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website/vendor/glightbox/js/glightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website/vendor/imagesloaded/imagesloaded.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>

    <!-- Main JS File -->
    <script src="<?php echo e(asset('assets/website/js/main.js')); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/website/main.blade.php ENDPATH**/ ?>