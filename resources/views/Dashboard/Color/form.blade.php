@extends('Dashboard.main')

@section('title', 'color')
@section('content')


    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>colors</h1>
            </div>
        </div><!-- End Page Title -->

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body create-color">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">@yield('title_form')</h5>
                        <a class="color-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.color.index') }}"> Rol
                            Back</a>
                    </div>
                    <!-- General Form Elements -->
                    @yield('form')
                    <x-input value="{{ $color->name }}" title="color" type="text" name="color"></x-input>

                    <div class="mb-4 d-flex flex-wrap">



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
