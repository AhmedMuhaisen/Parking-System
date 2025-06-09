@props(['type', 'name', 'value', 'title', 'folder' ,'id'])

<div class="my-2">
@if ($type == 'file')

    @if ($folder != null)
        <img width="100" src="{{ asset($value) }}" alt="" style="margin-top: 20px;">
    @endif
@endif
    <label for="{{ $name }}" class="col-sm-2 col-form-label">
        {{ $title }}
    </label>

    <input type="{{ $type }}" name={{ $name }} id="{{ $id ?? $name }}"
        class="form-control input-text
            @error($name)
            is-invalid
            @enderror"
        value="{{ old($name, $value) }}" placeholder="{{ $title }}">
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror

</div>
