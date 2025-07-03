
                        <?php $__empty_1 = true; $__currentLoopData = $gate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>


                            <td width=""><?php echo e($item->name); ?></td>
                              <td width="200"><?php echo e($item->address); ?></td>
                               <td width=""><?php echo e($item->parking->name); ?></td>
                            <td width=""><?php echo e($item->type); ?></td>

                            <td width=""><?php echo e($item->open_method); ?></td>
                            <td width=""><?php echo e($item->status); ?></td>


                            
                            

                            <td>
                                <div class="d-flex">
                                    <a href=<?php if($page=='trash'
                                        ): ?> "<?php echo e(route('Dashboard.gate.restore', $item->id)); ?>"
                                        <?php else: ?> "<?php echo e(route('Dashboard.gate.edit', $item->id)); ?>" <?php endif; ?>>

                                        <i class="<?php if($page == 'trash'): ?> fa fa-store <?php else: ?> fa fa-pencil <?php endif; ?>" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="<?php if($page == 'trash'): ?> <?php echo e(route('Dashboard.gate.forcedelete', $item->id)); ?><?php else: ?><?php echo e(route('Dashboard.gate.destroy', $item->id)); ?> <?php endif; ?>"
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
                       <tr> <td colspan="7" class="text-center">"No data available"</td></tr>
                        <?php endif; ?>

<?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Gate/table.blade.php ENDPATH**/ ?>