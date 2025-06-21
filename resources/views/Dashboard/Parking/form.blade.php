@extends('Dashboard.main')

@section('title', 'parking')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>parkings</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-parking">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.parking.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $parking->name }}" title="Parking Name" type="text" name="name"></x-inputd>
    <div class="my-2">
                    <label for="">parking Onr</label>

                    <select class="form-control mt-2" title="user" name="user" id="user" value="">

                        <option selected value="" style="color: gray">select
                        </option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}" @if(old('user',$item->id)==$parking->user->id) selected
                            @endif>{{$item->first_name . ' ' .$item->second_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

      <x-inputd type="text" value="{{ $parking->max_buildings }}" name="max_buildings" id="max_buildings" title="max buildings" />
                                 <x-inputd type="text" value="{{ $parking->max_units }}" name="max_units" id="max_units" title="max units" />
                                 <x-inputd type="text" value="{{ $parking->max_gates }}" name="max_gates" id="max_gates" title="max gates" />
                                 <x-inputd type="text" value="{{ $parking->max_users }}" name="max_users" id="max_users" title="max users" />
                                 <x-inputd type="text" value="{{ $parking->max_vehicles }}" name="max_vehicles" id="max_vehicles" title="max vehicles" />
                                 <x-inputd type="text" value="{{ $parking->max_cameras }}" name="max_cameras" id="max_cameras" title="max cameras" />
                                 <x-inputd type="text" value="{{ $parking->max_spots }}" name="max_spots" id="max_spots" title="max spots" />
                                 <x-inputd type="text" value="{{ $parking->max_guests }}" name="max_guests" id="max_guests" title="max guests" />




                {{-- <x-inputd value="{{ $parking->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-inputd> --}}

                {{-- <x-textarea value="{{ $parking->description }}" title="Description" name="description">
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
