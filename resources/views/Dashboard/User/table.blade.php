
                        @forelse ($user as $item)
                        <tr>

                             <td>{{ $item->first_name .' '.$item->second_name }}</td>
                            <td width="200">{{ $item->date_birth}}</td>

                            <td  ><img src="{{asset($item->image)}} " alt=""  style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"></td>
                            <td width="200">{{ $item->phone}}</td>

                            <td width="200">{{ $item->email}}</td>
                             <td>{{ $item->type}}</td>
                              <td>{{ $item->unit->name }}</td>
                            <td>{{ $item->building->name }}</td>
                              <td>{{ $item->vehicle->count() }}</td>
                              <td width="200">@if($item->email_verified_at == null) <p class="btn btn-secondary">Deactivated</p> @else
                            <p class="btn btn-success">Activated</p>
                          @endif  </td>

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
                                        ) "{{ route('Dashboard.user.restore', $item->id) }}"
                                        @else "{{ route('Dashboard.user.edit', $item->id) }}" @endif>

                                        <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="@if ($page == 'trash') {{ route('Dashboard.user.forcedelete', $item->id) }}@else{{ route('Dashboard.user.destroy', $item->id) }} @endif"
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

