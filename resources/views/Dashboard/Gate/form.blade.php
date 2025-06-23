@extends('Dashboard.main')

@section('title', 'Create New Gate')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Gates</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-gate">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.gate.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $gate->name }}" title="Name" type="text" name="name"></x-inputd>

                      <x-inputd value="{{ $gate->address }}" title="address" type="text" name="address"></x-inputd>
   <x-selectd type="text" value="{{ $gate->parking->id }}" :array="$parkings" name="parking"
                    id="parking" title="parking" />


     <div class="my-3">

                    <label for="" class="col-sm-2 col-form-label">
                        Type
                    </label>
                    <select class="form-control   @error('type')
    is-invalid
    @enderror"  title="type" name="type" id="type" value="">
                        <option selected value="" style="color: gray" >select
                        </option>
                        <option value="Entrance" @if(old('type',$gate->type)=='Entrance') selected
                            @endif>Entrance
                        </option>
                        <option value="Exit" @if(old('type',$gate->type)=='Exit') selected
                            @endif>Exit
                        </option>

                    </select>
                       @error('open_method')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>

                <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        work method
                    </label>
                    <select class="form-control   @error('open_method')
    is-invalid
    @enderror"  title="open_method" name="open_method" id="open_method" value="">
                        <option selected value="" style="color: gray" >select
                        </option>
                        <option value="manual" @if(old('open_method',$gate->open_method)=='manual') selected
                            @endif>manual
                        </option>
                        <option value="automatic" @if(old('open_method',$gate->open_method)=='automatic') selected
                            @endif>automatic
                        </option>

                    </select>
                       @error('open_method')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>
                <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        status
                    </label>
                    <select class="form-control   @error('status')
    is-invalid
    @enderror" title="status" name="status" id="status" value="">
                        <option selected value="">select
                        </option>
                        <option value="active" @if(old('status',$gate->status)=='active') selected @endif>active
                        </option>
                        <option value="in_active" @if(old('status',$gate->status)=='in_active') selected
                            @endif>in_active
                        </option>

                    </select>
   @error('status')
            <p class="text-danger">{{ $message }}</p>
        @enderror

                </div>



                {{-- <x-input value="{{ $gate->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-input> --}}

                {{-- <x-textarea value="{{ $gate->description }}" title="Description" name="description">
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
