<?php $__env->startSection('title', 'testimonial'); ?>
<?php $__env->startSection('content'); ?>


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>testimonials</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-testimonial">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title"><?php echo $__env->yieldContent('title_form'); ?></h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="<?php echo e(route('Dashboard.testimonial.index')); ?>"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                <?php echo $__env->yieldContent('form'); ?>
                <?php if (isset($component)) { $__componentOriginalff4285866aa89ec70778390fc98eafd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff4285866aa89ec70778390fc98eafd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputd','data' => ['value' => ''.e($testimonial->rating).'','title' => 'testimonial Rating','type' => 'text','name' => 'rating']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('inputd'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($testimonial->rating).'','title' => 'testimonial Rating','type' => 'text','name' => 'rating']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $attributes = $__attributesOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__attributesOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $component = $__componentOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__componentOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea','data' => ['value' => ''.e($testimonial->text).'','title' => 'testimonial text','type' => 'text','name' => 'text']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($testimonial->text).'','title' => 'testimonial text','type' => 'text','name' => 'text']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $attributes = $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $component = $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>


                <div class="my-2">
                    <label for="">testimonial Onr</label>

                    <select class="form-control mt-2   <?php $__errorArgs = ['user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    is-invalid
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" title="user" name="user" id="user" value="">

                        <option selected value="" style="color: gray">select
                        </option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" <?php if(old('user',$item->id)==$testimonial->user->id): ?> selected
                            <?php endif; ?>><?php echo e($item->first_name . ' ' .$item->second_name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>   <?php $__errorArgs = ['user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-danger"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Testimonial/form.blade.php ENDPATH**/ ?>