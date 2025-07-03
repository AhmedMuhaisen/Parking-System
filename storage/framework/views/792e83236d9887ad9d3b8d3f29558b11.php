
                        <?php $__empty_1 = true; $__currentLoopData = $notification_systems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>

                             <td width="900"><div class="d-flex">
  <?php echo $item->message; ?>

</div></td>

            <td width="200"><?php echo e($item->actions); ?></td>









                            
                            

                            

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                       <tr> <td colspan="12" class="text-center">"No data available"</td></tr>
                        <?php endif; ?>

<?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Notification_System/table.blade.php ENDPATH**/ ?>