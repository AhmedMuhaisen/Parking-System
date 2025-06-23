@section('title', 'Show roles')

@extends('Dashboard.main')
@section('content')
    <main id="main" class="main position-absolute">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>roles</h1>
                <a href="{{ route('Dashboard.role.create') }}"
                    style="
                        background: #4154f1;
                        color: white;
                        padding: 10px;
                        border: 2px solid white;
                        border-radius: 8px;
                    }
">add
                    new role</a>
            </div>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body right-thead">
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <h 5 class="card-title">show All Categoris</h>
                        @if ($page == 'index')
                            <a href="{{ route('Dashboard.role.trash') }}"
                                style="
                            background: #cb4f07;
                            color: white;
                            padding: 10px;
                            border: 2px solid white;
                            border-radius: 8px;">
                                <i class="fas fa-trash"></i>
                                Trashed roles</a>
                        @else
                            <a href="{{ route('Dashboard.role.index') }}"
                                style="
                            background: #0752cb;
                            color: white;
                            padding: 10px;
                            border: 2px solid white;
                            border-radius: 8px;">
                                <i class="fas fa-tag"></i>
                                All roles</a>
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
                                <th scope="col"  width="400">Permissions Number</th>
                                <th scope="col" width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @forelse ($role as $role)
                                <tr>


                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->permission->count() }}</td>


                                    <td>
                                        <div class="d-flex">
                                            <a
                                                href=@if ($page == 'trash') "{{ route('Dashboard.role.restore', $role->id) }}"
                                                 @else "{{ route('Dashboard.role.edit', $role->id) }}" @endif>

                                                <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif"
                                                    style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                            <form
                                                action="@if ($page == 'trash') {{ route('Dashboard.role.forcedelete', $role->id) }}@else{{ route('Dashboard.role.destroy', $role->id) }} @endif"
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
