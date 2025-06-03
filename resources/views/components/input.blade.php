@props(['type', 'name', 'value', 'title', 'folder'])


@if ($type == 'file')

    @if ($folder != null)
        <img width="100" src="{{ asset($value) }}" alt="" style="margin-top: 20px;">
    @endif
@endif


    <input type="{{ $type }}" name={{ $name }}
        class="input-text
            @error($name)
            is-invalid
            @enderror"
        value="{{ old($name, $value) }}" placeholder="{{ $title }}">
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror

