@props(['name', 'value', 'title'])


<label for="" class="my-2">{{ $title }}</label>

<textarea class="tinymce-editor @error($name)
is-invalid
@enderror" name={{ $name }}>
             {!! $value !!}
              </textarea><!-- End TinyMCE Editor -->
@error($name)
    <p class="text-danger">{{ $message }}</p>
@enderror
