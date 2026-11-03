<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>title</title>
    <link href="{{ asset('css/admin_assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('css/admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
        media="all">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        media="all">
    <link href="{{ asset('css/admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('css/admin_assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/admin_assets/css/theme.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{ asset('cssdemo/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cssdemo/owl.theme.green.min.css') }}">
    @if(Auth::user()->role == 'Admin')
        <link rel="stylesheet" href="{{ asset('cssdemo/admin_css.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('cssdemo/styledemo.css') }}">
    <link rel="stylesheet" href="{{ asset('cssdemo/newstyle.css') }}">

</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{ route('dashboard') }}">
                            <img src="{{ asset('image/CreativeLogo.png') }}" alt="Creative design & multimedia institute"
                                class="w-lg-100 w-75 " />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"><i class="fas fa-list"></i></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="@yield('dashboard_select')">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        @if(Auth::user()->role == 'Admin')
                        <li class="@yield('customer_select')">
                            <a href="{{ route('view.users') }}">
                                <i class="fa fa-user"></i> Manage Users</a>
                        </li>
                        @endif
                        {{-- @if (Auth::user()->role == 'admin') --}}
                        <li class="@yield('order_select')">
                            <a href="{{ route('view.lang') }}">
                                <i class="fas fa-tag"></i>Manage Language</a>
                        </li>
                        <li class="@yield('product_review_select')">
                            <a href="{{ route('view.topics') }}">
                                <i class="fas fa-star"></i>Manage Topics</a>
                        </li>
                        {{-- @endif --}}
                        <li class="@yield('category_select')">
                            <a href="{{ route('view.que') }}">
                                <i class="fas fa-list"></i>Manage Questions</a>
                        </li>

                        {{-- <li class="@yield('coupon_select')">
                            <a href="coupon.html">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li> --}}

                        <li class="@yield('size_select')">
                            <a href="{{ route('view1.que') }}">
                                <i class="fas fa-window-maximize"></i>View Questions</a>
                        </li>
                        <li class="@yield('home_banner_select')">
                            <a href="{{ route('recent.paper') }}">
                                <i class="fas fa-images"></i>Recent Questions Paper</a>
                        </li>

                        {{-- <li class="@yield('brand_select')">
                            <a href="brand.html">
                                <i class="fa fa-bold"></i>Brand</a>
                        </li>

                        <li class="@yield('color_select')">
                            <a href="color.html">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>

                        <li class="@yield('tax_select')">
                            <a href="admin/tax">
                                <i class="fas fa-percent"></i>Tax</a>
                        </li>

                        <li class="@yield('product_select')">
                            <a href="admin/product">
                                <i class="fa fa-product-hunt"></i>Product</a>
                        </li>  --}}


                        {{-- <li class="@yield('home_banner_select')">
                            <a href="settings.html">
                                <i class="fas fa-images"></i>Website Settings</a>
                        </li>  --}}
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('image/CreativeLogo.png') }}" width="200px" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_select')">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        @if(Auth::user()->role == 'Admin')
                        <li class="@yield('customer_select')">
                            <a href="{{ route('view.users') }}">
                                <i class="fa fa-user"></i> Manage Users</a>
                        </li>
                        @endif
                        {{-- @if (Auth::user()->role == 'admin') --}}
                        <li class="@yield('order_select')">
                            <a href="{{ route('view.lang') }}">
                                <i class="fas fa-tag"></i>Manage Language</a>
                        </li>
                        <li class="@yield('product_review_select')">
                            <a href="{{ route('view.topics') }}">
                                <i class="fas fa-star"></i>Manage Topics</a>
                        </li>
                        {{-- @endif --}}
                        <li class="@yield('category_select')">
                            <a href="{{ route('view.que') }}">
                                <i class="fas fa-list"></i>Manage Questions</a>
                        </li>

                        {{-- <li class="@yield('coupon_select')">
                            <a href="coupon.html">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li> --}}

                        <li class="@yield('size_select')">
                            <a href="{{ route('view1.que') }}">
                                <i class="fas fa-window-maximize"></i>View Questions</a>
                        </li>

                        {{-- <li class="@yield('brand_select')">
                            <a href="brand.html">
                                <i class="fa fa-bold"></i>Brand</a>
                        </li>

                         <li class="@yield('color_select')">
                            <a href="color.html">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>

                        <li class="@yield('tax_select')">
                            <a href="admin/tax">
                                <i class="fas fa-percent"></i>Tax</a>
                        </li>

                        <li class="@yield('product_select')">
                            <a href="admin/product">
                                <i class="fa fa-product-hunt"></i>Product</a>
                        </li>   --}}


                        <li class="@yield('home_banner_select')">
                            <a href="{{ route('recent.paper') }}">
                                <i class="fas fa-images"></i>Recent Questions Paper</a>
                        </li> 


                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome {{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__footer">
                                                <a href="{{ route('logout') }}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                @yield('main')
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    @yield('ajax')
    <script src="{{ asset('css/admin_assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('css/admin_assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('css/admin_assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('css/admin_assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('css/admin_assets/js/main.js') }}"></script>
   
</body>

</html>
