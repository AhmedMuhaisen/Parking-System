@forelse ($testimonial as $item)
<tr>

    <td width="200">{{ $item->rating }}</td>

    <td width="200">{!! $item->text!!}</td>
    <td width="200">{{ $item->user->first_name . ' '.$item->user->second_name }}</td>

    <td width="200">{{ $item->created_at}}</td>






    <td>
        <div class="d-flex">
            <a href=@if ($page=='trash' ) "{{ route('Dashboard.testimonial.restore', $item->id) }}"
                @else "{{ route('Dashboard.testimonial.edit', $item->id) }}" @endif>

                <i class="@if ($page == 'trash') fa fa-store @else fa fa-pencil @endif" style="background: #4154f1;
                                                            padding: 9px 10px;
                                                            color: white;
                                                            border-radius: 8px;"></i></a>

            <form
                action="@if ($page == 'trash') {{ route('Dashboard.testimonial.forcedelete', $item->id) }}@else{{ route('Dashboard.testimonial.destroy', $item->id) }} @endif"
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
