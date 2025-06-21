@extends('Dashboard.main')

@section('title', 'role')
@section('content')


    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>roles</h1>
            </div>
        </div><!-- End Page Title -->

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body create-role">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">@yield('title_form')</h5>
                        <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.role.index') }}"> Rol
                            Back</a>
                    </div>
                    <!-- General Form Elements -->
                    @yield('form')
                    <x-input value="{{ $role->name }}" title="name" type="text" name="name"></x-input>

                    <div class="mb-4 d-flex flex-wrap">



                        @foreach ($permission as $item)
                            <div class="p-3 m-1 d-flex" style="border: 1px solid #0d6efd ; width: 32.4%;">
                                <p class="w-100 mb-0">{{ $item->code }}</p>

                                <div class=" form-check d-flex flex-row-reverse" style="">
                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                        value="{{ $item->id }}" @checked(in_array($item->id, $role->permission->pluck('id')->toArray()))>

                                </div>

                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>

        </div>
        </section>

    </main><!-- End #main -->

@endsection
