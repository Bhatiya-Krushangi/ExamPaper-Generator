@extends('web.layout')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="mb10">Manage Users</h1>
            <a href="{{ route('view.users') }}">
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
                                    <form action="{{ route('data.register') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ @$edit->id }}">
                                            <label for="color" class="control-label mb-1">Username </label>
                                            <input id="color" value="{{ isset($edit) ? $edit->name : old('name') }}"
                                                name="name" type="text" class="form-control" aria-required="true"
                                                aria-invalid="false">
                                            @error('name')
                                                <p style="color: #007BFF">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="color" class="control-label mb-1">Email Address </label>
                                            <input id="color" value="{{ isset($edit) ? $edit->email : old('email') }}"
                                                name="email" type="email" class="form-control" aria-required="true"
                                                aria-invalid="false">
                                            @error('email')
                                                <p style="color: #007BFF">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label for="color" class="control-label mb-1">Password </label>
                                                    <input
                                                        value="{{ isset($edit) ? $edit->password : old('password') }}"
                                                        name="password" type="password" class="form-control pass"
                                                        aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <div class="col-md-1 d-flex justify-content-end">
                                                <p class="btn btn-sm" id="s_pass"
                                                    style="background-color: #17a2b8; color: white"><i
                                                        class="fas fa-list"></i></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="color" class="control-label mb-1">Confirm Password </label>
                                            <input id="color"
                                                value="{{ isset($edit) ? $edit->password : old('password') }}"
                                                name="password_confirmation" type="password" class="form-control pass"
                                                aria-required="true" aria-invalid="false">
                                            @error('password')
                                                <p style="color: #007BFF">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="color" class="control-label mb-1">Role</label>
                                            <div class="gen ml-3">
                                                <div class="row">
                                                    <input type="radio" name="role" id=""
                                                        value="Admin"{{ isset($edit) ? ($edit->role == 'Admin' ? 'checked' : '') : (old('role') == 'Admin' ? 'checked' : '') }}>
                                                    <p class="ml-2">Admin</p>
                                                    <input type="radio" name="role" id="" class="ml-4"
                                                        value="User"{{ isset($edit) ? ($edit->role == 'User' ? 'checked' : '') : (old('role') == 'User' ? 'checked' : '') }}>
                                                    <p class="ml-2">User</p>
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
@section('ajax')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click','#s_pass',function() {
                var change = $(".pass");
                if (change.attr('type') === 'password') {
                    change.attr('type', 'text');
                } else {
                    change.attr('type', 'password');
                }
            });
        });
    </script>
@endsection
