@extends('Dashboard.main')

@section('title', 'message')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>messages</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-message">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75" href="{{ route('Dashboard.message.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')
          <!-- Select Send Type -->
          @if($page=='create')
        <label for="send_type">Send To:</label>
<select name="send_type" id="send_type" class="form-select" onchange="toggleFields()">
    <option value="">-- Select Type --</option>
    <option value="user">User</option>
    <option value="email">Email</option>
</select>



          @endif

<!-- Email Input -->
<div id="email_input" style="@if($page=='create')display: none;@endif">
    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email',$message->email) }}" class="form-control" placeholder="Enter email address">
</div>

<!-- User Dropdown -->
<div id="user_select" style="display: none;">
    <label for="user_id">Select User:</label>
    <select name="user_id" class="form-select">
        @foreach ($users as $user)
            <option value="{{ $user->email }}">{{ $user->first_name . ' '.$user->second_name }}</option>
        @endforeach
    </select>
</div>


      <x-inputd value="{{ $message->subject }}" title="subject" type="text" name="subject"></x-inputd>

         <x-textarea value="" title="message" type="text" name="message"></x-textarea>


                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->


    <script>
    function toggleFields() {
        const type = document.getElementById("send_type").value;
        document.getElementById("email_input").style.display = (type === 'email') ? 'block' : 'none';
        document.getElementById("user_select").style.display = (type === 'user') ? 'block' : 'none';
    }

 </script>
@endsection
