
                @foreach ($guests as $guest)
                <!-- guest Information Modal -->
                <div class="modal" id="editModalguest{{ $guest->id ?? 'A' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>{{ $mode }} guest Information</h3>
                            <span class="close" onclick="closeModal('guest','{{ $guest->id ?? 'A' }}')">&times;</span>
                        </div>

                        <form id="editFormguest{{$guest->id ?? 'A'}}" action="{{ route($route, $guest->id ?? 'A') }}"
                            method="post">
                            @csrf
                            <div id="alertBox_guest{{ $guest->id ?? 'A' }}" class="alert alert-danger w-100 "
                                style="position: relative ; display: none">

                                <button onclick="closeAlert()"
                                    style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;"
                                    type="button">&times;</button>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="guest_name{{ $guest->id ?? 'A' }}" name="name"
                                    value="{{ $guest->name ?? null}}">
                            </div>


                            <div class="form-group">
                                <label>Vehicle Number</label>
                                <input type="text" id="vehicle_number{{ $guest->id ?? 'A' }}" name="vehicle_number"
                                    value="{{ $guest->vehicle_number ?? null}}">
                            </div>
                            <div class="form-group">
                                <label>Login Date</label>
                                <input type="date" id="login_date{{ $guest->id ?? 'A' }}" name="login_date"
                                    value="{{ $guest->login_date ?? null}}" required>
                            </div>

                            <div class="form-group">
                                <label>Login time</label>
                                <input type="time" id="login_time{{ $guest->id ?? 'A' }}" name="login_time"
                                    value="{{ $guest->login_time ?? null}}" required>
                            </div>

                            <div class="form-group">
                                <label>logout Date</label>
                                <input type="date" id="logout_date{{ $guest->id ?? 'A' }}" name="logOut_date"
                                    value="{{ $guest->logOut_date ?? null}}" required>
                            </div>

                            <div class="form-group">
                                <label>logout time</label>
                                <input type="time" id="logout_time{{ $guest->id ?? 'A' }}" name="logOut_time"
                                    value="{{ $guest->logOut_time ?? null}}" required>
                            </div>

                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
                @endforeach
