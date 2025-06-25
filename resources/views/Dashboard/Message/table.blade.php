@forelse ($message as $item)
<tr>

    <td width="200">{{ $item->email }}</td>

    <td width="200">{{ $item->subject}}</td>

    <td width="200">{{ $item->message}}</td>
  <td width="200">{{ $item->created_at}}</td>





    {{-- <td><img src="{{ asset($item->image) }}" alt="" srcset="" width="100"></td>
    --}}
    {{-- <td width="700">
        <div style="overflow: hidden; line-break: anywhere;">
            <p>{!! $item->description !!}</p>
        </div>
    </td> --}}

    <td>
        <div class="d-flex">
         @if ($page=='trash' )    <a href="{{ route('Dashboard.message.restore', $item->id) }}">

               <i class=" fa fa-store " style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>
                                                             @endif

            <form
                action="@if ($page == 'trash') {{ route('Dashboard.message.forcedelete', $item->id) }}@else{{ route('Dashboard.message.destroy', $item->id) }} @endif"
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
    <td colspan="5" class="text-center">"No data available"</td>
</tr>
@endforelse
