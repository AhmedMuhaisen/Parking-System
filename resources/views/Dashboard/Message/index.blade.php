@section('title', 'Show messages')

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
            <h1>messages</h1>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body right-thead">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h 5 class="card-title">show All messages</h>
                    @if ($page == 'index')
                    @can('message.index')
                    <a href="{{ route('Dashboard.message.trash') }}" class="btn btn-outline-danger" style="
                                  ">
                        <i class="fas fa-trash"></i>
                        Trashed messages</a>
                    @endcan
                    @else
                    @can('message.index')
                    <a href="{{ route('Dashboard.message.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i>
                        All messages</a>
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

                            <th scope="col" width='600'>Email</th>
                           <th scope="col"> Subject</th>
                            <th scope="col"> Message</th>
                            <th>created_at</th>
                            <th scope="col" width="120">Action</th>
                        </tr>
                        <tr>

                            <td scope="col">
                                <x-input type="text" value="" name="email" id="email" title="search" />
                            </td>

         <td scope="col">
                                <x-input type="text" value="" name="subject" id="subject" title="search" />
                            </td>

                                     <td scope="col">
                                <x-input type="text" value="" name="message" id="message" title="search" />
                            </td>


      <td scope="col">
                                <x-input type="text" value="" name="created_at" id="created_at" title="search" />
                            </td>


                            <input type="hidden" name="page" id="page" value="{{ $page }}">

                            <td scope="col" width="120"><button class="btn btn-primary" id="searchBtn">Search</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tableContainer">
                        @include('Dashboard.Message.table', ['message' => $message, 'page' => $page])
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
        subject: $('#subject').val(),
        message: $('#message').val(),
        created_at: $('#created_at').val(),

        page: $('#page').val()
    };
    }

$('#printExcelReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.message.exportExcel') }}?" + query, '_blank');
});


$('#printPdfReport').on('click', function () {
    let query = $.param(datavalue());
    // فتح رابط الطباعة مع تمرير الفلاتر
    window.open("{{ route('Dashboard.message.exportPDF') }}?" + query, '_blank');
});





    $('#searchBtn').on('click', function () {
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.message.search') }}",
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
