<?php $__env->startSection('title', 'notification_rule'); ?>
<?php $__env->startSection('content'); ?>

<style>
    #color {
        height: 40px;
    }

    .pretty-checkbox {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        margin-right: 1rem;
        position: relative;
        font-weight: 500;
    }

    .pretty-checkbox input[type="checkbox"] {
        display: none;
    }

    .pretty-checkbox .checkmark {
        height: 18px;
        width: 18px;
        background-color: #eee;
        border-radius: 4px;
        margin-right: 8px;
        position: relative;
        border: 1px solid #ccc;
    }

    .pretty-checkbox input:checked+.checkmark {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .pretty-checkbox .checkmark::after {
        content: "";
        position: absolute;
        display: none;
        left: 6px;
        top: 2px;
        width: 4px;
        height: 9px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .pretty-checkbox input:checked+.checkmark::after {
        display: block;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Notification Rule</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-notification_rule">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title"><?php echo $__env->yieldContent('title_form'); ?></h5>
                    <a class="role-back btn btn-primary w-20 h-75"
                        href="<?php echo e(route('Dashboard.notification_rule.index')); ?>"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                <?php echo $__env->yieldContent('form'); ?>

                <div class="mb-3">
                    <label class="mb-2">Entity Type</label>
                    <select name="entity_type" class="form-select     <?php $__errorArgs = ['entity_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">-- Select --</option>
                        <?php $__currentLoopData = ['vehicle', 'camera', 'guest','user','spot','building','unit','parking','vehicle_type',
                        'vehicle_brand','message','notification_rule','category', 'gate','testimonial']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php echo e(old('entity_type',$notification_rule->entity_type) == $type ?
                            'selected' : ''); ?>><?php echo e(ucfirst($type)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select> <?php $__errorArgs = ['entity_type'];
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

                <div class="mb-3">
                    <label class="my-2">Event Type</label>
                    <select name="event_type" class="form-select     <?php $__errorArgs = ['event_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__currentLoopData = ['create', 'move', 'open', 'delete', 'edit','register','send']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($event); ?>" <?php echo e(old('event_type',$notification_rule->event_type) == $event ?
                            'selected' : ''); ?>><?php echo e(ucfirst($event)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select> <?php $__errorArgs = ['event_type'];
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

                <div class="mb-3"> <label class="">
                        <input type="checkbox" name="onr" id="onr"> Onr
                    </label>
                </div>

   <?php if (isset($component)) { $__componentOriginal16e30cd93b35c344708b648bc5642fe0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16e30cd93b35c344708b648bc5642fe0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.selectd','data' => ['type' => 'text','value' => ''.e($notification_rule->target_audience).'','array' => $target_audience,'name' => 'target_audience_id','id' => 'target_audience','title' => 'target_audience']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('selectd'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','value' => ''.e($notification_rule->target_audience).'','array' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($target_audience),'name' => 'target_audience_id','id' => 'target_audience','title' => 'target_audience']); ?>
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



                <div class="mb-3 d-none" id="userSelect">
                    <label>Select User</label>
                    <select name="user_id" class="form-select     <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__currentLoopData = App\Models\User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id',$notification_rule->user_id) == $user->id ?
                            'selected' : ''); ?>><?php echo e($user->first_name .' '.$user->second_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select> <?php $__errorArgs = ['user_id'];
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

                <div class="mb-3 d-none" id="phoneInput">
                    <label>Phone Number</label>
                    <input type="number" name="phone" value="<?php echo e(old('phone',$notification_rule->phone)); ?>" class="form-control     <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['phone'];
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

                <div class="mb-3 d-none" id="emailInput">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo e(old('email',$notification_rule->email)); ?>" class="form-control     <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['email'];
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


                <div class="mb-3">
                    <label class="form-label      <?php $__errorArgs = ['channels'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">Channels</label><br>
                    <?php $__currentLoopData = ['system', 'email', 'sms']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="pretty-checkbox">
                        <input type="checkbox" name="channels[]" value="<?php echo e($channel); ?>" <?php echo e(isset($notification_rule) &&
                            in_array($channel, json_decode($notification_rule->channels ?? '[]')) ? 'checked' : ''); ?>>
                        <span class="checkmark"></span>
                        <?php echo e(ucfirst($channel)); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__errorArgs = ['channels'];
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea','data' => ['name' => 'message','title' => 'message','value' => ''.e($notification_rule->message ?? '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'message','title' => 'message','value' => ''.e($notification_rule->message ?? '').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $attributes = $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $component = $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>

                <div class="my-3">
                    <label class="my-2      <?php $__errorArgs = ['additional'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">Additional</label><br>

                    <?php $__currentLoopData = ['created_by', 'created_at']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="pretty-checkbox">
                        <input type="checkbox" name="additional[]" value="<?php echo e($additional); ?>" <?php echo e(isset($notification_rule) && in_array($additional,
                            json_decode($notification_rule->additional ?? '[]')) ? 'checked' : ''); ?>>
                        <span class="checkmark"></span>
                        <?php echo e(ucfirst($additional)); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__errorArgs = ['additional'];
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

                <div class="mb-3">
                    <label class="my-2      <?php $__errorArgs = ['actions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">Actions</label><br>
                    <?php $__currentLoopData = ['edit', 'delete', 'resend' ,'show']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="pretty-checkbox">
                        <input type="checkbox" name="actions[]" value="<?php echo e($action); ?>" <?php echo e(isset($notification_rule) &&
                            in_array($action, json_decode($notification_rule->actions ?? '[]')) ? 'checked' : ''); ?>>
                        <span class="checkmark"></span>
                        <?php echo e(ucfirst($action)); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__errorArgs = ['actions'];
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
                </form>



            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const audienceSelect = document.getElementById('targetAudience');
        const userSelect = document.getElementById('userSelect');
        const phoneInput = document.getElementById('phoneInput');
        const emailInput = document.getElementById('emailInput');

        function toggleFields() {
            const value = audienceSelect.value;
            userSelect.classList.toggle('d-none', value !== 'user');
            phoneInput.classList.toggle('d-none', value !== 'phone');
            emailInput.classList.toggle('d-none', value !== 'email');
        }

        audienceSelect.addEventListener('change', toggleFields);
        toggleFields();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Notification_Rule/form.blade.php ENDPATH**/ ?>