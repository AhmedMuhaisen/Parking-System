<?php $__env->startSection('title', 'Show roles'); ?>


<?php $__env->startSection('content'); ?>
    <main id="main" class="main position-absolute">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>roles</h1>
                <a href="<?php echo e(route('Dashboard.role.create')); ?>"
                    style="
                        background: #4154f1;
                        color: white;
                        padding: 10px;
                        border: 2px solid white;
                        border-radius: 8px;
                    }
">add
                    new role</a>
            </div>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body right-thead">
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <h 5 class="card-title">show All Categoris</h>
                        <?php if($page == 'index'): ?>
                            <a href="<?php echo e(route('Dashboard.role.trash')); ?>"
                                style="
                            background: #cb4f07;
                            color: white;
                            padding: 10px;
                            border: 2px solid white;
                            border-radius: 8px;">
                                <i class="fas fa-trash"></i>
                                Trashed roles</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('Dashboard.role.index')); ?>"
                                style="
                            background: #0752cb;
                            color: white;
                            padding: 10px;
                            border: 2px solid white;
                            border-radius: 8px;">
                                <i class="fas fa-tag"></i>
                                All roles</a>
                        <?php endif; ?>

                    </div>

                    <div class="datatable-top">
                        <div class="datatable-dropdown">
                            <label>
                                <select class="datatable-selector" name="per-page">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="-1">All</option>
                                </select> entries per page
                            </label>
                        </div>
                        <div class="datatable-search">
                            <input class="datatable-input" placeholder="Search..." type="search" name="search"
                                title="Search within table">
                        </div>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th scope="col" width="600">Name</th>
                                <th scope="col"  width="400">Permissions Number</th>
                                <th scope="col" width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php $__empty_1 = true; $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>


                                    <td><?php echo e($role->name); ?></td>
                                    <td><?php echo e($role->permission->count()); ?></td>


                                    <td>
                                        <div class="d-flex">
                                            <a
                                                href=<?php if($page == 'trash'): ?> "<?php echo e(route('Dashboard.role.restore', $role->id)); ?>"
                                                 <?php else: ?> "<?php echo e(route('Dashboard.role.edit', $role->id)); ?>" <?php endif; ?>>

                                                <i class="<?php if($page == 'trash'): ?> fa fa-store <?php else: ?> fa fa-pencil <?php endif; ?>"
                                                    style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                            <form
                                                action="<?php if($page == 'trash'): ?> <?php echo e(route('Dashboard.role.forcedelete', $role->id)); ?><?php else: ?><?php echo e(route('Dashboard.role.destroy', $role->id)); ?> <?php endif; ?>"
                                                method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                <button style="border: 0; background: none;"><i
                                                        class="<?php if($page == 'trash'): ?> fa fa-close
                                                        <?php else: ?> fa fa-trash <?php endif; ?>"
                                                        style="    background: #c60707;
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
                                <p>لا يوجد بيانات</p>
                            <?php endif; ?>


                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

            </div>
            </div>
        </section>

    </main><!-- End #main -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/Role/index.blade.php ENDPATH**/ ?>