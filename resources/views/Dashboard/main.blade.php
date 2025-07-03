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
     @vite(['resources/css/app.css','resources/js/app.js'])
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
@php
    $notification=App\Models\SystemNotification::where('user_id',Auth::id())->where('is_read',0)->get();
    $user=Auth::user();
    $settings=App\Models\Setting::first();
@endphp
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('website.') }}" class="logo d-flex align-items-center">
               @if($settings->website_logo)
               <div class="d-flex align-items-center justify-center">
<img src="{{ asset($settings->website_logo) }}" alt="">
<h5 class="mb-0" style="font-weight: bold; color:#012970;">{{ $settings->website_name }}</h5>
</div>
               @endif
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
                        <span class="badge bg-primary badge-number" id="notification_count">{{ $notification->count() }}</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" id="dropdown_notification">
                        <li class="dropdown-header">
                            You have {{ $notification->count() }} new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
<div id="notification_content" style="font-size: 13px !important; color: rgb(173 145 145);">
                        @foreach ($notification as $item)
                             <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                               <p>{{ $item->message }}</p>
                               </div>
                        </li>
                           <li>
                            <hr class="dropdown-divider">
                        </li>
                        @endforeach
</div>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="{{ route('Dashboard.notification_system.index') }}">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset($user->image) }}" alt="Profile"
                            class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ $user->first_name . ' '.$user->second_name}}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ $user->first_name . ' '.$user->second_name}}</h6>
                            <span>{{ $user->type}}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('website.profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>






                        <li>
                             <form action="{{ route('logout') }}" method="post">
                    @csrf
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>

                    <button type="submit" class="btn-getstarted border-0">logout</button>

                            </a>
                              </form>
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


                          <li>
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#login_attempts">
                            <i class="bi bi-arrow-left-right"></i><span>Login Attempts</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="login_attempts" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.login_attempt.index') }}"><i class="bi bi-circle"></i>
                                    Show All</a></li>
                            <li><a href="{{ route('Dashboard.login_attempt.create') }}"><i class="bi bi-circle"></i>
                                    Create</a></li>
                            <li><a href="{{ route('Dashboard.login_attempt.trash') }}"><i class="bi bi-circle"></i>
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
                    <i class="bi bi-menu-button-wide"></i><span>parking</span><i class="bi bi-chevron-down ms-auto"></i>
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
                <a class="nav-link collapsed" data-bs-target="#components-nav14" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>building</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav14" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.building.index') }}">
                            <i class="bi bi-circle"></i><span>show all building</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.building.create') }}">
                            <i class="bi bi-circle"></i><span>create building</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.building.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed buildings</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav15" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>unit</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav15" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.unit.index') }}">
                            <i class="bi bi-circle"></i><span>show all unit</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.unit.create') }}">
                            <i class="bi bi-circle"></i><span>create unit</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.unit.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed units</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav16" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>gate</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav16" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.gate.index') }}">
                            <i class="bi bi-circle"></i><span>show all gate</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.gate.create') }}">
                            <i class="bi bi-circle"></i><span>create gate</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.gate.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed G</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav18" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>spot</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav18" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.spot.index') }}">
                            <i class="bi bi-circle"></i><span>show all Spots</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.spot.create') }}">
                            <i class="bi bi-circle"></i><span>create Spot</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.spot.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed Spots</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav19" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>guest</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav19" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.guest.index') }}">
                            <i class="bi bi-circle"></i><span>show all guests</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.guest.create') }}">
                            <i class="bi bi-circle"></i><span>create guest</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.guest.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed guests</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->
     <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav21" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>message</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav21" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.message.index') }}">
                            <i class="bi bi-circle"></i><span>show all messages</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.message.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed messages</span>
                        </a>
                    </li>

                </ul>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav20" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>camera</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav20" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.camera.index') }}">
                            <i class="bi bi-circle"></i><span>show all cameras</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.camera.create') }}">
                            <i class="bi bi-circle"></i><span>create camera</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.camera.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed cameras</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->


                <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav21" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>testimonial</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav21" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.testimonial.index') }}">
                            <i class="bi bi-circle"></i><span>show all testimonials</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.testimonial.create') }}">
                            <i class="bi bi-circle"></i><span>create testimonial</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.testimonial.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed testimonials</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->


          <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav23" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>notification_rule</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav23" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.notification_rule.index') }}">
                            <i class="bi bi-circle"></i><span>show all notification_rules</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.notification_rule.create') }}">
                            <i class="bi bi-circle"></i><span>create notification_rule</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.notification_rule.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed notification_rules</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->


                  <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav24" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>notification_system</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav24" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.notification_system.index') }}">
                            <i class="bi bi-circle"></i><span>show all</span>
                        </a>
                    </li>


                </ul>
            </li><!-- End Components Nav -->



            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav17" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>register_request</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav17" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('Dashboard.register_request.index') }}">
                            <i class="bi bi-circle"></i><span>show all register_request</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Dashboard.register_request.create') }}">
                            <i class="bi bi-circle"></i><span>create register_request</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Dashboard.register_request.trash') }}">
                            <i class="bi bi-circle"></i><span>trashed register_requests</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->





            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav170" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav170" class="nav-content collapse" data-bs-parent="#sidebar-nav">

                      <li><a href="{{ route('Dashboard.setting') }}"> <i class="bi bi-circle"></i><span>setting</span></a></li>

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

                    <li>
                        <a class="nav-link collapsed" data-bs-target="#components-nav174" data-bs-toggle="collapse"
                            href="#">
                            <i class="bi bi-circle"></i><span>color</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav174" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.color.index') }}"><span>Show All colors</span></a></li>
                            <li><a href="{{ route('Dashboard.color.create') }}"><span>Create color</span></a></li>
                            <li><a href="{{ route('Dashboard.color.trash') }}"><span>Trashed colors</span></a></li>
                        </ul>

                    </li>

  <li>
                        <a class="nav-link collapsed" data-bs-target="#components-nav177" data-bs-toggle="collapse"
                            href="#">
                            <i class="bi bi-circle"></i><span>target_audience</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav177" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.target_audience.index') }}"><span>Show All target_audiences</span></a></li>
                            <li><a href="{{ route('Dashboard.target_audience.create') }}"><span>Create target_audience</span></a></li>
                            <li><a href="{{ route('Dashboard.target_audience.trash') }}"><span>Trashed target_audiences</span></a></li>
                        </ul>
                    </li>




            <li>
                        <a class="nav-link collapsed" data-bs-target="#components-nav176" data-bs-toggle="collapse"
                            href="#">
                            <i class="bi bi-circle"></i><span>parking_work</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav176" class="nav-content collapse">
                            <li><a href="{{ route('Dashboard.parking_work.index') }}"><span>Show All parking_works</span></a></li>
                            <li><a href="{{ route('Dashboard.parking_work.create') }}"><span>Create parking_work</span></a></li>
                            <li><a href="{{ route('Dashboard.parking_work.trash') }}"><span>Trashed parking_works</span></a></li>
                        </ul>

                    </li>
                </ul>

            </li>


        </ul>

    </aside><!-- End Sidebar-->
    @yield('content')
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">ِAhmed Muhaisen</a>
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
       <script>
    window.USER_ID = {{ Auth()->id() }};

    document.addEventListener('DOMContentLoaded', function () {
        window.Echo.channel('user.' + USER_ID)
            .listen('NewSystemNotification', (e) => {
                const notifDropdown = document.getElementById("notification_content");
                const notifCount = document.getElementById("notification_count");

                // تحديث العداد وتلوينه
                notifCount.innerText = parseInt(notifCount.innerText) + 1;
                notifCount.style.setProperty("background-color", "red", "important");

                // إنشاء العنصر الجديد
                const li = document.createElement("li");
                li.classList.add("notification-item");

                const icon = document.createElement("i");
                icon.classList.add("bi", "bi-info-circle", "text-primary");

                const div = document.createElement("div");
                const pMessage = document.createElement("p");
                pMessage.textContent = e.message;

                div.appendChild(pMessage);
                li.appendChild(icon);
                li.appendChild(div);

                // الفاصل
                const dividerLi = document.createElement("li");
                const hr = document.createElement("hr");
                hr.classList.add("dropdown-divider");
                dividerLi.appendChild(hr);

                // الإدراج في الأعلى
                notifDropdown.insertBefore(dividerLi, notifDropdown.firstChild);
                notifDropdown.insertBefore(li, dividerLi);
            });
    });
</script>
</body>

</html>
