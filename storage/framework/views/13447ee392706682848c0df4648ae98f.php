<?php $__env->startSection('title', 'vehicleMovement'); ?>
<?php $__env->startSection('content'); ?>

<style>
    #color {
        height: 40px;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>vehicles Movements</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-vehicleMovement">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title"><?php echo $__env->yieldContent('title_form'); ?></h5>
                    <a class="role-back btn btn-primary w-20 h-75"
                        href="<?php echo e(route('Dashboard.vehicleMovement.index')); ?>"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                <?php echo $__env->yieldContent('form'); ?>




                    <div class="my-2">
<label for="">Vehicle Number</label>

                <select class="form-control mt-2   <?php $__errorArgs = ['vehicle_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    is-invalid
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" title="vehicle_number" name="vehicle_number" id="vehicle_number" value="">

                    <option selected value="" disabled hidden style="color: gray">select
                    </option>
                    <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>" <?php if(old('vehicle_number',$item->id)==$vehicleMovement->vehicle->id): ?> selected
                        <?php endif; ?>><?php echo e($item->vehicle_number); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>   <?php $__errorArgs = ['vehicle_number'];
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



                <?php if (isset($component)) { $__componentOriginal16e30cd93b35c344708b648bc5642fe0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16e30cd93b35c344708b648bc5642fe0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.selectd','data' => ['type' => 'text','value' => ''.e($vehicleMovement->gate->id).'','array' => $gate,'name' => 'gate','id' => 'gate','title' => 'gate']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('selectd'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','value' => ''.e($vehicleMovement->gate->id).'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($gate),'name' => 'gate','id' => 'gate','title' => 'gate']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16e30cd93b35c344708b648bc5642fe0)): ?>
<?php $attributes = $__attributesOriginal16e30cd93b35c344708b648bc5642fe0; ?>
<?php unset($__attributesOriginal16e30cd93b35c344708b648bc5642fe0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16e30cd93b35c344708b648bc5642fe0)): ?>
<?php $component = $__componentOriginal16e30cd93b35c344708b648bc5642fe0; ?>
<?php unset($__componentOriginal16e30cd93b35c344708b648bc5642fe0); ?>
<?php endif; ?>



 <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        Method Of Passing
                    </label>
                    <select class="form-control   <?php $__errorArgs = ['method_passage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    is-invalid
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  title="method_passage" name="method_passage" id="method_passage" value="">
                        <option selected disabled hidden value="" style="color: gray" >select
                        </option>
                        <option value="Manual" <?php if(old('method_passage',$vehicleMovement->method_passage)=='Manual'): ?> selected
                            <?php endif; ?>>Manual
                        </option>
                        <option value="Automatic" <?php if(old('method_passage',$vehicleMovement->method_passage)=='Automatic'): ?> selected
                            <?php endif; ?>>Automatic
                        </option>

                    </select>   <?php $__errorArgs = ['method_passage'];
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
                         movement type
                     </label>
                    <select class="form-control   <?php $__errorArgs = ['type_movement'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    is-invalid
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" title="type_movement" name="type_movement" id="type_movement" value="">
                        <option selected disabled hidden value="">select
                        </option>
                        <option value="Entry" <?php if(old('type_movement',$vehicleMovement->type_Movement)=='Entry'): ?> selected <?php endif; ?>>Entry
                        </option>
                        <option value="Exit" <?php if(old('type_movement',$vehicleMovement->type_Movement)=='Exit'): ?> selected
                            <?php endif; ?>>Exit
                        </option>

                    </select>
   <?php $__errorArgs = ['type_movement'];
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



                <?php if (isset($component)) { $__componentOriginalff4285866aa89ec70778390fc98eafd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff4285866aa89ec70778390fc98eafd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputd','data' => ['type' => 'date','value' => ''.e($vehicleMovement->date).'','name' => 'date','id' => 'date','title' => 'date']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('inputd'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'date','value' => ''.e($vehicleMovement->date).'','name' => 'date','id' => 'date','title' => 'date']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $attributes = $__attributesOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__attributesOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $component = $__componentOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__componentOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>

                     <?php if (isset($component)) { $__componentOriginalff4285866aa89ec70778390fc98eafd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff4285866aa89ec70778390fc98eafd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputd','data' => ['type' => 'time','value' => ''.e($vehicleMovement->time).'','name' => 'time','id' => 'time','title' => 'time']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('inputd'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'time','value' => ''.e($vehicleMovement->time).'','name' => 'time','id' => 'time','title' => 'time']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $attributes = $__attributesOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__attributesOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $component = $__componentOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__componentOriginalff4285866aa89ec70778390fc98eafd4); ?>
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

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/VehicleMovement/form.blade.php ENDPATH**/ ?>