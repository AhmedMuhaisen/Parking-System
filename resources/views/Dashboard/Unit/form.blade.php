@extends('Dashboard.main')

@section('title', 'unit')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>units</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-unit">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.unit.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $unit->name }}" title="unit Name" type="text" name="name"></x-inputd>


                <div class="my-2">
                    <label for="">unit Onr</label>

                    <select class="form-control mt-2   @error('user')
    is-invalid
    @enderror" title="user" name="user" id="user" value="">

                        <option selected value="" style="color: gray">select
                        </option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}" @if(old('user',$item->id)==$unit->user->id) selected
                            @endif>{{$item->first_name . ' ' .$item->second_name }}
                        </option>
                        @endforeach
                    </select>   @error('user')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>

        <x-selectd type="text" value="{{ $unit->building->id }}" :array="$buildings" name="building"
                    id="building" title="building" />

                <x-selectd type="text" value="{{ $unit->building->parking->id }}" :array="$parkings" name="parking"
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
