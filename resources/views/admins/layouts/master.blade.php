<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>FarmerSpace</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- icon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('homepage/images/icon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('homepage/images/icon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('homepage/images/icon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('homepage/images/icon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('homepage/images/icon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('homepage/images/icon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('homepage/images/icon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('homepage/images/icon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('homepage/images/icon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('homepage/images/icon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('homepage/images/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('homepage/images/icon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('homepage/images/icon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::asset('homepage/images/icon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ URL::asset('homepage/images/icon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- end icon -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="{{ URL::asset('admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->

<link href="{{ URL::asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ URL::asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ URL::asset('admin/css/jquery.filer.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('admin/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel='stylesheet' type='text/css' />
<!--js-->

<script src="{{ URL::asset('admin/js/jquery-2.1.1.min.js') }}"></script>
<script src="{{ URL::asset('admin/js/custom.js') }}"></script>

<!--icons-css-->
<link href="{{ URL::asset('admin/css/font-awesome.css') }}" rel="stylesheet">
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Prompt:200,300,400,500,600' rel='stylesheet' type='text/css'>

<!--static chart-->
<script src="{{ URL::asset('admin/js/Chart.min.js') }}"></script>

<!--//charts-->
<!-- geo chart -->
      <!-- Chartinator  -->
      <style>
    .header-center {
    width: 100%;
    text-align: center;
}
</style>
    <script src="{{ URL::asset('admin/js/chartinator.js') }}" ></script>
    <script type="text/javascript">
        jQuery(function ($) {

            var chart3 = $('#geoChart').chartinator({
                tableSel: '.geoChart',

                columns: [{role: 'tooltip', type: 'string'}],

                colIndexes: [2],

                rows: [
                    ['China - 2015'],
                    ['Colombia - 2015'],
                    ['France - 2015'],
                    ['Italy - 2015'],
                    ['Japan - 2015'],
                    ['Kazakhstan - 2015'],
                    ['Mexico - 2015'],
                    ['Poland - 2015'],
                    ['Russia - 2015'],
                    ['Spain - 2015'],
                    ['Tanzania - 2015'],
                    ['Turkey - 2015']],

                ignoreCol: [2],

                chartType: 'GeoChart',

                chartAspectRatio: 1.5,

                chartZoom: 1.75,

                chartOffset: [-12,0],

                chartOptions: {

                    width: null,

                    backgroundColor: '#fff',

                    datalessRegionColor: '#F5F5F5',

                    region: 'world',

                    resolution: 'countries',

                    legend: 'none',

                    colorAxis: {

                        colors: ['#679CCA', '#337AB7']
                    },
                    tooltip: {

                        trigger: 'focus',

                        isHtml: true
                    }
                }


            });
        });
    </script>
<!--geo chart-->

<!--skycons-icons-->
<script src="{{ URL::asset('admin/js/skycons.js') }}"></script>
<!--//skycons-icons-->



</head>
    <body id="page-top" class="index">
         <div class="page-container">
            <div class="left-content">
                <div class="mother-grid-inner">
                    @yield('content')
                    @include('admins.layouts.partials._footer')
                </div>
            </div>
        @include('admins.layouts.partials._sidebar')
        @include('admins.layouts.partials._scripts')
        </div>
    </body>
</html>