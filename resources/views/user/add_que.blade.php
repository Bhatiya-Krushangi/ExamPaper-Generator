@extends('web.layout')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="mb10">Manage Questions</h1>
            <a href="{{ route('view.que') }}">
                <button type="button" class="btn btn-success">
                    Back
                </button>
            </a>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('store.que') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">

                                                {{-- <input type="hidden" name="id" value=""> --}}
                                                <div class="col-md-4">
                                                    <label for="category_name" class="control-label mb-1">Language
                                                        Name</label>
                                                    <select name="language" id="lang" class="form-control">
                                                        <option value="" selected disabled>Select Language</option>
                                                        @foreach ($lang as $data)
                                                            <option value="{{ $data->id }}">{{ $data->language }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('language')
                                                        <p style="color: #007bff">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="category_name" class="control-label mb-1">Topic
                                                        Name</label>
                                                    <select id="topic" name="topic" class="form-control">
                                                        <option value="" selected disabled>Select Topic</option>
                                                        {{-- @foreach ($data as $top) --}}
                                                        <option value="" id=""></option>
                                                        {{-- @endforeach --}}
                                                    </select>
                                                    @error('topic')
                                                        <p style="color: #007bff">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="category_slug" class="control-label mb-1">Marks</label>
                                                    <input id="category_slug" value="" name="marks" type="text"
                                                        class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('marks')
                                                        <p style="color: #007bff">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <label for="category_slug" class="control-label mb-1">Question</label>
                                                    {{-- <input id="category_slug" value="" name="question" type="text"
                                                        class="form-control" aria-required="true" aria-invalid="false"> --}}
                                                        <textarea name="question" id="" class="form-control" cols="10" rows="5" onkeydown="search(this)"></textarea>
                                                    @error('question')
                                                        <p style="color: #007bff">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>


                                        <div>
                                            <button id="" type="submit" class="btn btn-lg btn-info btn-block">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('ajax')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lang').on('change', function() {
                var id = $('#lang').val();
                // alert(lang)
                $.ajax({
                    url: "{{ route('get.topic') }}",
                    type: "POST",
                    data: {
                        'id': id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // alert(response);
                        var html='';
                        html = "<option value='' selected disabled>" +'Select Topic'+ "</option>";
                        $.each(response, function(index, value) {
                            html += ('<option value="' + value
                                .id + '">' + value.topic +
                                '</option>');
                        });
                        $("#topic").html(html);
                    }
                })
            });
        });
    </script>
@endsection
