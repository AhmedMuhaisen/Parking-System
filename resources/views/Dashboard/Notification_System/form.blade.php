@extends('Dashboard.main')

@section('title', 'notification_system')
@section('content')

<style>
    #color {
        height: 40px;
    }

    .pretty-checkbox {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        margin-right: 1rem;
        position: relative;
        font-weight: 500;
    }

    .pretty-checkbox input[type="checkbox"] {
        display: none;
    }

    .pretty-checkbox .checkmark {
        height: 18px;
        width: 18px;
        background-color: #eee;
        border-radius: 4px;
        margin-right: 8px;
        position: relative;
        border: 1px solid #ccc;
    }

    .pretty-checkbox input:checked+.checkmark {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .pretty-checkbox .checkmark::after {
        content: "";
        position: absolute;
        display: none;
        left: 6px;
        top: 2px;
        width: 4px;
        height: 9px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .pretty-checkbox input:checked+.checkmark::after {
        display: block;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Notification system</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-notification_system">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">@yield('title_form')</h5>
                    <a class="role-back btn btn-primary w-20 h-75"
                        href="{{ route('Dashboard.notification_system.index') }}"> Rol
                        Back</a>
                </div>
                <!-- General Form Elements -->
                @yield('form')

                <div class="mb-3">
                    <label class="mb-2">Entity Type</label>
                    <select name="entity_type" class="form-select     @error('entity_type')
            is-invalid
            @enderror" required>
                        <option value="">-- Select --</option>
                        @foreach(['vehicle', 'camera', 'section', 'gate'] as $type)
                        <option value="{{ $type }}" {{ old('entity_type',$notification_system->entity_type) == $type ?
                            'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select> @error('entity_type')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="my-2">Event Type</label>
                    <select name="event_type" class="form-select     @error('event_type')
            is-invalid
            @enderror" required>
                        @foreach(['create', 'move', 'open', 'delete', 'edit'] as $event)
                        <option value="{{ $event }}" {{ old('event_type',$notification_system->event_type) == $event ?
                            'selected' : '' }}>{{ ucfirst($event) }}</option>
                        @endforeach
                    </select> @error('event_type')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3"> <label class="">
                        <input type="checkbox" name="onr" id="onr"> Onr
                    </label>
                </div>
                <div class="mb-3">
                    <label>Target Audience</label>
                    <select name="target_audience" id="targetAudience" class="form-select     @error('target_audience')
            is-invalid
            @enderror" required>
                        <option value="all" {{ old('target_audience',$notification_system->target_audience) == 'all' ?
                            'selected' : '' }}>All Users</option>
                        <option value="admin" {{ old('target_audience',$notification_system->target_audience) == 'admin' ?
                            'selected' : '' }}>Admins Only</option>
                        <option value="user" {{ old('target_audience',$notification_system->target_audience) == 'user' ?
                            'selected' : '' }}>Specific User</option>
                        <option value="phone" {{ old('target_audience',$notification_system->target_audience) == 'phone' ?
                            'selected' : '' }}>Phone Number</option>
                        <option value="email" {{ old('target_audience',$notification_system->target_audience) == 'email' ?
                            'selected' : '' }}>Email Address</option>
                    </select> @error('target_audience')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>



                <div class="mb-3 d-none" id="userSelect">
                    <label>Select User</label>
                    <select name="user_id" class="form-select     @error('user_id')
            is-invalid
            @enderror">
                        @foreach(App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" {{old('user_id',$notification_system->user_id) == $user->id ?
                            'selected' : '' }}>{{ $user->first_name .' '.$user->second_name }}</option>
                        @endforeach
                    </select> @error('user_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 d-none" id="phoneInput">
                    <label>Phone Number</label>
                    <input type="number" name="phone" value="{{ old('phone',$notification_system->phone) }}" class="form-control     @error('phone')
            is-invalid
            @enderror"> @error('phone')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 d-none" id="emailInput">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email',$notification_system->email) }}" class="form-control     @error('email')
            is-invalid
            @enderror"> @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label      @error('channels')
            is-invalid
            @enderror">Channels</label><br>
                    @foreach(['system', 'email', 'sms'] as $channel)
                    <label class="pretty-checkbox">
                        <input type="checkbox" name="channels[]" value="{{ $channel }}" {{ isset($notification_system) &&
                            in_array($channel, json_decode($notification_system->channels ?? '[]')) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        {{ ucfirst($channel) }}
                    </label>
                    @endforeach @error('channels')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>



                <x-textarea name="message" title="message" value="{{ $notification_system->message ?? '' }}" />

                <div class="my-3">
                    <label class="my-2      @error('additional')
            is-invalid
            @enderror">Additional</label><br>

                    @foreach(['created_by', 'created_at'] as $additional)
                    <label class="pretty-checkbox">
                        <input type="checkbox" name="additional[]" value="{{ $additional }}" {{
                            isset($notification_system) && in_array($additional,
                            json_decode($notification_system->additional ?? '[]')) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        {{ ucfirst($additional) }}
                    </label>
                    @endforeach @error('additional')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="my-2      @error('actions')
            is-invalid
            @enderror">Actions</label><br>
                    @foreach(['edit', 'delete', 'resend' ,'show'] as $action)
                    <label class="pretty-checkbox">
                        <input type="checkbox" name="actions[]" value="{{ $action }}" {{ isset($notification_system) &&
                            in_array($action, json_decode($notification_system->actions ?? '[]')) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        {{ ucfirst($action) }}
                    </label>
                    @endforeach @error('actions')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>







                <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                </form>



            </div>
        </div>

    </div>

    </div>
    </section>

</main><!-- End #main -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const audienceSelect = document.getElementById('targetAudience');
        const userSelect = document.getElementById('userSelect');
        const phoneInput = document.getElementById('phoneInput');
        const emailInput = document.getElementById('emailInput');

        function toggleFields() {
            const value = audienceSelect.value;
            userSelect.classList.toggle('d-none', value !== 'user');
            phoneInput.classList.toggle('d-none', value !== 'phone');
            emailInput.classList.toggle('d-none', value !== 'email');
        }

        audienceSelect.addEventListener('change', toggleFields);
        toggleFields();
    });
</script>
@endsection
