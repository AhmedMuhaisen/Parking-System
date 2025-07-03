@section('title', 'Show parkings')

@extends('Dashboard.main')
@section('content')


    <style>
        table thead th,
        select {
            min-width: 140px;
        }
    </style>
<main id="main" class="main position-absolute">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>parkings</h1>
            <a href="{{ route('Dashboard.parking.create') }}" class="btn btn-primary" style="
">add
                new parking</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All Parkings</h>
                    @if ($page == 'index')
                    @can('parking.index')
                    <a href="{{ route('Dashboard.parking.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed parkings</a>
                    @endcan
                    @else
                    @can('parking.index')
                    <a href="{{ route('Dashboard.parking.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All parkings</a>
                    @endcan
                    @endif

                </div>

                <div class="datatable-top">

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

                            <th scope="col">Name</th>
                            <th scope="col" width="200">Onr Name</th>
                               <th scope="col"> # Buildings</th>
                            <th scope="col"> # Units</th>
                            <th scope="col"> # gests</th>
                            <th scope="col"> # Users</th>
                            <th scope="col"> # Vehicles</th>
                            <th scope="col"> # cameras</th>
                            <th scope="col"> # Spots</th>
                            <th scope="col"> # guests</th>
                            <th scope="col">Max Buildings</th>
                            <th scope="col">Max Units</th>
                            <th scope="col">Max gests</th>
                            <th scope="col">Max Users</th>
                            <th scope="col">Max Vehicles</th>
                            <th scope="col">Max cameras</th>
                            <th scope="col">Max Spots</th>
                            <th scope="col">Max guests</th>

                            <th scope="col" width="120">Action</th>
                        </tr>


                        <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="name" id="name" title="search" />
                            </td>
                            <td scope="col">
                                <x-input type="text" value="" name="user" id="user" title="search" />
                            </td>

                            <td scope="col">
                                <x-input type="text" value="" name="buildings_number" id="buildings_number"
                                    title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="units_number" id="units_number" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="gates_number" id="gates_number" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="users_number" id="users_number" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="vehicles_number" id="vehicles_number"
                                    title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="cameras_number" id="cameras_number"
                                    title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="spots_number" id="spots_number" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="guests_number" id="guests_number" title="search" /></td>

                                <td scope="col"> <x-input type="text" value="" name="max_buildings" id="max_buildings" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_units" id="max_units" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_gates" id="max_gates" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_users" id="max_users" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_vehicles" id="max_vehicles" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_cameras" id="max_cameras" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_spots" id="max_spots" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_guests" id="max_guests" title="search" /></td>


                            </td>

                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.Parking.table', ['parking' => $parking, 'page' => $page])
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
        name: $('#name').val(),
        status: $('#status').val(),
        work_method: $('#work_method').val(),
        created_at: $('#created_at').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.parking.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.parking.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.parking.search') }}",
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
