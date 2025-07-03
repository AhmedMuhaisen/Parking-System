
                        <?php $__empty_1 = true; $__currentLoopData = $vehiclesType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>


                            <td width="200"><?php echo e($item->name); ?></td>
 <td width="200"><?php echo e($item->vehicles->count()); ?></td>
                            <td width="200"><?php echo e($item->created_at->format('m-d-Y')); ?></td>



                            
                            

                            <td>
                                <div class="d-flex">
                                    <a href=<?php if($page=='trash'
                                        ): ?> "<?php echo e(route('Dashboard.vehiclesType.restore', $item->id)); ?>"
                                        <?php else: ?> "<?php echo e(route('Dashboard.vehiclesType.edit', $item->id)); ?>" <?php endif; ?>>

                                        <i class="<?php if($page == 'trash'): ?> fa fa-store <?php else: ?> fa fa-pencil <?php endif; ?>" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="<?php if($page == 'trash'): ?> <?php echo e(route('Dashboard.vehiclesType.forcedelete', $item->id)); ?><?php else: ?><?php echo e(route('Dashboard.vehiclesType.destroy', $item->id)); ?> <?php endif; ?>"
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
                       <tr> <td colspan="5" class="text-center">"No data available"</td></tr>
                        <?php endif; ?>

<?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/VehiclesType/table.blade.php ENDPATH**/ ?>