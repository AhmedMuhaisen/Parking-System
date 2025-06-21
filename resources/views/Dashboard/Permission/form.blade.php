@extends('Dashboard.main')

@section('title', 'permission')
@section('content')


    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>permissions</h1>
            </div>
        </div><!-- End Page Title -->

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body create-permission">
                    <div class="d-flex mt-2 justify-content-between align-items-center">
                        <h5 class="card-title">@yield('title_form')</h5>
                        <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.permission.index') }}"> Rol
                            Back</a>
                    </div>
                    <!-- General Form Elements -->
                    @yield('form')
                    <x-input value="{{ $permission->code }}" title="code" type="text" name="code"></x-input>
                    <x-textarea value="{{ $permission->description }}" title="Description" name="description"></x-textarea>
                    <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>

        </div>
        </section>

    </main><!-- End #main -->

@endsection
