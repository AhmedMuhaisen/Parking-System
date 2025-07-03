@extends('Dashboard.main')
@section('title', 'Create setting')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>settings</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body create-setting">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">setting</h5>
                    <button class="role-back btn btn-primary w-20 h-75" onclick="history.back()" type="button">Roll Back
                        </button>
                </div>

                <!-- General Form Elements -->
                <form action="{{ route('Dashboard.setting.update', 1) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')


    <x-inputd value="{{ $setting->website_logo }}" title="logo" folder='{{ $folder }}'
                        type="file" name="website_logo"></x-inputd>
                    <x-inputd value="{{ $setting->website_name }}" title="website_name" type="text" name="website_name">
                    </x-inputd>
                    <x-inputd value="{{ $setting->website_email }}" title="website_email" type="text"
                        name="website_email"></x-inputd>
                         <x-inputd value="{{ $setting->website_phone }}" title="website_phone" type="text"
                        name="website_phone"></x-inputd>

                    <x-inputd value="{{ $setting->address }}" title="address" type="text"
                        name="address"></x-inputd>


                    <x-inputd value="{{ $setting->header_title }}" title="header_title" type="text" name="header_title">
                    </x-inputd>

                        <x-inputd value="{{ $setting->header_subtitle }}" title="header_subtitle" type="text" name="header_subtitle">
                    </x-inputd>
                    <x-inputd value="{{ $setting->header_image }}" title="header_image" folder='{{ $folder }}'
                        type="file" name="header_image"></x-inputd>

                   <x-inputd value="{{ $setting->header_background }}" title="header_background" folder='{{ $folder }}'
                        type="file" name="header_background"></x-inputd>

                    {{-- <label for="" class="my-2">header_description</label>

                    <textarea class="tinymce-editor @error('header_description')
                        is-invalid
                    @enderror" name={{ 'header_description' }}>
                    {!! $setting->header_description !!}
                    </textarea><!-- End TinyMCE Editor -->
                            @error('header_description')
                            <p class="text-danger">{{ $message }}</p>
                    @enderror --}}


                    <x-inputd value="{{ $setting->about_title }}" title="about_title" type="text"
                        name="about_title"></x-inputd>

                    <x-inputd value="{{ $setting->about_image }}" title="about_image" folder='{{ $folder }}' type="file"
                        name="about_image"></x-inputd>

                        <textarea class="tinymce-editor @error('about_content')
                        is-invalid
                    @enderror" name={{ 'about_content' }}>
                    {!! $setting->about_content !!}
                    </textarea><!-- End TinyMCE Editor -->
                            @error('about_content')
                            <p class="text-danger">{{ $message }}</p>
                    @enderror



                          <x-inputd value="{{ $setting->advantage_title }}" title="advantage_title" type="text"
                        name="advantage_title"></x-inputd>

                    <x-inputd value="{{ $setting->advantage_image }}" title="advantage_image" folder='{{ $folder }}' type="file"
                        name="advantage_image"></x-inputd>

                        <textarea class="tinymce-editor @error('advantage_text')
                        is-invalid
                    @enderror" name={{ 'advantage_text' }}>
                    {!! $setting->advantage_text !!}
                    </textarea><!-- End TinyMCE Editor -->
                            @error('advantage_text')
                            <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <label>Advantage Tags:</label>
<input type="text" id="tag-input" class="form-control" placeholder="Type and press Enter">

<div id="tags-container" class="mt-2 mb-3">
@foreach (json_decode($setting->advantages, true) as $tag)
    <span class="badge bg-primary me-1 tag-item">
        {{ is_array($tag) ? $tag['label'] ?? reset($tag) : $tag }}
        <button type="button" onclick="removeTag(this)" class="btn btn-sm btn-light ms-1">×</button>
    </span>
    <input type="hidden" name="advantages[]" value="{{ is_array($tag) ? $tag['label'] ?? reset($tag) : $tag }}">
@endforeach
</div>

                    <button type="submit" class="btn btn-primary my-4 display-block w-100 mx-auto">Submit Form</button>
                </form><!-- End General Form Elements -->

            </div>
        </div>

@if (session('msg') != null)
    <script>
        alert("{{ session('msg') }}");
    </script>
@endif

    </div>

    </div>
    </section>




</main><!-- End #main -->

@endsection

@section('script')
<script>

    function add_color() {
            var colors_countent = document.querySelector('.colors-countent')
            colors_countent.innerHTML +=
                `<input class="form-control form-control-color mx-2" value="#2c5df2" title="colors" type="color" name="colors[]"></input>`
        }
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('tag-input');
    const container = document.getElementById('tags-container');

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const tag = input.value.trim();
            if (tag) {
                addTag(tag);
                input.value = '';
            }
        }
    });

    window.removeTag = function (btn) {
        btn.parentElement.remove();
    }

    function addTag(text) {
        const span = document.createElement('span');
        span.className = 'badge bg-primary me-1 tag-item';
        span.style.padding = '5px ';
        span.innerHTML = `${text}  <button type="button" onclick="removeTag(this)" class="btn btn-sm btn-light ms-2 px-2 py-2" style="line-height: 1;">×</button>`;
        container.appendChild(span);

        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'advantages[]';
        hidden.value = text;
        container.appendChild(hidden);
    }
});


</script>

@endsection
