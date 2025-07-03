
                        <?php $__empty_1 = true; $__currentLoopData = $vehicleMovement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>

                            <td width="200"><?php echo e($item->vehicle->vehicle_number); ?></td>
                             <td><?php echo e($item->vehicle->user->first_name .' '.$item->vehicle->user->second_name); ?></td>
                            <td><?php echo e($item->gate->name); ?></td>
                            <td><?php echo e($item->type_Movement); ?></td>
                              <td><?php echo e($item->method_passage); ?></td>

                            <td width="200"><?php echo e($item->created_at->format('m-d-Y')); ?></td>

                               <td width="200"><?php echo e($item->created_at->format('h-m-s')); ?></td>










                            
                            

                            <td>
                                <div class="d-flex">
                                    <a href=<?php if($page=='trash'
                                        ): ?> "<?php echo e(route('Dashboard.vehicleMovement.restore', $item->id)); ?>"
                                        <?php else: ?> "<?php echo e(route('Dashboard.vehicleMovement.edit', $item->id)); ?>" <?php endif; ?>>

                                        <i class="<?php if($page == 'trash'): ?> fa fa-store <?php else: ?> fa fa-pencil <?php endif; ?>" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="<?php if($page == 'trash'): ?> <?php echo e(route('Dashboard.vehicleMovement.forcedelete', $item->id)); ?><?php else: ?><?php echo e(route('Dashboard.vehicleMovement.destroy', $item->id)); ?> <?php endif; ?>"
                                        method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('delete'); ?>
                                        <button style="border: 0; background: none;"><i class="<?php if($page == 'trash'): ?> fa fa-close
                                                        <?php else: ?> fa fa-trash <?php endif; ?>" style="background: #c60707;
                                                                padding: 9px 10px;
                                                                color: white;
                                                                border-radius: 8px;">
                                            </i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                       <tr> <td colspan="12" class="text-center">"No data available"</td></tr>
                        <?php endif; ?>

<?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/VehicleMovement/table.blade.php ENDPATH**/ ?>