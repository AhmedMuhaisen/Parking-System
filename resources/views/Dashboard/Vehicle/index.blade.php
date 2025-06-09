@section('title', 'Show Vehicles')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main position-absolute">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Vehicles</h1>
            <a href="{{ route('Dashboard.vehicle.create') }}" class="btn btn-primary" style="
">add
                new vehicle</a>
        </div>
    </div><!-- End Page Title -->


    <style>
table thead th ,select{
  min-width: 120px;
}

    </style>
    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All Vehicles</h>
                    @if ($page == 'index')
                    @can('vehicle.index')
                    <a href="{{ route('Dashboard.vehicle.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed Vehicles</a>
                    @endcan
                    @else
                    @can('vehicle.index')
                    <a href="{{ route('Dashboard.vehicle.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All Vehicles</a>
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
                        <a class="btn btn-dark" href=""  id="printExcelReport">Export Excel</a>
                        <a class="btn btn-danger" id="printPdfReport" href="">Export
                            Pdf</a>
                    </div>
                </div>

                <!-- Table with stripped rows -->
   <table class="table table-striped">

                    <thead>
                        <tr>

                            <th scope="col">Number</th>
                            <th scope="col">Color</th>
                            <th scope="col" width="200">Image</th>
                            <th scope="col" >Category</th>
                            <th scope="col">Type</th>
                            <th scope="col" >Brand</th>

                               <th scope="col" >Motor</th>
                                     <th scope="col">Onr Name</th>
                                   <th scope="col" width="200">Date Start</th>

                                    <th scope="col" width="200">Date End</th>

                            <th scope="col" width='100'>created_at</th>
                            <th scope="col" width="120">Action</th>
                        </tr>


                              <tr>

                            <td scope="col" colspan="3" width='200'>
                                <x-input type="text" value="" name="vehicle_number" id="vehicle_number" title="search" />
                            </td>



                               <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$category" name="category" id="category" title="search" />
                            </td>
                             <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$vehicle_type" name="vehicle_type" id="vehicle_type" title="search" />
                            </td>
                             <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$vehicle_brand" name="vehicle_brand" id="vehicle_brand" title="search" />
                            </td>
                             <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$motor_type" name="motor_type" id="motor_type" title="search" />
                            </td>
                                      <td scope="col" width='200'>
                                <x-input type="text" value=""  name="onr_name" id="onr_name" title="search" />
                            </td>
                             <td scope="col" width='200'>
                                <x-input type="date" value=""  name="date_start" id="date_start" title="search" />
                            </td>
                             <td scope="col" width='200'>
                                <x-input type="date" value=""  name="date_end" id="date_end" title="search" />
                            </td>



                            <td scope="col" width='200' width='100'>
                                <x-input type="date" value="" title="search" name="created_at" id="created_at" />
                            </td>
                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width='200' width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                 @include('Dashboard.vehicle.table', ['vehicle' => $vehicle, 'page' => $page])
                    </tbody>
                </table>




                </tbody>
                </table>
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
        vehicle_number: $('#vehicle_number').val(),
        category: $('#category').val(),
        vehicle_type: $('#vehicle_type').val(),
        vehicle_brand: $('#vehicle_brand').val(),
        motor_type: $('#motor_type').val(),
        onr_name: $('#onr_name').val(),
        date_start: $('#date_start').val(),
       date_end: $('#date_end').val(),
        created_at: $('#created_at').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehicle.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehicle.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.vehicle.search') }}",
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
