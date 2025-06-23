@section('title', 'Show Gates')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main position-absolute">
    <style>
        th,
        td {
            max-width: 200px;
        }
    </style>


    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Gates</h1>
            <a href="{{ route('Dashboard.gate.create') }}" class="btn btn-primary" style="
">add
                new gate</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All Gates</h>
                    @if ($page == 'index')
                    @can('gate.index')
                    <a href="{{ route('Dashboard.gate.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed Gates</a>
                    @endcan
                    @else
                    @can('gate.index')
                    <a href="{{ route('Dashboard.gate.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All Gates</a>
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
                            <th scope="col" width="200">Address</th>
                            <th scope="col"> Parking</th>
                            <th scope="col" width="200">type</th>

                            <th scope="col" width="200">open_method</th>
                            <th scope="col">status</th>

                            <th scope="col" width="120">Action</th>
                        </tr>


                        <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="name" id="name" title="search" />
                            </td>
                            <td scope="col">
                                <x-input type="text" value="" name="address" id="address" title="search" />
                            </td>

                                     <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$parkings" name="parking" id="parking"
                                    title="search" />
                            </td>


                            <td scope="col" width="200">
                                <select class="form-control" title="search" name="type" id="type" value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="Entrance">Entrance
                                    </option>
                                    <option value="Exit">Exit
                                    </option>

                                </select>
                            </td>

                            <td scope="col" width="200">
                                <select class="form-control" title="search" name="open_method" id="open_method"
                                    value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="manual">manual
                                    </option>
                                    <option value="automatic">automatic
                                    </option>

                                </select>
                            </td>
                            <td scope="col">
                                <select class="form-control" title="search" name="status" id="status" value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="active">active
                                    </option>
                                    <option value="in_active">in_active
                                    </option>

                                </select>

                            </td>

                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.Gate.table', ['gate' => $gate, 'page' => $page])
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
        status: $('#status').val(),
        type: $('#type').val(),
        parking: $('#parking').val(),
        open_method: $('#open_method').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.gate.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.gate.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.gate.search') }}",
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
