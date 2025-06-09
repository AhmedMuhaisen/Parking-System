
                        @forelse ($vehicle as $item)
                        <tr>

                            <td width="200">{{ $item->vehicle_number }}</td>
                            <td><input  type="color"  disabled name="" value="{{ $item->color }}" id=""></td>
                            <td  ><img src="{{asset($item->image)}} " alt=""  style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"></td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->vehicle_type->name }}</td>
                            <td>{{ $item->vehicle_brand->name }}</td>
                            <td>{{ $item->motor_type->name }}</td>
                             <td>{{ $item->user->first_name .' '.$item->user->second_name }}</td>
                            <td>{{ $item->date_start->format('m-d-Y'); }}</td>
                            <td>{{$item->date_End->format('m-d-Y'); }}</td>

                            <td width="200">{{$item->created_at->format('m-d-Y');}}</td>










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
                                        ) "{{ route('Dashboard.vehicle.restore', $item->id) }}"
                                        @else "{{ route('Dashboard.vehicle.edit', $item->id) }}" @endif>

                                        <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="@if ($page == 'trash') {{ route('Dashboard.vehicle.forcedelete', $item->id) }}@else{{ route('Dashboard.vehicle.destroy', $item->id) }} @endif"
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

