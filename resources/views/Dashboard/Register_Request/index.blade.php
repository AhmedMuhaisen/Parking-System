@section('title', 'Show register_requests')

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
            <h1>register_requests</h1>
            <a href="{{ route('Dashboard.register_request.create') }}" class="btn btn-primary" style="
">add
                new register_request</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All register_requests</h>
                    @if ($page == 'index')
                    @can('register_request.index')
                    <a href="{{ route('Dashboard.register_request.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed register_requests</a>
                    @endcan
                    @else
                    @can('register_request.index')
                    <a href="{{ route('Dashboard.register_request.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All register_requests</a>
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

                            <th scope="col" width="600">Email</th>
                            <th scope="col" width="300"> date</th>
                            <th scope="col" width="120">Action</th>
                        </tr>
                        <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="email" id="email" title="search" />
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
                        @include('Dashboard.Register_Request.table', ['register_request' => $register_request, 'page' => $page])
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
        email: $('#email').val(),
        created_at: $('#created_at').val(),
        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.register_request.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.register_request.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.register_request.search') }}",
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
