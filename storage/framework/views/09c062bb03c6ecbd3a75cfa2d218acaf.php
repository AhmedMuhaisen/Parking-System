
                <?php $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- guest Information Modal -->
                <div class="modal" id="editModalguest<?php echo e($guest->id ?? 'A'); ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3><?php echo e($mode); ?> guest Information</h3>
                            <span class="close" onclick="closeModal('guest','<?php echo e($guest->id ?? 'A'); ?>')">&times;</span>
                        </div>

                        <form id="editFormguest<?php echo e($guest->id ?? 'A'); ?>" action="<?php echo e(route($route, $guest->id ?? 'A')); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <div id="alertBox_guest<?php echo e($guest->id ?? 'A'); ?>" class="alert alert-danger w-100 "
                                style="position: relative ; display: none">

                                <button onclick="closeAlert()"
                                    style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;"
                                    type="button">&times;</button>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="guest_name<?php echo e($guest->id ?? 'A'); ?>" name="name"
                                    value="<?php echo e($guest->name ?? null); ?>">
                            </div>


                            <div class="form-group">
                                <label>Vehicle Number</label>
                                <input type="text" id="vehicle_number<?php echo e($guest->id ?? 'A'); ?>" name="vehicle_number"
                                    value="<?php echo e($guest->vehicle_number ?? null); ?>">
                            </div>
                            <div class="form-group">
                                <label>Login Date</label>
                                <input type="date" id="login_date<?php echo e($guest->id ?? 'A'); ?>" name="login_date"
                                    value="<?php echo e($guest->login_date ?? null); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Login time</label>
                                <input type="time" id="login_time<?php echo e($guest->id ?? 'A'); ?>" name="login_time"
                                    value="<?php echo e($guest->login_time ?? null); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>logout Date</label>
                                <input type="date" id="logout_date<?php echo e($guest->id ?? 'A'); ?>" name="logOut_date"
                                    value="<?php echo e($guest->logOut_date ?? null); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>logout time</label>
                                <input type="time" id="logout_time<?php echo e($guest->id ?? 'A'); ?>" name="logOut_time"
                                    value="<?php echo e($guest->logOut_time ?? null); ?>" required>
                            </div>

                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/website/guest_form.blade.php ENDPATH**/ ?>