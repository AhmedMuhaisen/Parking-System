<?php $__env->startSection('title', 'target_audience'); ?>
<?php $__env->startSection('content'); ?>


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>target_audiences</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-target_audience">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title"><?php echo $__env->yieldContent('title_form'); ?></h5>
                    <a class="target_audience-back btn btn-primary w-20 h-75"
                        href="<?php echo e(route('Dashboard.target_audience.index')); ?>"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                <?php echo $__env->yieldContent('form'); ?>

                <?php if (isset($component)) { $__componentOriginalff4285866aa89ec70778390fc98eafd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff4285866aa89ec70778390fc98eafd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputd','data' => ['value' => ''.e($target_audience->name).'','title' => 'name','type' => 'text','name' => 'name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('inputd'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($target_audience->name).'','title' => 'name','type' => 'text','name' => 'name']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $attributes = $__attributesOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__attributesOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff4285866aa89ec70778390fc98eafd4)): ?>
<?php $component = $__componentOriginalff4285866aa89ec70778390fc98eafd4; ?>
<?php unset($__componentOriginalff4285866aa89ec70778390fc98eafd4); ?>
<?php endif; ?>

                <div class="d-flex">
                    <div class="w-50 pl-2 py-3">
                        <select class="form-control" title="search" name="group" id="group" value="">
                            <option selected value="">search
                            </option>
                            <option value="admin">admin
                            </option>
                            <option value="user">user
                            </option>
                        </select>
                    </div>
                    <div class="w-50 px-2 py-3">

                        <select class="form-control   <?php $__errorArgs = ['user'];
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
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->first_name . ' ' .$item->second_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select> <?php $__errorArgs = ['user'];
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

                         <input type="hidden" name="target_audience" id="target_audience" value="<?php echo e($target_audience); ?>">
                    <div class="w-20 px-2 py-3">
                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                    </div>
                </div>
<div id="Container">
                <?php echo $__env->make('Dashboard.Target_Audience.users', ['users' => $users], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto"
                   >Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
    $('#searchBtn').on('click', function (e) {
        e.preventDefault();
        search(e);
    });
});
    function datavalue(){

        return{
        group: $('#group').val(),
        user: $('#user').val(),
          target_audience: $('#target_audience').val(),
    };
    }

   function search(e) {
    e.preventDefault();
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "<?php echo e(route('Dashboard.target_audience.search', $target_audience->id)); ?>",
            type: "GET",
            data: data,
            success: function (response) {
                $('#Container').html(response.html);
                console.log(response);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Target_Audience/form.blade.php ENDPATH**/ ?>