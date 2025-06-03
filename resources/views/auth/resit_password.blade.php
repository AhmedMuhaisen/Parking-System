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
        <div class="form-v10-content w-50 p-3 pt-0">
            <form class="form-detail mb-0" action="{{ route('reset_password_post') }}" method="post" id="myform">
                @csrf
                <div class="form-left">
                    <h2>Reset Your Password</h2>
                    <div class="form-group">

                        <div class="form-row form-row-1">
                            <x-input value="" title="email" type="email" name="email" />
                        </div>


                        <div class="form-row-last">
                            <button type="submit" name="resit_password" class="btn btn-primary login mx-3 px-5"
                                value=" ">resit password
                        </div>


                    </div>
                    <div class="form-row form-row-1 px-5">
                        <p class="text mt-4 text-decoration-none"> We will send reset page in your email</p>
                    </div>
                </div>





            </form>
        </div>
    </div>


</body>

</html>
