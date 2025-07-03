<?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- Vehicle Information Modal -->

<div class="modal" id="editModalvehicle<?php echo e($vehicle->id ?? 'A'); ?>">
    <div class="modal-content">
        <div class="modal-header">
            <h3><?php echo e($mode); ?> Vehicle Information</h3>
            <span class="close" onclick="closeModal('vehicle', '<?php echo e($vehicle->id ?? 'A'); ?>')">&times;</span>
        </div>

        <form id="editFormvehicle<?php echo e($vehicle->id ?? 'A'); ?>" action="<?php echo e(route($route, $vehicle->id ?? 'A')); ?>"
            method="post" >
            <?php echo csrf_field(); ?>
            <div id="alertBox_vehicle<?php echo e($vehicle->id ?? 'A'); ?>" class="alert alert-danger w-100 "
                style="position: relative ; display: none">

                <button onclick="closeAlert()"
                    style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;"
                    type="button">&times;</button>
            </div>

            <?php if(isset($vehicle->image)): ?>

            <div class="form-group w-100 text-center mb-0">
                <img src="<?php echo e(asset($vehicle->image)); ?>" class="profile-img mb-0" alt="">
            </div>
            <?php endif; ?>

            <div class="form-group">

                <label>Update Image</label>
                <input type="file" id="image" value="" name="image">
            </div>
            <div class="form-group">
                <label>Vehicle Number</label>
                <input type="text" id="vehicle_number<?php echo e($vehicle->id ?? 'A'); ?>" name="vehicle_number"
                    value="<?php echo e($vehicle->vehicle_number ?? null); ?>">
            </div>
            <div class="form-group">
                <label>Vehicle Type</label>
                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['id' => 'vehicle_type'.e($vehicle->id ?? 'A').'','name' => 'vehicle_type','title' => 'Vehicle Type','value' => ''.e($vehicle->vehicle_type->id ?? 'A').'','array' => $vehicles_type]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'vehicle_type'.e($vehicle->id ?? 'A').'','name' => 'vehicle_type','title' => 'Vehicle Type','value' => ''.e($vehicle->vehicle_type->id ?? 'A').'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($vehicles_type)]); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>

            </div>
            <div class="form-group">
                <label>Motor Type</label>
                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'motor_type','id' => 'motor_type'.e($vehicle->id ?? 'A').'','title' => 'Motor Type','value' => ''.e($vehicle->motor_type->id ?? 'A').'','array' => $motor_type]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'motor_type','id' => 'motor_type'.e($vehicle->id ?? 'A').'','title' => 'Motor Type','value' => ''.e($vehicle->motor_type->id ?? 'A').'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($motor_type)]); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>


            </div>
            <div class="form-group">
                <label>Car Type</label>
                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'VehiclesBrand','id' => 'VehiclesBrand'.e($vehicle->id ?? 'A').'','title' => 'car Type','value' => ''.e($vehicle->vehicle_brand->id ?? 'A').'','array' => $VehiclesBrand]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'VehiclesBrand','id' => 'VehiclesBrand'.e($vehicle->id ?? 'A').'','title' => 'car Type','value' => ''.e($vehicle->vehicle_brand->id ?? 'A').'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($VehiclesBrand)]); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
            </div>
              <div class="form-group">
                <label>Color</label>
                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'color','id' => 'color'.e($vehicle->id ?? 'A').'','title' => 'Color','value' => ''.e($vehicle->color->id ?? 'A').'','array' => $color]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'color','id' => 'color'.e($vehicle->id ?? 'A').'','title' => 'Color','value' => ''.e($vehicle->color->id ?? 'A').'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color)]); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
            </div>
                     <div class="form-group">
                <label>Date Of Start</label>
                <input type="date" id="date_start<?php echo e($vehicle->id ?? 'A'); ?>" name="date_start"
                    value="<?php echo e($vehicle->date_start  ?? 'A'); ?>" required>
            </div>
            <div class="form-group">
                <label>Date Of End</label>
                <input type="date" id="date_end<?php echo e($vehicle->id ?? 'A'); ?>" name="date_end"
                    value="<?php echo e($vehicle->date_End  ?? 'A'); ?>" required>
            </div>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/website/vehicle_form.blade.php ENDPATH**/ ?>