

           @foreach ($vehicles as $vehicle)
                <!-- Vehicle Information Modal -->

                <div class="modal" id="editModalvehicle{{ $vehicle->id ?? 'A' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>{{ $mode }} Vehicle Information</h3>
                      <span class="close" onclick="closeModal('vehicle', '{{ $vehicle->id ?? 'A' }}')">&times;</span>
                        </div>

                        <form id="editFormvehicle{{$vehicle->id ?? 'A'}}"
                            action="{{ route($route, $vehicle->id ?? 'A') }}" method="post">
                            @csrf
                            <div id="alertBox_vehicle{{ $vehicle->id ?? 'A' }}" class="alert alert-danger w-100 "
                                style="position: relative ; display: none">

                                <button onclick="closeAlert()"
                                    style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;"
                                    type="button">&times;</button>
                            </div>

                            <div class="form-group">
                                <label>Vehicle Number</label>
                                <input type="text" id="vehicle_number{{ $vehicle->id ?? 'A' }}" name="vehicle_number" value="{{ $vehicle->vehicle_number ?? null }}">
                            </div>
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <x-select id="vehicle_type{{ $vehicle->id ?? 'A' }}" name='vehicle_type'
                                    title="Vehicle Type" value="{{ $vehicle->vehicle_type->id ?? 'A' }}"
                                    :array="$vehicles_type">
                                </x-select>

                            </div>
                            <div class="form-group">
                                <label>Motor Type</label>
                                <x-select name='motor_type' id="motor_type{{ $vehicle->id ?? 'A' }}" title="Motor Type"
                                    value="{{ $vehicle->motor_type->id ?? 'A' }}" :array="$motor_type">
                                </x-select>


                            </div>
                            <div class="form-group">
                                <label>Car Type</label>
                                <x-select name='VehiclesBrand' id="VehiclesBrand{{ $vehicle->id ?? 'A' }}" title="car Type"
                                    value="{{ $vehicle->VehiclesBrand->id ?? 'A' }}" :array="$VehiclesBrand">
                                </x-select>
                            </div>
                            <div class="form-group">
                                <label>Color</label>
                                <input type="color" id="color{{ $vehicle->id ?? 'A' }}" name="color"
                                    value="{{ $vehicle->color  ?? 'A'}}" required style="height: 40px">
                            </div>
                            <div class="form-group">
                                <label>Date Of End</label>
                                <input type="date" id="date_end{{ $vehicle->id ?? 'A' }}" name="date_end"
                                    value="{{ $vehicle->date_End  ?? 'A'}}" required>
                            </div>

                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
                @endforeach

