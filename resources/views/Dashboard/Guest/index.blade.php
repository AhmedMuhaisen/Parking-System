@section('title', 'Show guests')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main position-absolute">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>guests</h1>
            <a href="{{ route('Dashboard.guest.create') }}" class="btn btn-primary" style="
">add
                new guest</a>
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
                    <h 5 class="card-title">show All guests</h>
                    @if ($page == 'index')
                    @can('guest.index')
                    <a href="{{ route('Dashboard.guest.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed guests</a>
                    @endcan
                    @else
                    @can('guest.index')
                    <a href="{{ route('Dashboard.guest.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All guests</a>
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
                            <th scope="col">vehicle_number</th>
                            <th scope="col">login_date</th>
                            <th scope="col">login_time</th>
                            <th scope="col">logout_date</th>
                            <th scope="col">logout_time</th>
                            <th scope="col">Type</th>
                            <th scope="col">time_remaining</th>
                            <th scope="col">Note</th>
                            <th scope="col">number_visits</th>
                            <th scope="col" width="200">Onr</th>
                            <th scope="col" width="120">Action</th>
                        </tr>


                        <tr>
                            <td scope="col" colspan="1" width='200'>
                                <x-input type="text" value="" name="name" id="name" title="search" />
                            </td>
                            <td scope="col" colspan="1" width='200'>
                                <x-input type="text" value="" name="vehicle_number" id="vehicle_number"
                                    title="search" />
                            </td>
                            <td scope="col" width='200'>
                                <x-input type="date" value="" name="login_date" id="login_date" title="search" />
                            </td>
                            <td scope="col" width='200'>
                                <x-input type="time" value="" name="login_time" id="login_time" title="search" />
                            </td>
                            <td scope="col" width='200'>
                                <x-input type="date" value="" name="logout_date" id="logout_date" title="search" />
                            </td>
                            <td scope="col" width='200'>
                                <x-input type="time" value="" name="logout_time" id="logout_time" title="search" />
                            </td>
                            <td scope="col" width="200">
                                <select class="form-control" title="search" name="type" id="type" value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="Accepted">Accepted
                                    </option>
                                    <option value="Rejected">Rejected
                                    </option>
                                    <option value="Expired">Expired
                                    </option>

                                </select>
                            </td>

                            <td scope="col" width='200' width='100'>
                                <x-input type="time" value="" title="search" name="time_remaining"
                                    id="time_remaining" />
                            </td>

                        <td>    <x-input type="text" value="" name="notes" id="notes" title="search" /></td>

                       <td>     <x-input type="text" value="" name="number_visits" id="number_visits" title="search" /></td>


                            <td scope="col" width='200'>
                                <x-input type="text" value="" name="user" id="user" title="search" />
                            </td>



                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width='200' width="120"><button class="btn btn-primary"
                                    id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.guest.table', ['guest' => $guest, 'page' => $page])
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
        name: $('name').val(),
        user: $('user').val(),
         type: $('type').val(),
          vehicle_number: $('vehicle_number').val(),
        login_date: $('login_date').val(),
        login_time: $('login_time').val(),
        logout_date: $('logout_date').val(),
        logout_time: $('logout_time').val(),
        time_remaining: $('time_remaining').val(),
       number_visits: $('number_visits').val(),
      notes: $('notes').val(),
        page: $('page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.guest.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.guest.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.guest.search') }}",
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
