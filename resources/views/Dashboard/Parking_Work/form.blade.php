@extends('Dashboard.main')

@section('title', 'parking_work')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>parking_works</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-parking_work">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.parking_work.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $parking_work->icon }}" title="icon" type="text" name="icon"></x-inputd>
        <x-inputd value="{{ $parking_work->title }}" title="title" type="text" name="title"></x-inputd>
                <x-inputd value="{{ $parking_work->step }}" title="step_number" type="number" name="step"></x-inputd>

   <x-textarea value="{{ $parking_work->content }}" title="content" name="content"></x-textarea>



                {{-- <x-input value="{{ $parking_work->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-input> --}}

                {{-- <x-textarea value="{{ $parking_work->description }}" title="Description" name="description">
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
