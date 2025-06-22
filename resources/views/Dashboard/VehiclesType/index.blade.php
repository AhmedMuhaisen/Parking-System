@section('title', 'Show Vehicles_types')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>vehicles_types</h1>
            <a href="{{ route('Dashboard.vehiclesType.create') }}" class="btn btn-primary" style="
">add
                new vehiclesType</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All vehicles_types</h>
                    @if ($page == 'index')
                    @can('vehiclesType.index')
                    <a href="{{ route('Dashboard.vehiclesType.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed vehicles_types</a>
                    @endcan
                    @else
                    @can('vehiclesType.index')
                    <a href="{{ route('Dashboard.vehiclesType.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All vehicles_types</a>
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

                            <th scope="col">Name</th>
                                <th scope="col">number of vehicles</th>
                            <th scope="col" width='100'>created_at</th>
                            <th scope="col" width="120">Action</th>
                        </tr>


                              <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="name" id="name" title="search" />
                            </td>

 <td scope="col" width='100'>
                                <x-input type="text" value="" title="vehicles number" name="vehicles_number" id="vehicles_number" />
                            </td>
                            <td scope="col" width='100'>
                                <x-input type="date" value="" title="search" name="created_at" id="created_at" />
                            </td>
                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                 @include('Dashboard.VehiclesType.table', ['vehiclesType' => $vehiclesType, 'page' => $page])
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
         vehicles_number: $('#vehicles_number').val(),
        created_at: $('#created_at').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehiclesType.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehiclesType.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.vehiclesType.search') }}",
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
