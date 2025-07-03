<?php $__env->startSection('content'); ?>
<main class="main">


    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-5 my-5">

                <div class="col-lg-8 order-lg-1 order-2">
                    <div class="service-main-content">


                        <div class="service-tabs" data-aos="fade-up" data-aos-delay="200">
                            <ul class="nav nav-tabs" id="serviceTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#service-details-tab-2" type="button" role="tab"
                                        aria-controls="Vehicles" aria-selected="false">
                                        <i class="bi bi-car-front"></i> Vehicle
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#service-details-tab-3" type="button" role="tab"
                                        aria-controls="benefits" aria-selected="false">
                                        <i class="bi bi-graph-up-arrow"></i> Guests
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#service-details-tab-4" type="button" role="tab"
                                        aria-controls="benefits" aria-selected="false">
                                        <i class="bi bi-graph-up-arrow"></i> Testimonials
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane fade active show" id="service-details-tab-2" role="tabpanel"
                                    aria-labelledby="process-tab">
                                    <div class="process-timeline">

                                        <?php $__currentLoopData = Auth::user()->vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="timeline-item mb-5">
                                            <div class="timeline-marker" style="background-image: url(<?php echo e(asset($vehicle->image)); ?>) "></div>

                                            <div class="timeline-content my-5">
                                                <div class="d-flex justify-content-between align-items-center mb-5">
                                                    <div style="margin-left: 30px; margin-top: 10px;">
                                                        <h4>Vehicle <?php echo e($loop->iteration); ?> details</h4>
                                                    </div>

                                                    <div class="d-flex"> <button href="#" class="py-3 px-3 btn btn-primary"
                                                            onclick="openModal('vehicle', <?php echo e($vehicle->id); ?>)"><i
                                                                class="bi bi-pencil"></i></button>
                                                        <form action="<?php echo e(route('website.delete_vehicle',$vehicle->id)); ?>"
                                                            method="post" class="mx-3 my-0">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <button class="py-3 px-3 btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i
                                                                    class="bi bi-trash"></i></button>

                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="row g-4">
                                                    <div class="col-md-4">
                                                        <div class="benefit-card">
                                                            <div class="benefit-icon">
                                                                <i class="bi bi-card-text"></i>
                                                            </div>
                                                            <h4>Vehicle Number</h4>
                                                            <p><?php echo e($vehicle->vehicle_number); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="benefit-card">
                                                            <div class="benefit-icon">
                                                                <i class="bi bi-bus-front"></i>
                                                            </div>
                                                            <h4>Vehicle Type</h4>
                                                            <p><?php echo e($vehicle->vehicle_type->name); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="benefit-card">
                                                            <div class="benefit-icon">
                                                                <i class="bi bi-list"></i>
                                                            </div>
                                                            <h4>Motor</h4>
                                                            <p><?php echo e($vehicle->motor_type->name); ?></p>
                                                        </div>
                                                    </div>
                                                    <?php if($vehicle->vehicle_type->name == 'Car'): ?>
                                                    <div class="col-md-4">
                                                        <div class="benefit-card">
                                                            <div class="benefit-icon">
                                                                <i class="bi bi-car-front"></i>
                                                            </div>
                                                            <h4>car type</h4>
                                                            <p><?php echo e($vehicle->VehiclesBrand->name); ?></p>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <div class="col-md-4">
                                                        <div class="benefit-card">
                                                            <div class="benefit-icon">
                                                                <i class="bi bi-bootstrap"></i>
                                                            </div>
                                                            <h4>Color</h4>
                                                            <p><?php echo e($vehicle->color->name); ?></p>
                                                        </div>
                                                    </div>
     <div class="col-md-4">
                                                        <div class="benefit-card">
                                                            <div class="benefit-icon">
                                                                <i class="bi bi-clock"></i>
                                                            </div>
                                                            <h4>Date Of Start</h4>
                                                            <p><?php echo e($vehicle->date_start); ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="benefit-card">
                                                            <div class="benefit-icon">
                                                                <i class="bi bi-clock"></i>
                                                            </div>
                                                            <h4>Date Of End</h4>
                                                            <p><?php echo e($vehicle->date_End); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="service-details-tab-3" role="tabpanel"
                                    aria-labelledby="benefits-tab">
                                    <div class="row g-4">
                                        <?php $__currentLoopData = Auth::user()->guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="benefit-card">


                                                <h4> <i class="bi bi-person"></i> <?php echo e($guest->name); ?></h4>
                                                <div class="contact-method">
                                                    <i class="bi bi-car-front-fill"></i>
                                                    <div>
                                                        <span>vehicle_number</span>
                                                        <p><?php echo e($guest->vehicle_number); ?></p>
                                                    </div>
                                                </div>
                                                <div class="contact-method">
                                                    <i class="bi bi-clock-history"></i>
                                                    <div>
                                                        <span>Login Time</span>
                                                        <p><?php echo e($guest->login_date); ?> - <?php echo e($guest->login_time); ?></p>
                                                    </div>
                                                </div>

                                                <div class="contact-method">
                                                    <i class="bi bi-clock"></i>
                                                    <div>
                                                        <span>Logout Time</span>
                                                        <p><?php echo e($guest->logOut_date); ?> - <?php echo e($guest->logOut_time); ?>

                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="d-flex mx-5"> <button href="#" class="py-3 px-3 btn btn-primary mx-2"
                                                        onclick="openModal('guest', <?php echo e($guest->id); ?>)"><i
                                                            class="bi bi-pencil"></i></button>
                                                            <form action="<?php echo e(route('website.delete_guest',$guest->id)); ?>"
                                                            method="post" class="mx-3 my-0">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                    <button href="#" class="py-3 px-3 btn btn-danger mx-2" onclick="return confirm('Are you sure?')"><i
                                                            class="bi bi-trash"></i></button>
                                                            </form>


                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>




                                <div class="tab-pane fade" id="service-details-tab-4" role="tabpanel"
                                    aria-labelledby="benefits-tab">
                                    <div class="row g-4">
                                        <?php $__currentLoopData = Auth::user()->testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                                                <div class="testimonial-header">
                                                    <i class="bi bi-quote"></i>
                                                    <div class="rating">
                                                        <?php for($i = 0; $i < $testimonial->rating; $i++): ?>
                                                            <i class="bi bi-star-fill"></i>
                                                            <?php endfor; ?>

                                                    </div>
                                                </div>
                                                <p class="testimonial-text" style="overflow-wrap:break-word;">
                                                    <?php echo e($testimonial->text); ?>

                                                </p>
                                                <div class="client-info">
                                                    <div class="d-flex"> <button href="#" class="py-3 px-3 btn btn-primary"
                                                            onclick="openModal('testimonial', <?php echo e($testimonial->id); ?>)"><i
                                                                class="bi bi-pencil"></i></button>

                                                                        <form action="<?php echo e(route('website.delete_testimonial',$testimonial->id)); ?>"
                                                            method="post" class="mx-3 my-0">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                        <button href="#" onclick="return confirm('Are you sure?')" class="py-3 px-3 btn btn-danger"><i
                                                                class="bi bi-trash"></i></button>
                                                                        </form>
                                                    </div>
                                                </div>
                                            </div>







                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

    <div class="service-header" data-aos="fade-up">
                            <h1><?php echo e(Auth::user()->first_name . ' ' . Auth::user()->second_name); ?></h1>
                            <div class="service-meta">
                                <span><i class="bi bi-building"></i> <?php echo e(Auth::user()->building->name); ?> Building</span>
                                <span><i class="bi "></i> </span>
                                <span><i class="bi bi-star"></i> <?php echo e(Auth::user()->unit->name); ?> Unit</span>

                            </div>
                            <div class="service-features-list d-flex flex-wrap" data-aos="fade-up" data-aos-delay="200">

                                <div>

                                    <div>
                                        <h5> <i class="bi bi-clock-history"></i> Date Of Barth</h5>
                                        <p><?php echo e(Auth::user()->date_birth); ?></p>
                                    </div>
                                </div>
                                <div>

                                    <div>
                                        <h5><i class="bi bi-telephone-fill"></i> Phone Number</h5>
                                        <p><?php echo e(Auth::user()->phone); ?></p>
                                    </div>
                                </div>

                                <div>

                                    <div>
                                        <h5> <i class="bi bi-envelope-fill"></i> Email Address</h5>
                                        <p><?php echo e(Auth::user()->email); ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 order-lg-2 order-1" style="margin-top: 50px">

                    <div class="service-sidebar" data-aos="fade-left">


                        <div class="service-features-list aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                            <h4>What We Offer</h4>
                            <ul>
                                <li>

                                    <div>

                                        <a href="#" class="btn-primary " onclick="openModal('vehicle','A')"><i
                                                class="bi bi-car-front-fill"></i> Add New Vehicle</a>
                                    </div>
                                </li>
                                <li>

                                    <div>
                                        <a href="#" class="btn-primary " onclick="openModal('guest','A')"> <i
                                                class="bi bi-car-front-fill"></i> Add New Guest</a>
                                    </div>
                                </li>

                                <li>

                                    <div>
                                        <a href="#" class="btn-primary " onclick="openModal('testimonial','A')"> <i
                                                class="bi bi-car-front-fill"></i> Add New Testimonial</a>
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="action-card" data-aos="zoom-in" data-aos-delay="100">
                            <img src="<?php echo e(asset(Auth::user()->image)); ?>" class="profile-img" alt="">

                            <button href="#" class="btn-primary " onclick="openModal('personal',1)">Edit Your
                                Parsonal
                                Information</button>

                        </div>



                    </div>




                </div>



                <!-- Personal Information Modal -->

                <?php echo $__env->make('website.personal_form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


                <?php echo $__env->make('website.vehicle_form', [
                'vehicles' => Auth::user()->vehicle,
                'mode' => 'edit',
                'route' => 'website.edit_vehicle'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->make('website.guest_form', [
                'guests' => Auth::user()->guests,
                'mode' => 'edit',
                'route' => 'website.edit_guest'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->make('website.testimonial_form', [
                'testimonials' => Auth::user()->testimonials,
                'mode' => 'edit',
                'route' => 'website.edit_testimonial'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



                <?php echo $__env->make('website.vehicle_form', [
                'vehicles' => new App\Models\Vehicle(),
                'mode' => 'Add',
                'route' => 'website.add_vehicle'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



                <?php echo $__env->make('website.testimonial_form', [
                'testimonials' => new App\Models\Testimonial(),
                'mode' => 'Add',
                'route' => 'website.add_testimonial'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->make('website.guest_form', [
                'guests' =>new App\Models\Guest(),
                'mode' => 'Add',
                'route' => 'website.add_guest'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('msg')): ?>
<script>
    alert("<?php echo e(session('msg')); ?>")
</script>

<?php endif; ?>
            </div>

        </div>

    </section><!-- /Service Details Section -->



</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    function openModal(type, id) {
        const modal = document.getElementById('editModal' + type + id);
        const form = document.getElementById('editForm' + type + id);

        modal.style.display = 'flex';

        // Avoid duplicate event listeners
        if (!form.dataset.listenerAdded) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                submitForm(type, id);
            });
            form.dataset.listenerAdded = 'true';
        }
    }

    function closeModal(type, id) {
        document.getElementById('editModal' + type + id).style.display = 'none';
    }

    function submitForm(type, id) {
        const form = document.getElementById('editForm' + type + id);
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            const alertBox = document.getElementById('alertBox_' + type + id);
            if (data.errors) {
                alertBox.style.display = 'block';
  alertBox.innerHTML = ``;
                let messages = '';

                for (let field in data.errors) {
                    messages += `<li class="alert alert-danger m-0 p-2">${data.errors[field][0]}</li>`;
                }
                alertBox.innerHTML += messages;

   form.scrollTo({
                top: 0,
                behavior: 'instant'
            });
            } else {
                alertBox.style.display = 'none';
                alertBox.innerHTML = '';
                alert(data.message);
                // Optionally: close modal or update UI here
                closeModal(type, id);
               setTimeout(() => {
    window.location.reload();
}, 500);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    window.openModal = openModal;
    window.closeModal = closeModal;
});
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('website.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/website/profile.blade.php ENDPATH**/ ?>