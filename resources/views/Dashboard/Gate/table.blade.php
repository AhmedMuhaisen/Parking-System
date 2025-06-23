
                        @forelse ($gate as $item)
                        <tr>


                            <td width="">{{ $item->name }}</td>
                              <td width="200">{{ $item->address}}</td>
                               <td width="">{{ $item->parking->name }}</td>
                            <td width="">{{ $item->type }}</td>

                            <td width="">{{ $item->open_method }}</td>
                            <td width="">{{ $item->status }}</td>


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
                                        ) "{{ route('Dashboard.gate.restore', $item->id) }}"
                                        @else "{{ route('Dashboard.gate.edit', $item->id) }}" @endif>

                                        <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

                                    <form
                                        action="@if ($page == 'trash') {{ route('Dashboard.gate.forcedelete', $item->id) }}@else{{ route('Dashboard.gate.destroy', $item->id) }} @endif"
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
                       <tr> <td colspan="7" class="text-center">"No data available"</td></tr>
                        @endforelse

