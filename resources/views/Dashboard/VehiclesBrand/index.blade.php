@section('title', 'Show vehicles_Brands')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>vehicles Brands</h1>
            <a href="{{ route('Dashboard.vehiclesBrand.create') }}" class="btn btn-primary" style="
">add
                new vehicles Brand</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All vehicles Brands</h>
                    @if ($page == 'index')
                    @can('vehiclesBrand.index')
                    <a href="{{ route('Dashboard.vehiclesBrand.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed vehicles Brands</a>
                    @endcan
                    @else
                    @can('vehiclesBrand.index')
                    <a href="{{ route('Dashboard.vehiclesBrand.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All vehicles Brands</a>
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
                            <th scope="col" width='100'>created_at</th>
                            <th scope="col" width="120">Action</th>
                        </tr>


                              <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="name" id="name" title="search" />
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
                 @include('Dashboard.vehiclesBrand.table', ['vehiclesBrand' => $vehiclesBrand, 'page' => $page])
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
        created_at: $('#created_at').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehiclesBrand.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.vehiclesBrand.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.vehiclesBrand.search') }}",
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
