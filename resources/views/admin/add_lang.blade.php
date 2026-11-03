@extends('web.layout')
@section('main')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <h1 class="mb10">Manage Language</h1>
        <a href="{{ route('view.lang') }}">
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
                                <form action="{{ route('store.lang') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="color" class="control-label mb-1">Language
                                                </label>
                                                <input type="hidden" name="id" id="" value="{{ @$edit->id }}">
                                                <input id=""  name="language" type="text"
                                                    class="form-control" aria-required="true"
                                                    aria-invalid="false" value="{{ isset($edit) ? ($edit->language) : (old('language')) }}">
                                                    @error('language')
                                                    <p style="color: #007bff">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit"
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