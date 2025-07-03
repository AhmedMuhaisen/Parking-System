            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- testimonial Information Modal -->
                <div class="modal" id="editModaltestimonial<?php echo e($testimonial->id ?? 'A'); ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3><?php echo e($mode); ?> testimonial Information</h3>
                            <span class="close" onclick="closeModal('testimonial','<?php echo e($testimonial->id ?? 'A'); ?>')">&times;</span>
                        </div>

                        <form id="editFormtestimonial<?php echo e($testimonial->id ?? 'A'); ?>" action="<?php echo e(route($route, $testimonial->id ?? 'A')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div id="alertBox_testimonial<?php echo e($testimonial->id ?? 'A'); ?>" class="alert alert-danger w-100 " style="position: relative ; display: none">

                                <button onclick="closeAlert()" style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;" type="button">&times;</button>
                            </div>

                            <div class="form-group w-100">
                                <label>rating</label>
                                <input type="text" id="rating<?php echo e($testimonial->id ?? 'A'); ?>" name="rating" value="<?php echo e($testimonial->rating ?? null); ?>" class="">
                            </div>


                            <div class="form-group w-100">
                                <label>text</label>
                                <textarea type="text" class="form-control" id="text<?php echo e($testimonial->id ?? 'A'); ?>" name="text" value=""><?php echo e($testimonial->text ?? null); ?></textarea>
                            </div>

                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/website/testimonial_form.blade.php ENDPATH**/ ?>