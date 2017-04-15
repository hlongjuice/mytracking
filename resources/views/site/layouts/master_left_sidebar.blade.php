<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.theme.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.structure.min.css')}}" rel="styleshhet">
    <link href="{{asset('css/my_tracking.css')}}" rel="stylesheet">
    {{--Yamm is Mega Menu--}}
    <link href="{{ asset('css/yamm-3/yamm.css') }}" rel="stylesheet">

    @yield('add_css')
</head>
<body class="nav-md">
{{--Nav Bar--}}
<section id="nav-bar">
    @include('site.layouts.nav_bar')
    @yield('nav-bar')
</section>
<div class="main container-fluid">

    {{--Side Menu--}}
    <section id="side-menu">
        <div class="col-xs-12 col-md-3">
            @include('site.layouts.side_menu')
            @yield('side_menu_top')
            {{--@include('site.layouts.master_side_menu')--}}
            @yield('side_menu_bottom')
        </div>
    </section>

    {{--Main Content--}}
    <section id="main-content">
        <div class="col-xs-12 col-md-9">
            @yield('content')
        </div>
    </section>
</div>



    {{--Script--}}

 <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    {{--<script src="{{asset('js/jquery.min.js')}}"></script>--}}
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.min.js')}}"></script>

    @yield('script')
    <script src="{{asset('template/gentelella/build/js/custom.js')}}"></script>
</body>

</html>