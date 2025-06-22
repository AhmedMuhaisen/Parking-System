@extends('Dashboard.main')

@section('title', 'user')
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
            <div class="card-body create-user">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.user.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')


                <x-inputd type="text" value="{{ $user->first_name }}" name="first_name" id="first_name"
                    title="first_name" />


                <x-inputd type="text" value="{{ $user->second_name }}" name="second_name" id="second_name"
                    title="second_name" />

                <x-inputd type="date" value="{{ $user->date_birth }}" name="date_birth" id="date_birth"
                    title="date of birth" />


                <x-inputd value="{{ $user->image }}" title="image" folder='user' type="file" name="image">
                </x-inputd>

                       <x-inputd type="text" value="{{ $user->phone }}" name="phone" id="phone"
                    title="phone" />


                           <x-inputd type="email" value="{{ $user->email }}" name="email" id="email"
                    title="email" />


                <x-selectd type="text" value="{{ $user->building->id }}" :array="$building" name="building"
                    id="building" title="building" />


                      <x-selectd type="text" value="{{ $user->unit->id }}" :array="$unit" name="unit"
                    id="unit" title="unit" />

  <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        type
                    </label>
                    <select class="form-control   @error('type')
    is-invalid
    @enderror" title="type" name="type" id="type" >
                        <option selected value="">select
                        </option>
                        <option value="admin" @if(old('type',$user->type)=='admin') selected @endif>admin
                        </option>
                        <option value="user" @if(old('type',$user->type)=='user') selected
                            @endif>user
                        </option>

                    </select>
   @error('type')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>



  <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        verified
                    </label>
                    <select class="form-control   @error('verified')
    is-invalid
    @enderror" title="verified" name="verified" id="verified">
                        <option selected value="">select
                        </option>
                        <option value="{{ Carbon\Carbon::today() }}" @if(old('verified',$user->email_verified_at)!=null) selected @endif> Activated
                        </option>
                        <option value="" @if(old('verified',$user->email_verified_at)==null) selected
                            @endif>Deactivated
                        </option>

                    </select>   @error('verified')
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
