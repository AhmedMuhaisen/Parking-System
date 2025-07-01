<?php $__empty_1 = true; $__currentLoopData = $building; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>

    <td width="200"><?php echo e($item->name); ?></td>
    <td width="200"><?php echo e($item->address); ?></td>

    <td width="200"><?php echo e($item->user->first_name . ' '.$item->user->second_name); ?></td>
    <td width="200"><?php echo e($item->parking->name); ?></td>
    <td width="200"><?php echo e($item->unit->count()); ?></td>

    <td width="200">
        <?php echo e($item->users->count()); ?>

        </td>
        <td><?php echo e($item->users->flatMap->vehicle->count()); ?></td>

    <td width="200"><?php echo e($item->spot->count()); ?></td>
    <td width="200"><?php echo e($item->users->flatMap->guests->count()); ?></td>

    <td width="200"><?php echo e($item->max_units); ?></td>
    <td width="200"><?php echo e($item->max_users); ?></td>
    <td width="200"><?php echo e($item->max_vehicles); ?></td>
    <td width="200"><?php echo e($item->max_spots); ?></td>
    <td width="200"><?php echo e($item->max_guests); ?></td>





    
    

    <td>
        <div class="d-flex">
            <a href=<?php if($page=='trash' ): ?> "<?php echo e(route('Dashboard.building.restore', $item->id)); ?>"
                <?php else: ?> "<?php echo e(route('Dashboard.building.edit', $item->id)); ?>" <?php endif; ?>>

                <i class="<?php if($page == 'trash'): ?> fa fa-store <?php else: ?> fa fa-pencil <?php endif; ?>" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

            <form
                action="<?php if($page == 'trash'): ?> <?php echo e(route('Dashboard.building.forcedelete', $item->id)); ?><?php else: ?><?php echo e(route('Dashboard.building.destroy', $item->id)); ?> <?php endif; ?>"
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
<tr>
    <td colspan="20" class="text-center">"No data available"</td>
</tr>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Building/table.blade.php ENDPATH**/ ?>