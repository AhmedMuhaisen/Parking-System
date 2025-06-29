@extends('website.main')
@section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section" style="background-image:url({{ asset($settings->header_background) }}) ">
        <div class="container">
            <div class="row mt-5">
                <div class="w-50 col-lg-7 content-col" data-aos="fade-up">
                    <div class="content">

                        <div class="main-heading">
                            <h1>{{ $settings->header_title }}</h1>
                        </div>

                        <div class="divider"></div>

                        <div class="description">
                            <p>{{ $settings->header_subtitle }}</p>
                        </div>

                        <div class="cta-button">
                            <a href="#services" class="btn">
                                <span>Register In Parking</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-50 col-lg-5" data-aos="zoom-out">
                    <div class="visual-content">
                        <div class="fluid-shape">
                            <img src="{{ asset($settings->header_image ) }}" alt="Abstract Fluid Shape"
                                class="fluid-img">
                        </div>

                        <div class="stats-card">
                            <div class="stats-number">
                                <h2>500</h2>
                            </div>
                            <div class="stats-label">
                                <p>User In Parking</p>
                            </div>
                            <div class="stats-arrow">
                                <a href="#portfolio"><i class="bi bi-arrow-up-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About</h2>
            <div><span>Learn More</span> <span class="description-title">About Us</span></div>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gx-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="about-image position-relative">
                        <div class="image" style="background-image: url({{ asset( $settings->about_image ) }})">

                        </div>
                        <div class="experience-badge">
                            <span class="years">3+</span>
                            <span class="text">Years of Expertise</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="300">
                    <div class="about-content">
                        <h2>{{ $settings->about_title }}</h2>
                        <p class="lead">
                            {!! $settings->about_content !!}
                        </p>


                        <a href="#" class="btn btn-primary mt-4">Get Started</a>
                    </div>
                </div>
            </div>



        </div>

    </section><!-- /about Section -->

    <!-- Call To Action Section -->
    <section id="Advantages" class="call-to-action section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="advertise-1 d-flex flex-column flex-lg-row gap-4 align-items-center position-relative">

                <div class="content-left flex-grow-1" data-aos="fade-right" data-aos-delay="200">
                    <span class="badge text-uppercase mb-2">Don't Miss!</span>
                    <h2>{{ $settings->advantage_title }}</h2>
                    <p class="my-4">{!! $settings->advantage_text !!}</p>

                    <div class="features d-flex flex-wrap gap-3 mb-4">
                        @foreach (json_decode($settings->advantages) as $advantage)
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>{{ $advantage }}</span>
                        </div>
                        @endforeach



                    </div>

                    <div class="cta-buttons d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-primary">Register In Parking</a>
                        <a href="#" class="btn btn-outline">Learn More</a>
                    </div>
                </div>

                <div class="content-right position-relative" data-aos="fade-left" data-aos-delay="300">
                    <img src="{{ asset($settings->advantage_image) }}" alt="Digital Platform"
                        class="img-fluid rounded-4">
                    <div class="floating-card">
                        <div class="card-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="card-content">
                            <span class="stats-number">245%</span>
                            <span class="stats-text">Growth Rate</span>
                        </div>
                    </div>
                </div>

                <div class="decoration">
                    <div class="circle-1"></div>
                    <div class="circle-2"></div>
                </div>

            </div>

        </div>

    </section><!-- /Call To Action Section -->

    <!-- Steps Section -->
    <section id="How_Work" class="steps section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Steps</h2>
            <div><span>How we</span> <span class="description-title">Work</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="steps-wrapper">
@foreach ($parking_work as $work)
         <div class="step-item" data-aos="fade-right" data-aos-delay="200">
                    <div class="step-content">
                        <div class="step-icon">
                            <i class="bi bi-{{$work->icon}}"></i>
                        </div>
                        <div class="step-info">
                            <span class="step-number">Step{{ $work->step }}</span>
                            <h3>{{ $work->title }}</h3>
                            <p>{!! $work->content !!}</p>
                        </div>
                    </div>
                </div><!-- End Step Item -->

@endforeach


            </div>

        </div>

    </section><!-- /Steps Section -->



    <!-- Testimonials Section -->
    <section id="Testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <div><span>Check Our</span> <span class="description-title">Testimonials</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="testimonials-slider swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
              "slidesPerView": 1,
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
                </script>

                <div class="swiper-wrapper">

@foreach ($testimonials as $testimonial)
      <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="rating mb-3">
                                      @for($i = 0; $i < $testimonial->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                      @endfor


                                    </div>
                                    <div class="pargrafe-content">
                                        <p>
                                           {{$testimonial->text}}

                                        </p>

                                    </div>
                                    <div class="profile d-flex align-items-center">
                                        <img src="{{ asset($testimonial->user->image)}}"
                                            class="profile-img" alt="">
                                        <div class="profile-info">
                                            <h3>{{ $testimonial->user->first_name }}  {{ $testimonial->user->second_name }}</h3>
                                            <span>{{ $testimonial->user->type }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 d-none d-lg-block">
                                    <div class="featured-img-wrapper">
                                        <img src="{{ asset($testimonial->user->image)}}"
                                            class="featured-img" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Testimonial Item -->

@endforeach


                </div>

                <div class="swiper-navigation w-100 d-flex align-items-center justify-content-center">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

            </div>

        </div>

    </section><!-- /Testimonials Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <div><span>Let's</span> <span class="description-title">Connect</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <!-- Contact Info Boxes -->
            <div class="row gy-4 mb-5">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info-box">
                        <div class="icon-box">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="info-content">
                            <h4>Our Address</h4>
                            <p>{{ $settings->Address }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info-box">
                        <div class="icon-box">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Email Address</h4>
                            <p>{{ $settings->Website_Email }}</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info-box">
                        <div class="icon-box">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div class="info-content">
                            <h4>Phone Number</h4>
                            <p>{{ $settings->Website_phone }}</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Contact Form Section (Overlapping) -->
        <div class="container form-container-overlap">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
                <div class="col-lg-12">
                    <div class="contact-form-wrapper">
                        <h2 class="text-center mb-4">Get in Touch</h2>

                        <form action="{{ route('website.contact') }}" method="post" class="php-email-form">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <i class="bi bi-person"></i>
                                            <input type="text" class="form-control" name="name" placeholder="First Name"
                                                required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <i class="bi bi-envelope"></i>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email Address" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <i class="bi bi-text-left"></i>
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                                required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <i class="bi bi-chat-dots message-icon"></i>
                                            <textarea class="form-control" name="message" placeholder="Write Message..."
                                                style="height: 180px" required=""></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-submit">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Contact Section -->

</main>
@endsection
