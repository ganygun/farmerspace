<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <title>FarmerSpace</title>
    <meta property="article:publisher" content="{{ URL::to('/') }}">
    <meta property="fb:app_id" content="1911098772513014">
    <meta property="og:site_name" content="FarmerSpace">
    <!-- Change Meta News Content -->
        @if(!empty($Type))
            <meta property="og:title" name=title content="{{ $Title }}">
            <meta property="og:description" name=description content="{{ $Abstract }}">
            @if($Type == 'Article')
                <meta property="og:url" name=url content="{{ URL::to('/news/' . $ID) }}">
                <meta property="og:image" name=image content="{{ $Picture }}">
             @elseif($Type == 'Event')
                <meta property="og:url" name=url content="{{ URL::to('/event/' . $ID) }}">
                <meta property="og:image" name=image content="{{ $Picture }}">
            @elseif($Type == 'Video')
                <meta property="og:url" name=url content="{{ URL::to('/video/' . $ID) }}">
                <meta property="og:image" name=image content="https://www.youtube.com/embed/{{ $VdoUrl }}">
            @endif
        @else
            <meta property="og:title" name=title content="FarmerSpace">
            <meta property="og:url" name=url content="{{ URL::to('/') }}">
            <meta property="og:image" name=image content="{{ URL::asset('homepage/images/imgshare.png') }}">
            <meta property="og:description" name=description content="ร่วมผนึกกำลังโดยการสร้าง เครือข่ายสังคมภาคการเกษตร เพื่อพัฒนาศักยภาพ สร้างคุณค่าและคุณภาพชีวิตที่ยั่งยืน">
        @endif
    <!-- End Change Meta News Content -->
    
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
    <link href="{{ URL::asset('admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" id="thb-fa-css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="all">
    <link rel="stylesheet"  href="{{ URL::asset('homepage/css/style.css') }}" type="text/css" media="all">
    <link rel="stylesheet"  href="{{ URL::asset('homepage/css/custom.css') }}" type="text/css" media="all">
    <link rel="stylesheet"  href="{{ URL::asset('homepage/css/mnm_sharing.css') }}" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css?family=Prompt:300:400:500:600" rel="stylesheet">
    <link href="{{ URL::asset('homepage/css/imageviewer.css') }}"  rel="stylesheet" type="text/css" />

    <!--  <script>
          if (document.location.protocol != "https:") {
              document.location = document.URL.replace(/^http:/i, "https:");
          }
          </script> -->
    <!-- Google Analytics -->
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-100510869-1', 'auto');
      ga('send', 'pageview');

    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::asset('homepage/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('homepage/js/jquery-ias.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Sly/1.6.1/sly.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('homepage/js/sly-plugins.min.js') }}"></script>
    <script src="{{ URL::asset('homepage/js/imageviewer.min.js') }}"></script>
    <!-- custom css -->
    <style>
        @media screen and (min-width: 48em) {
            nav#full-menu .full-menu > li {
                width: 150px;
            }
        }

        .test {
            position: relative;
        }

        .test:after {
            position: absolute;
            bottom: 0;
            height: 100%;
            width: 100%;
            content: "";
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 20%, rgba(255, 255, 255, 0) 80%);
            pointer-events: none;
            /* so the text is still selectable */
        }

        .textwidget:hover {
            text-decoration: none
        }

        .post-title {
            font-family: 'Prompt', sans-serif;
        }
        /* limit text col */

        .social-header {
            color: #fff;
        }

        .social-header:hover {
            color: #00FF00;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#basic-addon2").hover(function() {
                $(this).css("background-color", "#1C7203");
                $(this).css("border-color", "#1C7203");
            }, function() {
                $(this).css("background-color", "#5d5d5d");
                $(this).css("border-color", "#5d5d5d");
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#basic-addon2").hover(function() {
                $("#key").css("border-color", "#1C7203");
            }, function() {
                $("#key").css("border-color", "#5d5d5d");
            });
        });
    </script>
    <script>
        $(document).click(function(e) {
            if (!$(e.target).is('#key')) {
                $("#basic-addon2").css("border-color", "#5d5d5d");
                $("#basic-addon2").css("background-color", "#5d5d5d");
                $("#key").css("border-color", "#5d5d5d");
            } else {
                $("#basic-addon2").css("border-color", "#1C7203");
                $("#basic-addon2").css("background-color", "#1C7203");
                $("#key").css("border-color", "#1C7203");
            }
        });
    </script>
    <!-- Alert -->
    <style>
        /* Alert */
        #note {
            /*position: fixed;
            z-index: 1030;
            top: 0;
            left: 0;
            right: 0;
            */
            background: #fde073;
            text-align: center;
            line-height: 2.5;
            overflow: hidden; 
        }

        @-webkit-keyframes slideDown {
        0%, 100% { -webkit-transform: translateY(-50px); }
        10%, 90% { -webkit-transform: translateY(0px); }
        }
        @-moz-keyframes slideDown {
            0%, 100% { -moz-transform: translateY(-50px); }
            10%, 90% { -moz-transform: translateY(0px); }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- Start Mobile Menu -->
        <nav id="mobile-menu">
            <div class="custom_scroll" id="menu-scroll">
                <div style="transform: translate(0px, 0px) translateZ(0px);">
                    <a href="#" class="close" style="color:#000">×</a>
                    <img src=" {{ URL::asset('homepage/images/LogoBergerBar.png') }}" class="logoimg" alt="">
                    <ul class="thb-mobile-menu">
                         <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-1841 current_page_item menu-item-1844"><a href="{{ URL::to('/') }}">หน้าหลัก</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1835"><a href="{{ URL::to('/news') }}">มุมข่าว</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1836"><a href="{{ URL::to('/video') }}">มุมวีดีโอ</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1836"><a href="{{ URL::to('/event') }}">มุมกิจกรรม</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1837"><a href="#">ไขปัญหาเกษตร</a></li>
                    </ul>
                    <div class="menu-footer">
                    </div>
                </div>
                <div class="iScrollVerticalScrollbar iScrollLoneScrollbar" style="position: absolute; z-index: 9999; width: 7px; bottom: 2px; top: 2px; right: 1px; overflow: hidden; transform: translateZ(0px); transition-duration: 0ms; opacity: 0;">
                    <div class="iScrollIndicator" style="box-sizing: border-box; position: absolute; background: rgba(0, 0, 0, 0.498039); border: 1px solid rgba(255, 255, 255, 0.901961); border-radius: 3px; width: 100%; transition-duration: 0ms; display: none; height: 561px; transform: translate(0px, 0px) translateZ(0px);"></div>
                </div>
            </div>
        </nav>
        <!-- End Mobile Menu -->
        <!-- Start Content Container -->
        <section id="content-container">
            <!-- Start Content Click Capture -->
            <div class="click-capture"></div>
            <!-- End Content Click Capture -->
            @if(!empty($preview)) 
                @if($preview=='true')
                    <div id="note" class=" alert-warning">
                      <strong>Warning!</strong>  This is a Preview Page | <span><a href="{{ URL::to('/admins/verify') }}" style="color:red">Back</a></span>
                    </div>
                @endif
            @endif
            @include('homepage.layouts.partials._header') @yield('content') @include('homepage.layouts.partials._footer')
        </section>
        <!-- End #content-container -->
    </div>
    <!-- End #wrapper -->
    <div id="thbSelectionSharerPopover " class="thb-selectionSharer " data-appid="830201083752701 " data-user="thematterco ">
        <div id="thb-selectionSharerPopover-inner ">
            <ul>
                <li><a class="action twitter " href="# " title="Share this selection on Twitter " target="_blank "><i class="fa fa-twitter "></i></a></li>
                <li><a class="action facebook " href="# " title="Share this selection on Facebook " target="_blank "><i class="fa fa-facebook "></i></a></li>
                <li><a class="action email " href="# " title="Share this selection by Email " target="_blank "><i class="fa fa-envelope "></i></a></li>
            </ul>
        </div>
    </div>
    <div style="display:none ">
    </div>
    @include('homepage.layouts.partials._scripts')
</body>

</html>
