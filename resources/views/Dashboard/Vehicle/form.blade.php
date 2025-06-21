@extends('Dashboard.main')

@section('title', 'vehicle')
@section('content')

<style>
    #color {
        height: 40px;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Categories</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-vehicle">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.vehicle.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')




                <x-inputd type="text" value="{{ $vehicle->vehicle_number }}" name="vehicle_number" id="vehicle_number"
                    title="vehicle number" />

                <x-inputd type="color" value="{{ $vehicle->color }}" name="color" id="color" title="color" />

                <x-inputd value="{{ $vehicle->image }}" title="image" folder='vehicle' type="file" name="image">
                </x-inputd>



                <x-selectd type="text" value="{{ $vehicle->category->id }}" :array="$category" name="category"
                    id="category" title="category" />

                <x-selectd type="text" value="{{ $vehicle->vehicle_type->id }}" :array="$vehicle_type"
                    name="vehicle_type" id="vehicle_type" title="vehicle type" />

                <x-selectd type="text" value="{{ $vehicle->vehicle_brand->id }}" :array="$vehicle_brand"
                    name="vehicle_brand" id="vehicle_brand" title="vehicle brand" />

                <x-selectd type="text" value="{{ $vehicle->motor_type->id }}" :array="$motor_type" name="motor_type"
                    id="motor_type" title="motor type" />

                <div class="my-2">
                    <label for="">Vehicle Onr</label>

                    <select class="form-control mt-2" title="user" name="user" id="user" value="">

                        <option selected value="" style="color: gray">select
                        </option>
                        @foreach ($user as $item)
                        <option value="{{ $item->id }}" @if(old('user',$item->id)==$vehicle->user->id) selected
                            @endif>{{$item->first_name . ' ' .$item->second_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <x-inputd type="date" value="{{ $vehicle->date_start }}" name="date_start" id="date_start"
                    title="date of start" />

                <x-inputd type="date" value="{{ $vehicle->date_End }}" name="date_end" id="date_end"
                    title="date of end" />
                </td>






                {{-- <x-inputd value="{{ $vehicle->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-inputd> --}}

                {{-- <x-textarea value="{{ $vehicle->description }}" title="Description" name="description">
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
