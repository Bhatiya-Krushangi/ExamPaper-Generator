@extends('web.layout')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="mb10">Manage Topics</h1>
            <a href="{{ route('view.topics') }}">
                <button type="button" class="btn btn-success">
                    Back
                </button>
            </a>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('store.topic') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            {{-- <div class="row"> --}}

                                                <input type="hidden" name="id" value="{{ @$edit->id }}">
                                                <div class="col-md-12">
                                                    <label for="category_name" class="control-label mb-1">Language
                                                        Name</label>
                                                    <select id="parent_category_id" name="language" class="form-control">
                                                        <option value="" selected disabled>Select Language</option>
                                                        @foreach ($lang as $data)
                                                            <option value="{{ $data->id }}"{{ isset($edit) ? ($edit->language == $data->id ? 'selected' : '') : (old('language') == $data->id ? 'selected' : '') }}>{{ $data->language }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('language')
                                                        <p style="color: #007bff">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label for="category_slug" class="control-label mb-1">Topic Name</label>
                                                    <input id="category_slug" value="{{ isset($edit) ? ($edit->topic) : (old('topic')) }}" name="topic" type="text"
                                                        class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('topic')
                                                        <p style="color: #007bff">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            {{-- </div> --}}

                                        </div>


                                        <div>
                                            <button id="" type="submit"
                                                class="btn btn-lg btn-info btn-block">
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
