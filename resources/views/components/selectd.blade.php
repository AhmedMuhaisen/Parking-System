@props(['array', 'name', 'value', 'title' ,'id'])


    <div class="col-sm-12">
   <label for="" class="col-sm-2 col-form-label">
        {{ $title }}
    </label>

        <select name='{{ $name }}' id="{{ $id ?? $name }}"
            class="form-select
    @error($name)
    is-invalid
    @enderror">
            <option value="" selected disabled hidden>{{ $title }}</option>

            @foreach ($array as $item)
                <option value="{{ $item->id }}" @selected(old($name, $value) == $item->id)>{{ $item->name }}</option>
            @endforeach

        </select>
        @error($name)
            <p class="text-danger">{{ $message }}</p>
        @enderror

</div>
