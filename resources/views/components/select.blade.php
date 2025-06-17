@props(['array', 'name', 'value', 'title' ,'id'])


    <div class="col-sm-12">
        <select name='{{ $name }}' id="{{ $id ?? $name }}"
            class="form-select
    @error($name)
    is-invalid
    @enderror">
    @if($title=='search')
         <option value="" selected >{{ $title }}</option>
    @else
 <option value="" selected disabled hidden>{{ $title }}</option>
    @endif
            @foreach ($array as $item)
                <option value="{{ $item->id }}" @selected(old($name, $value) == $item->id)>{{ $item->name }}</option>
            @endforeach

        </select>
        @error($name)
            <p class="text-danger">{{ $message }}</p>
        @enderror

</div>
