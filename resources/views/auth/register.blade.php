<html>

<head>
    <meta charset="utf-8">
    <title>Register Page</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->

    <!-- Main Style Css -->
    <link href="{{ asset('assets/website/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/website/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
</head>

<body>
    <div class="page-content">
        <div class="form-v10-content">
            <form class="form-detail" enctype="multipart/form-data" action="{{ route('register') }}" method="post"
                id="myform">
                @csrf
                <div class="form-left">
                    <h2>Personal Information</h2>
                    <div class="form-group d-flex ">
                        <div class="form-row form-row-2">
                            <x-input value="" title="First Name" type="text" name="first_name" />
                        </div>
                        <div class="form-row form-row-2">
                            <x-input value="" title="last Name" type="text" name="last_name" />
                        </div>


                        <div class="form-row form-row-2">
                            <x-input value="" title="email" type="email" name="email" />
                        </div>
                        <div class="form-row form-row-2">
                            <x-input value="" title="phone" type="phone" name="phone" />
                        </div>


                        <div class="form-row form-row-2">
                            <x-select name='building' title="building" value="" :array="$building"></x-select>
                        </div>

                        <div class="form-row form-row-2">
                            <x-select name='unit' title="unit" value="" :array="$unit"></x-select>

                        </div>
                        <div class="form-label">
                            <div class="form-row form-row-4"><label for="" class="">date of barth</label>
                            </div>
                            <div class="form-row form-row-3">
                                <x-input value="" title="date of barth" type="date" name="date_barth" />
                            </div>
                        </div>
                        <div class="form-label">
                            <div class="form-row form-row-4"><label for="" class="">personal image</label>
                            </div>
                            <div class="form-row form-row-3">
                                <x-input value="" folder='' title="image" type="file" name="image" />
                            </div>
                        </div>
                        <div class="form-row form-row-1">
                            <x-input value="" title="password" type="password" name="password" />

                        </div>


                    </div>
                </div>
                <div class="form-right">
                    <h2>vehicle Details</h2>

                    <div class="form-group d-flex ">
                        <div class="form-row form-row-2">
                            <x-input value="" title="vehicle number" type="password" name="vehicle_number" />
                        </div>


                        <div class="form-row form-row-2">
                            <x-select name='vehicle_type' title="vehicle type" value=""
                                :array="$vehicle_type"></x-select>
                        </div>

                        <div class="form-row form-row-1">
                            <x-select name='motor_type' title="motor type" value="" :array="$motor_type"></x-select>

                        </div>
                        <div class="form-row form-row-1">
                            <x-select name='car_type' title="car type" value="" :array="$cars_type"></x-select>

                        </div>
                        <div class="form-label">
                            <div class="form-row form-row-4"><label for="" class=""
                                    style="color: white">vehicle color</label></div>
                            <div class="form-row form-row-3">
                                <input type="color" name="vehicle_color" id="vehicle_color" class="input-text"
                                    style=" width: 80px; border-radius: 30px;  height: 60px; ">
                            </div>
                        </div>


                    </div>

                    <div class="form-row-last">
                        <input type="submit" name="register" class="register" value="Register ">
                    </div>
                    <div class="form-checkbox my-5">

                        <a href="{{ route('login') }}" class="text"
                            style="display:block;  width: 100%; text-align:center; ">i have
                            account</a>


                    </div>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
