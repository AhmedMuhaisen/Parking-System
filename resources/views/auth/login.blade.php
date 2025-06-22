<html>

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
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
    <div class="page-content" style="height: 100vh">
        <div class="form-v10-content ">
            <form class="form-detail mb-0" action="{{ route('login') }}" method="post" id="myform">
                @csrf
                <div class="form-left">
                    <h2>Personal Information</h2>
                    <div class="form-group">

                        <div class="form-row form-row-1">
                            <x-input value="" title="email" type="email" name="email" />
                        </div>


                        <div class="form-row form-row-1">
                            <x-input value="" title="password" type="password" name="password" />

                        </div>
                        <div class="form-row-last">
                            <button type="submit" name="login" class="btn btn-primary login mx-3 px-5"
                                value=" ">Login
                        </div>
                        <div class="form-row form-row-1 d-flex pt-3 my-3 px-0">
                            <div class="form-row form-row-2 ">
                                <a href="{{ route('reset_password') }}" class="text">forget password</a>
                            </div>
                            <div class="form-row form-row-2 ">
                                <a href="{{ route('log_register_request') }}" class="text">i dont have account</a>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-right login-background">




                </div>

            </form>
        </div>
    </div>
@if (session('msg') != null)
    <script>
        alert("{{ session('msg') }}");
    </script>
@endif

</body>

</html>
