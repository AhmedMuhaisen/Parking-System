@extends('Dashboard.main')

@section('title', 'testimonial')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>testimonials</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-testimonial">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.testimonial.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $testimonial->rating }}" title="testimonial Rating" type="text" name="rating"></x-inputd>

                        <x-textarea value="{{ $testimonial->text }}" title="testimonial text" type="text" name="text"></x-textarea>


                <div class="my-2">
                    <label for="">testimonial Onr</label>

                    <select class="form-control mt-2   @error('user')
    is-invalid
    @enderror" title="user" name="user" id="user" value="">

                        <option selected value="" style="color: gray">select
                        </option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}" @if(old('user',$item->id)==$testimonial->user->id) selected
                            @endif>{{$item->first_name . ' ' .$item->second_name }}
                        </option>
                        @endforeach
                    </select>   @error('user')
            <p class="text-danger">{{ $message }}</p>
        @enderror

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
