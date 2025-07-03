<?php $__env->startSection('title', 'Dashboard / Home page'); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .stat-box {
            border-radius: 20px;
            padding: 20px;
            color: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .stat-icon {
            font-size: 35px;
            opacity: 0.8;
        }
    </style>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <main id="main" class="main">


<div class="pagetitle">
  <h1>Dashboard</h1>
</div>

<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="bg-primary stat-box">
      <div class="d-flex justify-content-between">
        <div>
          <h5>Vehicle Entries</h5>
          <h2><?php echo e($entryCount ??0); ?></h2>
          <small class="text-white-50"><?php echo e($entryIncrease ??0); ?>% increase</small>
        </div>
        <i class="bi bi-box-arrow-in-right stat-icon"></i>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="bg-success stat-box">
      <div class="d-flex justify-content-between">
        <div>
          <h5>Vehicle Exits</h5>
          <h2><?php echo e($exitCount ??0); ?></h2>
          <small class="text-white-50"><?php echo e($exitDecrease ??0); ?>% decrease</small>
        </div>
        <i class="bi bi-box-arrow-right stat-icon"></i>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="bg-danger stat-box">
      <div class="d-flex justify-content-between">
        <div>
          <h5>Violations</h5>
          <h2><?php echo e($violationCount ??0); ?></h2>
          <small class="text-white-50">Today</small>
        </div>
        <i class="bi bi-exclamation-triangle stat-icon"></i>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Recent Vehicle Entries</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Plate</th>
              <th>Gate</th>
              <th>Time</th>
              <th>Camera</th>
            </tr>
          </thead>
          <tbody>
           <?php $__currentLoopData = $recentEntries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($entry->vehicle->vehicle_number ?? 'N/A'); ?></td>
        <td><?php echo e($entry->gate->name ?? 'N/A'); ?></td>
        <td><?php echo e($entry->created_at->diffForHumans()); ?></td>
        <td><?php echo e($entry->camera->name ?? 'N/A'); ?></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Live Gate Chart</h5>
        <canvas id="gateChart" height="250"></canvas>
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-body">
        <h5 class="card-title">Live Notifications</h5>
        <ul class="list-group">
          <?php $__currentLoopData = $notifications ??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item small">
              <?php echo e($note->message); ?> <br>
              <small class="text-muted"><?php echo e($note->created_at->diffForHumans()); ?></small>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </div>
</div>


    </main><!-- End #main -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('gateChart');
  const gateChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($chartLabels); ?>,
      datasets: [{
        label: 'Entries per Gate',
        data: <?php echo json_encode($chartData); ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderRadius: 10,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `${context.raw} vehicles`;
            }
          }
        }
      }
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Parking_System\resources\views/Dashboard/index.blade.php ENDPATH**/ ?>