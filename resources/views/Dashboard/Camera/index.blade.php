@section('title', 'Show cameras')

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
            <h1>cameras</h1>
            <a href="{{ route('Dashboard.camera.create') }}" class="btn btn-primary" style="
">add
                new camera</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All cameras</h>
                    @if ($page == 'index')
                    @can('camera.index')
                    <a href="{{ route('Dashboard.camera.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed cameras</a>
                    @endcan
                    @else
                    @can('camera.index')
                    <a href="{{ route('Dashboard.camera.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All cameras</a>
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

                            <th scope="col" width='600'>Name</th>
                           <th scope="col"> gate</th>
                            <th scope="col"> Parking</th>
                            <th scope="col" width="120">Action</th>
                        </tr>
                        <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="name" id="name" title="search" />
                            </td>

                            <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$gates" name="gate" id="gate"
                                    title="search" />
                            </td>

                            <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$parkings" name="parking" id="parking"
                                    title="search" />
                            </td>


                            </td>

                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.Camera.table', ['camera' => $camera, 'page' => $page])
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
        parking: $('#parking').val(),
        gate: $('#gate').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.camera.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.camera.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.camera.search') }}",
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
