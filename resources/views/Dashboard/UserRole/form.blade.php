@extends('Dashboard.main')

@section('title', 'role')
@section('content')


    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1>roles</h1>
            </div>
        </div><!-- End Page Title -->

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body create-role">
                    <div class="d-flex mt-2 justify-content-between align-items-center">
                        <h5 class="card-title">@yield('title_form')</h5>
                        <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.user_role.index') }}"> Rol
                            Back</a>
                    </div>
                    <!-- General Form Elements -->
                    @yield('form')
                       <div class="my-2">
                    <label for="">User name</label>

                    <select class="form-control mt-2" title="user" name="user_id" id="user" value="">

                        <option selected value="" style="color: gray">select
                        </option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}" @if(old('user',$item->id)==$user->id) selected
                            @endif>{{$item->first_name . ' ' .$item->second_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                    <x-select name='role_id' title="role" value="{{ $user->role_id }}" :array="$role"></x-select>

                    <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>

        </div>
        </section>

    </main><!-- End #main -->

@endsection
