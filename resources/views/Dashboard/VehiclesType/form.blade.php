@extends('Dashboard.main')

@section('title', 'vehiclesType')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Categories</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-vehiclesType">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.vehiclesType.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $vehiclesType->name }}" title="Name" type="text" name="name"></x-inputd>






                {{-- <x-input value="{{ $vehiclesType->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-input> --}}

                {{-- <x-textarea value="{{ $vehiclesType->description }}" title="Description" name="description">
                </x-textarea> --}}
                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->

@endsection
