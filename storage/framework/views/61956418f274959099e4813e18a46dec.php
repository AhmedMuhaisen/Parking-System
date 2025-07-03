   <div class="mb-4 d-flex flex-wrap">



                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-3 m-1 d-flex" style="border: 1px solid #0d6efd ; width: 32.4%;">
                        <p class="w-100 mb-0"><?php echo e($item->first_name.' '.$item->second_name); ?></p>

                        <div class=" form-check d-flex flex-row-reverse" style="">
                            <input type="checkbox" class="form-check-input" name="users[]" value="<?php echo e($item->id); ?>"
                                <?php if(in_array($item->id, json_decode($target_audience->users, true) ?? [])): echo 'checked'; endif; ?>>

                        </div>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Target_Audience/users.blade.php ENDPATH**/ ?>