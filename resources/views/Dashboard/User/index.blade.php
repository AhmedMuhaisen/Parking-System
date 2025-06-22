@section('title', 'Show users')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main position-absolute">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>users</h1>
            <a href="{{ route('Dashboard.user.create') }}" class="btn btn-primary" style="
">add
                new user</a>
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
                    <h 5 class="card-title">show All users</h>
                    @if ($page == 'index')
                    @can('user.index')
                    <a href="{{ route('Dashboard.user.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed users</a>
                    @endcan
                    @else
                    @can('user.index')
                    <a href="{{ route('Dashboard.user.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All users</a>
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
                            <th scope="col">date birth</th>
                            <th scope="col" width="200">Image</th>
                            <th scope="col">phone</th>
                              <th scope="col">email</th>
                            <th scope="col">Type</th>
                              <th scope="col">Unit</th>
                            <th scope="col">Building</th>
                            <th scope="col">Cars</th>
                            <th scope="col">verified</th>
                            <th scope="col" width='100'>created_at</th>
                            <th scope="col" width="120">Action</th>
                        </tr>

                        <tr>
                            <td scope="col" colspan="1" width='200'>
                                <x-input type="text" value="" name="name" id="name"
                                    title="search" />
                            </td>

                                <td scope="col" colspan="2" width='200'>
                                <x-input type="date" value="" name="date_birth" id="date_birth" title="search" />
                            </td>

                                    <td scope="col" colspan="1" width='200'>
                                <x-input type="text" value="" name="phone" id="phone"
                                    title="search" />
                            </td>


                                    <td scope="col" colspan="1" width='200'>
                                <x-input type="email" value="" name="email" id="email"
                                    title="search" />
                            </td>


  <td scope="col">
                                <select class="form-control" title="search" name="type" id="type" value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="user">user
                                    </option>
                                    <option value="admin">admin
                                    </option>

                                </select>

                            </td>


                            <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$unit" name="unit" id="unit" title="search" />
                            </td>


                            <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$building" name="building" id="building"
                                    title="search" />
                            </td>


     <td scope="col" colspan="1" width='200'>
                                <x-input type="text" value="" name="vehicles_count" id="vehicles_count"
                                    title="search" />
                            </td>

  <td scope="col">
                                <select class="form-control" title="search" name="verified" id="verified" value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="Deactivated">Deactivated
                                    </option>
                                    <option value="Activated">Activated
                                    </option>

                                </select>

                            </td>
                            <td scope="col" width='200' width='100'>
                                <x-input type="date" value="" title="search" name="created_at" id="created_at" />
                            </td>
                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width='200' width="120"><button class="btn btn-primary"
                                    id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.User.table', ['user' => $user, 'page' => $page])
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
        date_birth: $('#date_birth').val(),
         phone: $('#phone').val(),
          email: $('#email').val(),
        type: $('#type').val(),
        building: $('#building').val(),
        unit: $('#unit').val(),
          verified: $('#verified').val(),
        vehicles_count: $('#vehicles_count').val(),
        created_at: $('#created_at').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.user.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.user.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.user.search') }}",
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
