@section('title', 'Show buildings')

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
            <h1>buildings</h1>
            <a href="{{ route('Dashboard.building.create') }}" class="btn btn-primary" style="
">add
                new building</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All Categoris</h>
                    @if ($page == 'index')
                    @can('building.index')
                    <a href="{{ route('Dashboard.building.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed buildings</a>
                    @endcan
                    @else
                    @can('building.index')
                    <a href="{{ route('Dashboard.building.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All buildings</a>
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

                            <th scope="col">Name</th>
                            <th scope="col">Address</th>

                            <th scope="col" width="200">Onr Name</th>
                               <th scope="col"> Parking</th>
                            <th scope="col"> # Units</th>

                            <th scope="col"> # Users</th>
                            <th scope="col"> # Vehicles</th>

                            <th scope="col"> # Spots</th>
                            <th scope="col"> # guests</th>

                            <th scope="col">Max Units</th>

                            <th scope="col">Max Users</th>
                            <th scope="col">Max Vehicles</th>

                            <th scope="col">Max Spots</th>
                            <th scope="col">Max guests</th>

                            <th scope="col" width="120">Action</th>
                        </tr>


                        <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="name" id="name" title="search" />
                            </td>
                               <td scope="col">
                                <x-input type="text" value="" name="address" id="address" title="search" />
                            </td>
                            <td scope="col">
                                <x-input type="text" value="" name="user" id="user" title="search" />
                            </td>

                                  <td scope="col">
                                <x-input type="text" value="" name="parking" id="parking" title="search" />
                            </td>


                                <td scope="col"> <x-input type="text" value="" name="units_number" id="units_number" title="search" /></td>

                                <td scope="col"> <x-input type="text" value="" name="users_number" id="users_number" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="vehicles_number" id="vehicles_number"
                                    title="search" /></td>

                                <td scope="col"> <x-input type="text" value="" name="spots_number" id="spots_number" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="guests_number" id="guests_number" title="search" /></td>


                                <td scope="col"> <x-input type="text" value="" name="max_units" id="max_units" title="search" /></td>

                                <td scope="col"> <x-input type="text" value="" name="max_users" id="max_users" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_vehicles" id="max_vehicles" title="search" /></td>

                                <td scope="col"> <x-input type="text" value="" name="max_spots" id="max_spots" title="search" /></td>
                                <td scope="col"> <x-input type="text" value="" name="max_guests" id="max_guests" title="search" /></td>


                            </td>

                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.Building.table', ['building' => $building, 'page' => $page])
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
        address: $('#address').val(),

        user: $('#user').val(),
        parking: $('#parking').val(),
        units_number: $('units_number').val(),
        users_number: $('users_number').val(),
        vehicles_number: $('vehicles_number').val(),
        spots_number: $('spots_number').val(),
        guests_number: $('guests_number').val(),
        max_units: $('max_units').val(),
        max_users: $('max_users').val(),
        max_vehicles: $('max_vehicles').val(),
        max_spots: $('max_spots').val(),
        max_guests: $('max_guests').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.building.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.building.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.building.search') }}",
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
