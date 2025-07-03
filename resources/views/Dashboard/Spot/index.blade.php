@section('title', 'Show spots')

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
            <h1>spots</h1>
            <a href="{{ route('Dashboard.spot.create') }}" class="btn btn-primary" style="
">add
                new spot</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All spots</h>
                    @if ($page == 'index')
                    @can('spot.index')
                    <a href="{{ route('Dashboard.spot.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed spots</a>
                    @endcan
                    @else
                    @can('spot.index')
                    <a href="{{ route('Dashboard.spot.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All spots</a>
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
                           <th scope="col"> Building</th>
                            <th scope="col"> Parking</th>
                            <th scope="col" width="120">Action</th>
                        </tr>
                        <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="name" id="name" title="search" />
                            </td>

                              <td scope="col" width="200">
                                <select class="form-control" title="search" name="type" id="type" value="">
                                    <option selected value="">search
                                    </option>
                                    <option value="Handicap">Handicap
                                    </option>
                                     <option value="Visitor">Visitor
                                    </option>
                                    <option value="Regular">Regular
                                    </option>

                                </select>
                            </td>

                                <td scope="col" width='200'>
                                <x-select type="text" value="" :array="$buildings" name="building" id="building"
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
                        @include('Dashboard.Spot.table', ['spot' => $spot, 'page' => $page])
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
        type: $('#type').val(),
        parking: $('#parking').val(),
        building: $('#building').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.spot.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.spot.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.spot.search') }}",
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
