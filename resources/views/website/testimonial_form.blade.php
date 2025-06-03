            @foreach ($testimonials as $testimonial)
                <!-- testimonial Information Modal -->
                <div class="modal" id="editModaltestimonial{{ $testimonial->id ?? 'A' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>{{ $mode }} testimonial Information</h3>
                            <span class="close" onclick="closeModal('testimonial','{{ $testimonial->id ?? 'A' }}')">&times;</span>
                        </div>

                        <form id="editFormtestimonial{{$testimonial->id ?? 'A'}}" action="{{ route($route, $testimonial->id ?? 'A') }}" method="post">
                            @csrf
                            <div id="alertBox_testimonial{{ $testimonial->id ?? 'A' }}" class="alert alert-danger w-100 " style="position: relative ; display: none">

                                <button onclick="closeAlert()" style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;" type="button">&times;</button>
                            </div>

                            <div class="form-group w-100">
                                <label>rating</label>
                                <input type="text" id="rating{{ $testimonial->id ?? 'A' }}" name="rating" value="{{ $testimonial->rating ?? null}}" class="">
                            </div>


                            <div class="form-group w-100">
                                <label>text</label>
                                <textarea type="text" class="form-control" id="text{{ $testimonial->id ?? 'A' }}" name="text" value="">{{ $testimonial->text ?? null}}</textarea>
                            </div>

                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
                @endforeach
