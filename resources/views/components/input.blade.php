@props(['type', 'name', 'value', 'title', 'folder' ,'id'])


@if ($type == 'file')

    @if ($folder != null)
        <img width="100" src="{{ asset($value) }}" alt="" style="margin-top: 20px;">
    @endif
@endif


    <input type="{{ $type }}" name={{ $name }} id="{{ $id ?? $name }}"
        class="form-control input-text
            @error($name)
            is-invalid
            @enderror"
        value="{{ old($name, $value) }}" placeholder="{{ $title }}">
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror

