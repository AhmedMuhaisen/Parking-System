@extends('Dashboard.main')

@section('title', 'guest')
@section('content')

<style>
    #color {
        height: 40px;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Guests</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-guest">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.guest.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')


                <x-inputd type="text" value="{{ $guest->name }}" name="name" id="name" title="Name" />


                <x-inputd type="text" value="{{ $guest->vehicle_number }}" name="vehicle_number" id="vehicle_number"
                    title="vehicle number" />

                <x-inputd type="date" value="{{ $guest->login_date }}" name="login_date" id="login_date"
                    title="login_date" />

                <x-inputd type="time" value="{{ $guest->login_time }}" name="login_time" id="login_time"
                    title="login_time" />

                <x-inputd type="date" value="{{ $guest->logout_date }}" name="logout_date" id="logout_date"
                    title="logout_date" />

                <x-inputd type="time" value="{{ $guest->logout_time }}" name="logout_time" id="logout_time"
                    title="logout_time" />



                <div class="my-3">

                    <label for="" class="col-sm-2 col-form-label">
                        Type
                    </label>
                    <select class="form-control   @error('type')
    is-invalid
    @enderror" title="type" name="type" id="type" value="">
                        <option selected value="" style="color: gray">select
                        </option>
                        <option value="Accepted" @if(old('type',$guest->type)=='Accepted') selected
                            @endif>Accepted
                        </option>
                        <option value="Rejected" @if(old('type',$guest->type)=='Rejected') selected
                            @endif>Rejected
                        </option>
                        <option value="Expired" @if(old('type',$guest->type)=='Expired') selected
                            @endif>Expired
                        </option>

                    </select>
                    @error('type')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>

                <x-inputd type="time" value="{{ $guest->time_remaining }}" name="time_remaining" id="time_remaining"
                    title="time_remaining" />

                <x-textarea value="{{ old('notes',$guest->notes) }}" title="notes" name="notes"></x-textarea>



                <label for="">guest Onr</label>

                <select class="form-control mt-2   @error('user')
    is-invalid
    @enderror" title="user" name="user" id="user" value="">

                    <option selected value="" style="color: gray">select
                    </option>
                    @foreach ($user as $item)
                    <option value="{{ $item->id }}" @if(old('user',$item->id)==$guest->user->id) selected
                        @endif>{{$item->first_name . ' ' .$item->second_name }}
                    </option>
                    @endforeach
                </select> @error('user')
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
