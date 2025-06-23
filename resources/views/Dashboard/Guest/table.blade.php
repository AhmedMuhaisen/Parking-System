
                        @forelse ($guest as $item)
                        <tr>

     <td>{{ $item->name }}</td>
                            <td width="200">{{ $item->vehicle_number }}</td>
                            <td>{{ $item->login_date }}</td>
                              <td>{{ $item->login_time }}</td>
                            <td>{{ $item->logout_date }}</td>
                              <td>{{ $item->logout_time }}</td>
                            <td>{{ $item->type }}</td>
                              <td>{{ $item->time_remaining }}</td>
                                            <td>{{ $item->notes }}</td>
                            <td>{{ $item->number_visits }}</td>


                             <td>{{ $item->user->first_name .' '.$item->user->second_name }}</td>












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
                                        ) "{{ route('Dashboard.guest.restore', $item->id) }}"
                                        @else "{{ route('Dashboard.guest.edit', $item->id) }}" @endif>

                                        <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="@if ($page == 'trash') {{ route('Dashboard.guest.forcedelete', $item->id) }}@else{{ route('Dashboard.guest.destroy', $item->id) }} @endif"
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

