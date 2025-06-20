<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'Dashboard')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{ asset('assets/Dashboard/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/Dashboard/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/Dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Dashboard/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Dashboard/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Dashboard/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Dashboard/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Dashboard/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/Dashboard/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Dashboard/css/all.min.css') }}" rel="stylesheet">

    @yield('style')
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="direction: ltr">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/Dashboard/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="{{ asset('assets/Dashboard/img/messages-1.jpg') }}" alt=""
                                    class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="{{ asset('assets/Dashboard/img/messages-2.jpg') }}" alt=""
                                    class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="{{ asset('assets/Dashboard/img/messages-3.jpg') }}" alt=""
                                    class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/Dashboard/img/profile-img.jpg') }}" alt="Profile"
                            class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{ route('Dashboard.') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Category</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.category.index') }}">
                            <i class="bi bi-circle"></i><span>show all Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.category.create') }}">
                            <i class="bi bi-circle"></i><span>create Category</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.category.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed Categories</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#vehicles-management">
                    <i class="bi bi-truck-front"></i><span>Vehicles Management</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>

                <ul id="vehicles-management" class="nav-content collapse" data-bs-parent="#sidebar-nav">

                    <!-- Vehicle Types -->
                    <li>
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#vehicle-types">
                            <i class="bi bi-tags"></i><span>Vehicle Types</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="vehicle-types" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.vehiclesType.index') }}"><i class="bi bi-circle"></i> Show
                                    All</a></li>
                            <li><a href="{{ route('Dashboard.vehiclesType.create') }}"><i class="bi bi-circle"></i>
                                    Create</a></li>
                            <li><a href="{{ route('Dashboard.vehiclesType.trash') }}"><i class="bi bi-circle"></i>
                                    Trashed</a></li>
                        </ul>
                    </li>

                    <!-- Vehicle Brands -->
                    <li>
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#vehicle-brands">
                            <i class="bi bi-patch-check"></i><span>Vehicle Brands</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="vehicle-brands" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.vehiclesBrand.index') }}"><i class="bi bi-circle"></i> Show
                                    All</a></li>
                            <li><a href="{{ route('Dashboard.vehiclesBrand.create') }}"><i class="bi bi-circle"></i>
                                    Create</a></li>
                            <li><a href="{{ route('Dashboard.vehiclesBrand.trash') }}"><i class="bi bi-circle"></i>
                                    Trashed</a></li>
                        </ul>
                    </li>

                    <!-- Vehicles -->
                    <li>
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#vehicles">
                            <i class="bi bi-car-front-fill"></i><span>Vehicles</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="vehicles" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.vehicle.index') }}"><i class="bi bi-circle"></i> Show
                                    All</a></li>
                            <li><a href="{{ route('Dashboard.vehicle.create') }}"><i class="bi bi-circle"></i>
                                    Create</a></li>
                            <li><a href="{{ route('Dashboard.vehicle.trash') }}"><i class="bi bi-circle"></i>
                                    Trashed</a></li>
                        </ul>
                    </li>

                    <!-- Vehicle Movements -->
                    <li>
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#vehicle-movements">
                            <i class="bi bi-arrow-left-right"></i><span>Vehicle Movements</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="vehicle-movements" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.vehicleMovement.index') }}"><i class="bi bi-circle"></i>
                                    Show All</a></li>
                            <li><a href="{{ route('Dashboard.vehicleMovement.create') }}"><i class="bi bi-circle"></i>
                                    Create</a></li>
                            <li><a href="{{ route('Dashboard.vehicleMovement.trash') }}"><i class="bi bi-circle"></i>
                                    Trashed</a></li>
                        </ul>
                    </li>

                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav10" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>user</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav10" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.user.index') }}">
                            <i class="bi bi-circle"></i><span>show all user</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.user.create') }}">
                            <i class="bi bi-circle"></i><span>create user</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.user.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed users</span>
                        </a>
                    </li>

                </ul>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav13" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>parking</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav13" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.parking.index') }}">
                            <i class="bi bi-circle"></i><span>show all parking</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.parking.create') }}">
                            <i class="bi bi-circle"></i><span>create parking</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.parking.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed parkings</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav17" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav17" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <!-- role -->
                    <li>
                        <a class="nav-link collapsed" data-bs-target="#components-nav171" data-bs-toggle="collapse"
                            href="#">
                            <i class="bi bi-circle"></i><span>Role</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav171" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.role.index') }}"><span>Show All Roles</span></a></li>
                            <li><a href="{{ route('Dashboard.role.create') }}"><span>Create Role</span></a></li>
                            <li><a href="{{ route('Dashboard.role.trash') }}"><span>Trashed Roles</span></a></li>
                        </ul>
                    </li>

                    <!-- permission -->
                    <li>
                        <a class="nav-link collapsed" data-bs-target="#components-nav172" data-bs-toggle="collapse"
                            href="#">
                            <i class="bi bi-circle"></i><span>Permission</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav172" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.permission.index') }}"><span>Show All
                                        Permissions</span></a></li>
                            <li><a href="{{ route('Dashboard.permission.create') }}"><span>Create Permission</span></a>
                            </li>
                            <li><a href="{{ route('Dashboard.permission.trash') }}"><span>Trashed Permissions</span></a>
                            </li>
                        </ul>
                    </li>

                    <!-- user_role -->
                    <li>
                        <a class="nav-link collapsed" data-bs-target="#components-nav173" data-bs-toggle="collapse"
                            href="#">
                            <i class="bi bi-circle"></i><span>User Role</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav173" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.user_role.index') }}"><span>Show All User Roles</span></a>
                            </li>
                            <li><a href="{{ route('Dashboard.user_role.create') }}"><span>Create User Role</span></a>
                            </li>
                            <li><a href="{{ route('Dashboard.user_role.trash') }}"><span>Trashed User Roles</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>


        </ul>

    </aside><!-- End Sidebar-->
    @yield('content')
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/Dashboard/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/Dashboard/js/main.js') }}"></script>
    @yield('script')
</body>

</html>
