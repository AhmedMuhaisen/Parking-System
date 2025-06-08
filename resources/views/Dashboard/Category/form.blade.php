@extends('Dashboard.main')

@section('title', 'Category')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Categories</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-category">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.category.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
                <x-inputd value="{{ $category->name }}" title="Name" type="text" name="name"></x-inputd>

                <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        work method
                    </label>
                    <select class="form-control"  title="work_method" name="work_method" id="work_method" value="">
                        <option selected value="" style="color: gray" >select
                        </option>
                        <option value="manual" @if(old('work_method',$category->work_method)=='manual') selected
                            @endif>manual
                        </option>
                        <option value="automatic" @if(old('work_method',$category->work_method)=='automatic') selected
                            @endif>automatic
                        </option>

                    </select>
                </div>
                <div class="my-3">
                    <label for="" class="col-sm-2 col-form-label">
                        status
                    </label>
                    <select class="form-control" title="status" name="status" id="status" value="">
                        <option selected value="">select
                        </option>
                        <option value="active" @if(old('status',$category->status)=='active') selected @endif>active
                        </option>
                        <option value="in_active" @if(old('status',$category->status)=='in_active') selected
                            @endif>in_active
                        </option>

                    </select>

                </div>




                {{-- <x-input value="{{ $category->image }}" title="image" folder='{{ $folder }}' type="file"
                    name="image"></x-input> --}}

                {{-- <x-textarea value="{{ $category->description }}" title="Description" name="description">
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
