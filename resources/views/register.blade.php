<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link href="css/admin_assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="css/admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="css/admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="css/admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet"
        media="all">
    <link href="css/admin_assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="css/admin_assets/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                ADMIN
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('data.register') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="name"
                                        placeholder="Username" value="{{old('name')}}">
                                    @error('name')
                                        <p style="color: #007BFF">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email"
                                        placeholder="Email" value="{{old('email')}}">
                                    @error('email')
                                        <p style="color: #007BFF">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password"
                                        placeholder="Password">
                                        {{-- @error('password')
                                        <p style="color: #007BFF">{{ $message }}</p>
                                    @enderror --}}
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" type="password" name="password_confirmation"
                                        placeholder="Confirm Password">
                                    @error('password')
                                        <p style="color: #007BFF">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign
                                    in</button>

                                <p>Already Have An Account ? <a href="{{ url('/') }}">Sign In</a></p>

                                {{-- @if (session()->has('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    {{session('error')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="css/admin_assets/vendor/jquery-3.2.1.min.js"></script>
    <script src="css/admin_assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="css/admin_assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="css/admin_assets/vendor/wow/wow.min.js"></script>
    <script src="css/admin_assets/js/main.js"></script>
</body>

</html>
