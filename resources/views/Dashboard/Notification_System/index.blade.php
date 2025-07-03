@section('title', 'Show notification_systems')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main position-absolute">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>notification_systems</h1>
            <a href="{{ route('Dashboard.notification_system.create') }}" class="btn btn-primary" style="
">add
                new notification_system</a>
        </div>
    </div><!-- End Page Title -->


    <style>
        table thead th,
        select {
            min-width: 120px;
        }
    </style>
    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All notification_systems</h>
                    @if ($page == 'index')
                    @can('notification_system.index')
                    <a href="{{ route('Dashboard.notification_system.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed notification_systems</a>
                    @endcan
                    @else
                    @can('notification_system.index')
                    <a href="{{ route('Dashboard.notification_system.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All notification_systems</a>
                    @endcan
                    @endif

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
                        <a class="btn btn-dark" href="" id="printExcelReport">Export Excel</a>
                        <a class="btn btn-danger" id="printPdfReport" href="">Export
                            Pdf</a>
                    </div>
                </div>

                <!-- Table with stripped rows -->
                <table class="table table-striped">

                    <thead>
                        <tr>

                            <th scope="col"  width="600">Notification</th>



                            <th scope="col" width="120">Action</th>
                        </tr>

                        <tr>
                            <td scope="col" colspan="1" width='200'>
                                <x-input type="text" value="" name="notification" id="notification" title="search" />
                            </td>



                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width='200' width="120"><button class="btn btn-primary"
                                    id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.Notification_System.table', ['notification_system' => $notification_systems,
                        'page' => $page])
                    </tbody>
                </table>
{{ $notification_systems->links() }}




                <!-- End Table with stripped rows -->

            </div>
        </div>

        </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function datavalue(){
        return{
        entity_type: $('#entity_type').val(),
        channels: $('#channels').val(),
         event_type: $('#event_type').val(),
          title: $('#title').val(),
        message: $('#message').val(),
        created_by: $('#created_by').val(),
        target_audience: $('#target_audience').val(),
          created_at: $('#created_at').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.notification_system.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.notification_system.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.notification_system.search') }}",
            type: "GET",
            data: data,
            success: function (response) {
                $('#tableContainer').html(response.html);
                console.log(response);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endsection
