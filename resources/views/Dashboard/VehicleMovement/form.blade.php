@extends('Dashboard.main')

@section('title', 'vehicleMovement')
@section('content')

<style>
    #color {
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
                    <a class="role-back btn btn-primary w-20 h-75"
                        href="{{ route('Dashboard.vehicleMovement.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')




                    <div class="my-2">
<label for="">Vehicle Number</label>

                <select class="form-control mt-2   @error('vehicle_number')
    is-invalid
    @enderror" title="vehicle_number" name="vehicle_number" id="vehicle_number" value="">

                    <option selected value="" disabled hidden style="color: gray">select
                    </option>
                    @foreach ($vehicles as $item)
                    <option value="{{ $item->id }}" @if(old('vehicle_number',$item->id)==$vehicleMovement->vehicle->id) selected
                        @endif>{{$item->vehicle_number}}
                    </option>
                    @endforeach
                </select>   @error('vehicle_number')
            <p class="text-danger">{{ $message }}</p>
        @enderror

</div>



                <x-selectd type="text" value="{{ $vehicleMovement->gate->id }}" :array="$gate" name="gate" id="gate"
                    title="gate" />



 <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        Method Of Passing
                    </label>
                    <select class="form-control   @error('method_passage')
    is-invalid
    @enderror"  title="method_passage" name="method_passage" id="method_passage" value="">
                        <option selected disabled hidden value="" style="color: gray" >select
                        </option>
                        <option value="Manual" @if(old('method_passage',$vehicleMovement->method_passage)=='Manual') selected
                            @endif>Manual
                        </option>
                        <option value="Automatic" @if(old('method_passage',$vehicleMovement->method_passage)=='Automatic') selected
                            @endif>Automatic
                        </option>

                    </select>   @error('method_passage')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>
                <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                         movement type
                     </label>
                    <select class="form-control   @error('type_movement')
    is-invalid
    @enderror" title="type_movement" name="type_movement" id="type_movement" value="">
                        <option selected disabled hidden value="">select
                        </option>
                        <option value="Entry" @if(old('type_movement',$vehicleMovement->type_Movement)=='Entry') selected @endif>Entry
                        </option>
                        <option value="Exit" @if(old('type_movement',$vehicleMovement->type_Movement)=='Exit') selected
                            @endif>Exit
                        </option>

                    </select>
   @error('type_movement')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>



                <x-inputd type="date" value="{{ $vehicleMovement->date }}" name="date" id="date"
                    title="date" />

                     <x-inputd type="time" value="{{ $vehicleMovement->time }}" name="time" id="time"
                    title="time" />

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
