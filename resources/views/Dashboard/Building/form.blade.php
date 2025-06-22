@extends('Dashboard.main')

@section('title', 'building')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>buildings</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-building">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.building.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $building->name }}" title="building Name" type="text" name="name"></x-inputd>

                <x-inputd value="{{ $building->address }}" title="building address" type="text" name="address"></x-inputd>



                <div class="my-2">
                    <label for="">building Onr</label>

                    <select class="form-control mt-2     @error('user')
    is-invalid
    @enderror" title="user" name="user" id="user" value="">

                        <option selected value="" style="color: gray">select
                        </option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}" @if(old('user',$item->id)==$building->user->id) selected
                            @endif>{{$item->first_name . ' ' .$item->second_name }}
                        </option>
                        @endforeach
                    </select>   @error('user')
            <p class="text-danger">{{ $message }}</p>
        @enderror
                </div>



                <x-selectd type="text" value="{{ $building->parking->id }}" :array="$parkings" name="parking"
                    id="parking" title="parking" />

                                 <x-inputd type="text" value="{{ $building->max_units }}" name="max_units" id="max_units" title="max units" />

                                 <x-inputd type="text" value="{{ $building->max_users }}" name="max_users" id="max_users" title="max users" />
                                 <x-inputd type="text" value="{{ $building->max_vehicles }}" name="max_vehicles" id="max_vehicles" title="max vehicles" />

                                 <x-inputd type="text" value="{{ $building->max_spots }}" name="max_spots" id="max_spots" title="max spots" />
                                 <x-inputd type="text" value="{{ $building->max_guests }}" name="max_guests" id="max_guests" title="max guests" />




                {{-- <x-inputd value="{{ $building->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-inputd> --}}

                {{-- <x-textarea value="{{ $building->description }}" title="Description" name="description">
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
