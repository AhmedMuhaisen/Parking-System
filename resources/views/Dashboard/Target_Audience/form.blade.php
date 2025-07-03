@extends('Dashboard.main')

@section('title', 'target_audience')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>target_audiences</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-target_audience">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="target_audience-back btn btn-primary w-20 h-75"
                        href="{{ route('Dashboard.target_audience.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')

                <x-inputd value="{{ $target_audience->name }}" title="name" type="text" name="name"></x-inputd>

                <div class="d-flex">
                    <div class="w-50 pl-2 py-3">
                        <select class="form-control" title="search" name="group" id="group" value="">
                            <option selected value="">search
                            </option>
                            <option value="admin">admin
                            </option>
                            <option value="user">user
                            </option>
                        </select>
                    </div>
                    <div class="w-50 px-2 py-3">

                        <select class="form-control   @error('user')
                            is-invalid
                            @enderror" title="user" name="user" id="user" value="">

                            <option selected value="" style="color: gray">select
                            </option>
                            @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{$item->first_name . ' ' .$item->second_name }}
                            </option>
                            @endforeach
                        </select> @error('user')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                         <input type="hidden" name="target_audience" id="target_audience" value="{{ $target_audience }}">
                    <div class="w-20 px-2 py-3">
                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                    </div>
                </div>
<div id="Container">
                @include('Dashboard.Target_Audience.users', ['users' => $users])
</div>
                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto"
                   >Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
    $('#searchBtn').on('click', function (e) {
        e.preventDefault();
        search(e);
    });
});
    function datavalue(){

        return{
        group: $('#group').val(),
        user: $('#user').val(),
          target_audience: $('#target_audience').val(),
    };
    }

   function search(e) {
    e.preventDefault();
        console.log('====================================');
        let data = datavalue()

        $.ajax({
            url: "{{ route('Dashboard.target_audience.search', $target_audience->id) }}",
            type: "GET",
            data: data,
            success: function (response) {
                $('#Container').html(response.html);
                console.log(response);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection
