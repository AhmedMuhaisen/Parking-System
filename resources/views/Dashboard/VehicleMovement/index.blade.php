@section('title', 'Show Vehicles Movements')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main position-absolute">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Vehicles Movements</h1>
            <a href="{{ route('Dashboard.vehicleMovement.create') }}" class="btn btn-primary" style="
">add
                new vehicle</a>
        </div>
    </div><!-- End Page Title -->


    <style>
        table thead th,
        select ,input {
            min-width: 150px;
        }
    </style>
    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All Vehicles Movements</h>
                    @if ($page == 'index')
                    @can('vehicleMovement.index')
                    <a href="{{ route('Dashboard.vehicleMovement.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed Vehicles Movements</a>
                    @endcan
                    @else
                    @can('vehicleMovement.index')
                    <a href="{{ route('Dashboard.vehicleMovement.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All Vehicles Movements</a>
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

                            <th scope="col">Number</th>

                            <th scope="col">Onr Name</th>

                                <th scope="col">Gate</th>
                                   <th scope="col">Movement Type</th>
                                      <th scope="col">Open Method</th>

                                                     <th scope="col">Date</th>
   <th scope="col">Time</th>
                            <th scope="col" width="120">Action</th>
                        </tr>


                        <tr>

                            <td scope="col" colspan="1">
                                <x-input type="text" value="" name="vehicle_number" id="vehicle_number"
                                    title="search" />
                            </td>


      <td scope="col" >
                                <x-input type="text" value="" name="onr_name" id="onr_name" title="search" />
                            </td>




                                 <td scope="col" >
                                <x-select type="text" value="" :array="$gate" name="gate" id="gate"
                                    title="search" />
                            </td>


             <td scope="col" width="200">
                               <select class="form-select" title="search" name="movement_type" id="movement_type" value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="Exit">Exit
                                    </option>
                                    <option value="Enter">Enter
                                    </option>

                                </select>
                            </td>
                            <td scope="col">
                                <select class="form-select" title="search" name="open_method" id="open_method" value="">
                                    <option selected value="">search
                                    </option>
                                     <option value="manual">manual
                                    </option>
                                    <option value="automatic">automatic
                                    </option>

                                </select>

                            </td>



                            <td scope="col" >
                                <x-input type="date" value="" name="date" id="date" title="search" />
                            </td>

                                    <td scope="col" >
                                <x-input type="time" value="" name="time" id="time" title="search" />
                            </td>








                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col"  width="120"><button class="btn btn-primary"
                                    id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.vehicleMovement.table', ['vehicleMovement' => $vehicleMovement, 'page' => $page])
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
        onr_name: $('#onr_name').val(),
         gate: $('#gate').val(),
          movement_type: $('#movement_type').val(),
        open_method: $('#open_method').val(),
        date: $('#date').val(),
        time: $('#time').val(),

        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehicleMovement.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehicleMovement.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.vehicleMovement.search') }}",
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
