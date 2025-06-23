@extends('Dashboard.main')

@section('title', 'spot')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>spots</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-spot">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.spot.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $spot->name }}" title="spot Name" type="text" name="name"></x-inputd>


               <div class="my-3">

                    <label for="" class="col-sm-2 col-form-label">
                        Type
                    </label>
                    <select class="form-control   @error('type')
    is-invalid
    @enderror"  title="type" name="type" id="type" value="">
                        <option selected value="" style="color: gray" >select
                        </option>
                        <option value="Handicap" @if(old('type',$spot->type)=='Handicap') selected
                            @endif>Handicap
                        </option>
                           <option value="Visitor" @if(old('type',$spot->type)=='Visitor') selected
                            @endif>Visitor
                        </option>
                            <option value="Regular" @if(old('type',$spot->type)=='Regular') selected
                            @endif>Regular
                        </option>

                    </select>
                       @error('type')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>


        <x-selectd type="text" value="{{ $spot->building->id }}" :array="$buildings" name="building"
                    id="building" title="building" />

                <x-selectd type="text" value="{{ $spot->building->parking->id }}" :array="$parkings" name="parking"
                    id="parking" title="parking" />
                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->

@endsection
