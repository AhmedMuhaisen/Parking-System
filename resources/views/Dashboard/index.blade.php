@extends('Dashboard.main')
@section('title', 'Dashboard / Home page')
@section('style')
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
    @endsection
@section('content')


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
          <h2>{{ $entryCount ??0}}</h2>
          <small class="text-white-50">{{ $entryIncrease ??0}}% increase</small>
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
          <h2>{{ $exitCount ??0}}</h2>
          <small class="text-white-50">{{ $exitDecrease ??0}}% decrease</small>
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
          <h2>{{ $violationCount ??0}}</h2>
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
           @foreach ($recentEntries as $entry)
    <tr>
        <td>{{ $entry->vehicle->vehicle_number ?? 'N/A' }}</td>
        <td>{{ $entry->gate->name ?? 'N/A' }}</td>
        <td>{{ $entry->created_at->diffForHumans() }}</td>
        <td>{{ $entry->camera->name ?? 'N/A' }}</td>
    </tr>
@endforeach
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
          @foreach($notifications ??[] as $note)
            <li class="list-group-item small">
              {{ $note->message }} <br>
              <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>


    </main><!-- End #main -->

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('gateChart');
  const gateChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($chartLabels) !!},
      datasets: [{
        label: 'Entries per Gate',
        data: {!! json_encode($chartData) !!},
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
@endsection
