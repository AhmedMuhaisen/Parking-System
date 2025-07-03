@section('title', 'Show target_audiences')

@extends('Dashboard.main')
@section('content')
    <main id="main" class="main position-absolute">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>target_audiences</h1>
                <a href="{{ route('Dashboard.target_audience.create') }}"
                    style="
                        background: #4154f1;
                        color: white;
                        padding: 10px;
                        border: 2px solid white;
                        border-radius: 8px;
                    }
">add
                    new target_audience</a>
            </div>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body right-thead">
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <h 5 class="card-title">show All Categoris</h>
                        @if ($page == 'index')
                            <a href="{{ route('Dashboard.target_audience.trash') }}"
                                style="
                            background: #cb4f07;
                            color: white;
                            padding: 10px;
                            border: 2px solid white;
                            border-radius: 8px;">
                                <i class="fas fa-trash"></i>
                                Trashed target_audiences</a>
                        @else
                            <a href="{{ route('Dashboard.target_audience.index') }}"
                                style="
                            background: #0752cb;
                            color: white;
                            padding: 10px;
                            border: 2px solid white;
                            border-radius: 8px;">
                                <i class="fas fa-tag"></i>
                                All target_audiences</a>
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
                            <input class="datatable-input" placeholder="Search..." type="search" name="search"
                                title="Search within table">
                        </div>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th scope="col" width="600">Name</th>
                                <th scope="col"  width="400">user Number</th>
                                <th scope="col" width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @forelse ($target_audience as $target_audience)
                                <tr>


                                    <td>{{ $target_audience->name }}</td>
                                    <td>{{ count(json_decode($target_audience->users, true)) }}</td>


                                    <td>
                                        <div class="d-flex">
                                            <a
                                                href=@if ($page == 'trash') "{{ route('Dashboard.target_audience.restore', $target_audience->id) }}"
                                                 @else "{{ route('Dashboard.target_audience.edit', $target_audience->id) }}" @endif>

                                                <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif"
                                                    style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                            <form
                                                action="@if ($page == 'trash') {{ route('Dashboard.target_audience.forcedelete', $target_audience->id) }}@else{{ route('Dashboard.target_audience.destroy', $target_audience->id) }} @endif"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button style="border: 0; background: none;"><i
                                                        class="@if ($page == 'trash') fa fa-close
                                                        @else fa fa-trash @endif"
                                                        style="    background: #c60707;
                                                                padding: 9px 10px;
                                                                color: white;
                                                                border-radius: 8px;">
                                                    </i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <p>لا يوجد بيانات</p>
                            @endforelse


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
