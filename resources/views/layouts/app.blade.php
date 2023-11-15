<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/flick/jquery-ui.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <title>{{ config('app.name', 'Koperasi Aneka Usaha Sido Makmur') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo/2.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/2.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2-materialize.css') }}" type="text/css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-dark-menu-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-dark-menu-template/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/data-tables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.min.css') }}">
    
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<body
    class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns   "
    data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    @include('layouts.partials.sidebar')

    <!-- BEGIN: Page Main-->
    <div id="main">
        @yield('content')
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2023<a href="{{route('home')}}"> Koperasi Aneka Usaha Sido Makmur</a> All rights
                    reserved.</span></div>
        </div>
    </footer>

    {{-- <script src="{{ asset('assets/js/vendors.min.js') }}"></script> --}}

    @include('layouts.partials.footer')


    @stack('scripts')
    <!-- END PAGE LEVEL JS-->
</body>

</html>
