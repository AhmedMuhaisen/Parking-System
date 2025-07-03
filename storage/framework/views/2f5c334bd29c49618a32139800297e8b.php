       <div class="modal" id="editModalpersonal1">
           <div class="modal-content">
               <div class="modal-header">
                   <h3>Edit Information</h3>
                   <span class="close" onclick="closeModal('personal',1)">&times;</span>
               </div>

               <form id="editFormpersonal1" action="<?php echo e(route('website.edit_personal', Auth::user()->id)); ?>" method="post">

                   <div id="alertBox_personal1" class="alert alert-danger w-100 " style="position: relative ; display: none">

                       <button onclick="closeAlert()" style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;" type="button">&times;</button>
                   </div>

                   <?php if(Auth::user()->image): ?>

 <div class="form-group w-100 text-center mb-0">
                   <img src="<?php echo e(asset(Auth::user()->image)); ?>" class="profile-img mb-0" alt="">
 </div>
                   <?php endif; ?>

 <div class="form-group w-100">

                      <label>Update Image</label>
                       <input type="file" id="image" value="<?php echo e(Auth::user()->image); ?>" name="image" >
 </div>
                   <div class="form-group">

                       <label>First Name</label>
                       <input type="text" id="first_name" value="<?php echo e(Auth::user()->first_name); ?>" name="first_name" required>
                   </div>
                   <div class="form-group">
                       <label>Second Name</label>
                       <input type="text" id="second_name" value="<?php echo e(Auth::user()->second_name); ?>" name="second_name" required>
                   </div>
                   <div class="form-group">
                       <label>Email</label>
                       <input type="email" id="email" value="<?php echo e(Auth::user()->email); ?>" name="email" required>
                   </div>
                   <div class="form-group">
                       <label>Phone</label>
                       <input type="text" id="phone" value="<?php echo e(Auth::user()->phone); ?>" name="phone" required>
                   </div>
                   <div class="form-group">
                       <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'unit_id','title' => 'unit','value' => ''.e(Auth::user()->unit->id).'','array' => $units]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'unit_id','title' => 'unit','value' => ''.e(Auth::user()->unit->id).'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($units)]); ?>
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
                       <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'building_id','title' => 'building','value' => ''.e(Auth::user()->building->id).'','array' => $buildings]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'building_id','title' => 'building','value' => ''.e(Auth::user()->building->id).'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($buildings)]); ?> <?php echo $__env->renderComponent(); ?>
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

                   <button type="submit">Save Changes</button>
               </form>
           </div>
       </div>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/website/personal_form.blade.php ENDPATH**/ ?>