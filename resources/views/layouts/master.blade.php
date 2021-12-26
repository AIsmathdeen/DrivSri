<!DOCTYPE html>
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>DrivSri</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Mobile Specific Metas
    ================================================== -->

    <!-- CSS
    ================================================== -->
    <link rel="icon" type="image/x-icon" href="{{URL('/assets/img/favicon.ico')}}" />
    <link href="{{URL('/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{URL('/assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{URL('https://fonts.googleapis.com/css?family=Nunito:400,600,700')}}" rel="stylesheet">
    <link href="{{URL('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL('/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{URL('/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL('/assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL('css/jquery-confirm.css') }}"/>
    @yield('styles')

</head>


    <div id="wrapper">


        <!-- Header
================================================== -->
        @include('layouts.header')


        @yield('content')


        <!-- Footer
    ================================================== -->
        <div class="margin-top-15"></div>

        @include('layouts.footer')

        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>

    </div>

    <!-- Scripts
================================================== -->
    <script src=" {{URL('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src=" {{URL('bootstrap/js/popper.min.js')}}"></script>
    <script src=" {{URL('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src=" {{URL('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src=" {{URL('assets/js/app.js')}}"></script>
    <script src="{{URL('assets/js/custom.js')}} "></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src=" {{URL('plugins/apex/apexcharts.min.js')}} "></script>
    <script src=" {{URL('assets/js/dashboard/dash_1.js')}}"></script>
    <script src="{{URL('/js/jquery-confirm.js')}}"></script>
    @yield('scripts')
</body>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
