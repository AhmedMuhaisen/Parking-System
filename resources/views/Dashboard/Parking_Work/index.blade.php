@section('title', 'Show parking_works')

@extends('Dashboard.main')
@section('content')
<main id="main" class="main position-absolute">
<style>
    th,td{
        max-width: 200px;
    }
</style>


    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>parking_works</h1>
            <a href="{{ route('Dashboard.parking_work.create') }}" class="btn btn-primary" style="
">add
                new parking_work</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All Parking Works</h>
                    @if ($page == 'index')
                    @can('parking_work.index')
                    <a href="{{ route('Dashboard.parking_work.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed parking_works</a>
                    @endcan
                    @else
                    @can('parking_work.index')
                    <a href="{{ route('Dashboard.parking_work.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All parking_works</a>
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

                            <th scope="col">icon</th>
                                <th scope="col">title</th>
                            <th scope="col" width="200">content</th>
    <th scope="col">step</th>

                            <th scope="col" width="120">Action</th>
                        </tr>


                              <tr>
      <td scope="col">
                                <x-input type="text" value="" name="icon" id="icon" title="search" />
                            </td>
                            <td scope="col">
                                <x-input type="text" value="" name="title" id="title" title="search" />
                            </td>

                                <td scope="col">
                                <x-input type="text" value="" name="content" id="content" title="search" />
                            </td>
                              <td scope="col">
                                <x-input type="text" value="" name="step" id="step" title="search" />
                            </td>

                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                 @include('Dashboard.Parking_Work.table', ['parking_work' => $parking_work, 'page' => $page])
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
        icon: $('#icon').val(),
          title: $('#title').val(),
        content: $('#content').val(),
        step: $('#step').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.parking_work.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.parking_work.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.parking_work.search') }}",
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
