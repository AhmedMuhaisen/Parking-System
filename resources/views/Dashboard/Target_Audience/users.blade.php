   <div class="mb-4 d-flex flex-wrap">



                    @foreach ($users as $item)
                    <div class="p-3 m-1 d-flex" style="border: 1px solid #0d6efd ; width: 32.4%;">
                        <p class="w-100 mb-0">{{ $item->first_name.' '.$item->second_name }}</p>

                        <div class=" form-check d-flex flex-row-reverse" style="">
                            <input type="checkbox" class="form-check-input" name="users[]" value="{{ $item->id }}"
                                @checked(in_array($item->id, json_decode($target_audience->users, true) ?? []))>

                        </div>

                    </div>
                    @endforeach
                </div>
