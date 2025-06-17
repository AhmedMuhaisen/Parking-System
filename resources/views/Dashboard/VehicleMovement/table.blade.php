
                        @forelse ($vehicleMovement as $item)
                        <tr>

                            <td width="200">{{ $item->vehicle->vehicle_number }}</td>
                             <td>{{ $item->vehicle->user->first_name .' '.$item->vehicle->user->second_name }}</td>
                            <td>{{ $item->gate->name }}</td>
                            <td>{{ $item->type_Movement }}</td>
                              <td>{{ $item->Method_of_passage }}</td>

                            <td width="200">{{$item->created_at->format('m-d-Y');}}</td>

                               <td width="200">{{$item->created_at->format('h-m-s');}}</td>










                            {{-- <td><img src="{{ asset($item->image) }}" alt="" srcset="" width="100"></td>
                            --}}
                            {{-- <td width="700">
                                <div style="overflow: hidden; line-break: anywhere;">
                                    <p>{!! $item->description !!}</p>
                                </div>
                            </td> --}}

                            <td>
                                <div class="d-flex">
                                    <a href=@if ($page=='trash'
                                        ) "{{ route('Dashboard.vehicleMovement.restore', $item->id) }}"
                                        @else "{{ route('Dashboard.vehicleMovement.edit', $item->id) }}" @endif>

                                        <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="@if ($page == 'trash') {{ route('Dashboard.vehicleMovement.forcedelete', $item->id) }}@else{{ route('Dashboard.vehicleMovement.destroy', $item->id) }} @endif"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button style="border: 0; background: none;"><i class="@if ($page == 'trash') fa fa-close
                                                        @else fa fa-trash @endif" style="background: #c60707;
                                                                padding: 9px 10px;
                                                                color: white;
                                                                border-radius: 8px;">
                                            </i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                        @empty
                       <tr> <td colspan="12" class="text-center">"No data available"</td></tr>
                        @endforelse

