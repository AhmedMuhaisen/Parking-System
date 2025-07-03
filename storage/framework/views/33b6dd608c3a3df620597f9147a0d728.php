<?php $__env->startSection('title', 'Category'); ?>
<?php $__env->startSection('content'); ?>


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Categories</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-category">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title"><?php echo $__env->yieldContent('title_form'); ?></h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="<?php echo e(route('Dashboard.category.index')); ?>"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                <?php echo $__env->yieldContent('form'); ?>
                <?php if (isset($component)) { $__componentOriginalff4285866aa89ec70778390fc98eafd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff4285866aa89ec70778390fc98eafd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputd','data' => ['value' => ''.e($category->name).'','title' => 'Name','type' => 'text','name' => 'name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('inputd'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($category->name).'','title' => 'Name','type' => 'text','name' => 'name']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $attributes = $__attributesOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__attributesOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $component = $__componentOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__componentOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>

                <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        work method
                    </label>
                    <select class="form-control   <?php $__errorArgs = ['work_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    is-invalid
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  title="work_method" name="work_method" id="work_method" value="">
                        <option selected value="" style="color: gray" >select
                        </option>
                        <option value="manual" <?php if(old('work_method',$category->work_method)=='manual'): ?> selected
                            <?php endif; ?>>manual
                        </option>
                        <option value="automatic" <?php if(old('work_method',$category->work_method)=='automatic'): ?> selected
                            <?php endif; ?>>automatic
                        </option>

                    </select>
                       <?php $__errorArgs = ['work_method'];
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
                <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        status
                    </label>
                    <select class="form-control   <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    is-invalid
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" title="status" name="status" id="status" value="">
                        <option selected value="">select
                        </option>
                        <option value="active" <?php if(old('status',$category->status)=='active'): ?> selected <?php endif; ?>>active
                        </option>
                        <option value="in_active" <?php if(old('status',$category->status)=='in_active'): ?> selected
                            <?php endif; ?>>in_active
                        </option>

                    </select>
   <?php $__errorArgs = ['status'];
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
   <?php if (isset($component)) { $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea','data' => ['value' => ''.e($category->description).'','title' => 'Description','name' => 'description']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($category->description).'','title' => 'Description','name' => 'description']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $attributes = $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $component = $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>



                

                
                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Category/form.blade.php ENDPATH**/ ?>