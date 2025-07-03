<?php $__env->startSection('title', 'role'); ?>
<?php $__env->startSection('content'); ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>roles</h1>
            </div>
        </div><!-- End Page Title -->

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body create-role">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title"><?php echo $__env->yieldContent('title_form'); ?></h5>
                        <a class="role-back btn btn-primary w-20 h-75" href="<?php echo e(route('Dashboard.role.index')); ?>"> Rol
                            Back</a>
                    </div>
                    <!-- General Form Elements -->
                    <?php echo $__env->yieldContent('form'); ?>
                    <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a = $attributes; } ?>
<?php $component = App\View\Components\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($role->name).'','title' => 'name','type' => 'text','name' => 'name']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $attributes = $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $component = $__componentOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>

                    <div class="mb-4 d-flex flex-wrap">



                        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-3 m-1 d-flex" style="border: 1px solid #0d6efd ; width: 32.4%;">
                                <p class="w-100 mb-0"><?php echo e($item->code); ?></p>

                                <div class=" form-check d-flex flex-row-reverse" style="">
                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                        value="<?php echo e($item->id); ?>" <?php if(in_array($item->id, $role->permission->pluck('id')->toArray())): echo 'checked'; endif; ?>>

                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/role/form.blade.php ENDPATH**/ ?>