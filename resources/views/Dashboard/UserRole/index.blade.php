@section('title', 'Show roles')

@extends('Dashboard.main')
@section('content')
    <main id="main" class="main position-absolute">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>roles</h1>
                <a href="{{ route('Dashboard.user_role.create') }}"
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
                        <h5 class="card-title">show All Role_Users</h5>

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

                                <th scope="col">user</th>
                                <th scope="col">role</th>
                                <th scope="col" width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @forelse ($user as $user)
                                <tr>


                                    <td>{{  $user->first_name .' '.$user->second_name}}</td>
                                    <td>{{ $user->role->name }}</td>


                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('Dashboard.user_role.edit', $user->id) }}">

                                                <i class="fa fa-pencil"
                                                    style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                            <form action="{{ route('Dashboard.user_role.destroy', $user->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button style="border: 0; background: none;"><i class="fa fa-trash"
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
