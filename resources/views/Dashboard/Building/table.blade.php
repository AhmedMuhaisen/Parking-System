@forelse ($building as $item)
<tr>

    <td width="200">{{ $item->name }}</td>
    <td width="200">{{ $item->address }}</td>

    <td width="200">{{ $item->user->first_name . ' '.$item->user->second_name }}</td>
    <td width="200">{{ $item->parking->name}}</td>
    <td width="200">{{ $item->unit->count() }}</td>

    <td width="200">
        {{ $item->users->count()}}
        </td>
        <td>{{ $item->users->flatMap->vehicle->count() }}</td>

    <td width="200">{{ $item->spot->count()}}</td>
    <td width="200">{{ $item->users->flatMap->guests->count() }}</td>

    <td width="200">{{ $item->max_units }}</td>
    <td width="200">{{ $item->max_users }}</td>
    <td width="200">{{ $item->max_vehicles }}</td>
    <td width="200">{{ $item->max_spots }}</td>
    <td width="200">{{ $item->max_guests }}</td>





    {{-- <td><img src="{{ asset($item->image) }}" alt="" srcset="" width="100"></td>
    --}}
    {{-- <td width="700">
        <div style="overflow: hidden; line-break: anywhere;">
            <p>{!! $item->description !!}</p>
        </div>
    </td> --}}

    <td>
        <div class="d-flex">
            <a href=@if ($page=='trash' ) "{{ route('Dashboard.building.restore', $item->id) }}"
                @else "{{ route('Dashboard.building.edit', $item->id) }}" @endif>

                <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

            <form
                action="@if ($page == 'trash') {{ route('Dashboard.building.forcedelete', $item->id) }}@else{{ route('Dashboard.building.destroy', $item->id) }} @endif"
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
<tr>
    <td colspan="20" class="text-center">"No data available"</td>
</tr>
@endforelse
