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
            <form class="form-detail mb-0" action="{{ route('create_new_password_post', $id) }}" method="post"
                id="myform">
                @csrf
                <div class="form-left">
                    <h2>Create New Password</h2>
                    <div class="form-group">

                        <div class="form-row form-row-1">
                            <x-input value="" title="password" type="password" name="password" />
                        </div>

                        <div class="form-row form-row-1">
                            <x-input value="" title="confirm_password" type="password"
                                name="password_confirmation" />
                        </div>
                        <div class="form-row-last">
                            <button type="submit" name="resit_password" class="btn btn-primary login mx-3 px-5"
                                value=" ">save
                        </div>


                    </div>

                </div>



            </form>
        </div>
    </div>


</body>

</html>
