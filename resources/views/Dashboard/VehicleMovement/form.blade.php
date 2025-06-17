@extends('Dashboard.main')

@section('title', 'vehicleMovement')
@section('content')

<style>
    #color{
        height: 40px;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>vehicles Movements</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-vehicleMovement">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.vehicleMovement.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')




                <x-inputd type="text" value="{{ $vehicleMovement->vehicleMovement_number }}" name="vehicleMovement_number" id="vehicleMovement_number"
                    title="vehicleMovement number" />


                <x-inputd value="{{ $vehicleMovement->image }}" title="image" folder='vehicleMovement' type="file" name="image">
                </x-inputd>



                <x-selectd type="text" value="{{ $vehicleMovement->category->id }}" :array="$category" name="category"
                    id="category" title="category" />

                <x-selectd type="text" value="{{ $vehicleMovement->vehicleMovement_type->id }}" :array="$vehicleMovement_type"
                    name="vehicleMovement_type" id="vehicleMovement_type" title="vehicleMovement type" />



<label for="">VehicleMovement Onr</label>

                <select class="form-control mt-2" title="user" name="user" id="user" value="">

                    <option selected value="" style="color: gray">select
                    </option>
                    @foreach ($user as $item)
                    <option value="{{ $item->id }}" @if(old('user',$item->id)==$vehicleMovement->user->id) selected
                        @endif>{{$item->first_name . ' ' .$item->second_name }}
                    </option>
                    @endforeach
                </select>
</div>

                <x-inputd type="date" value="{{ $vehicleMovement->login_date }}" name="login_date" id="login_date"
                    title="date of start" />
            <x-inputd type="date" value="{{ $vehicleMovement->date_start }}" name="date_start" id="date_start"
                    title="date of start" />

                <x-inputd type="date" value="{{ $vehicleMovement->date_End }}" name="date_end" id="date_end"
                    title="date of end" />
                </td>
            <x-inputd type="date" value="{{ $vehicleMovement->date_start }}" name="date_start" id="date_start"
                    title="date of start" />





                {{-- <x-inputd value="{{ $vehicleMovement->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-inputd> --}}

                {{-- <x-textarea value="{{ $vehicleMovement->description }}" title="Description" name="description">
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
