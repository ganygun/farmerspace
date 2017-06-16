<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Farmer Space | Administrator</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="{{ URL::asset('admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="{{ URL::asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="{{ URL::asset('admin/js/jquery-2.1.1.min.js') }}"></script>
<!--icons-css-->
<link href="{{ URL::asset('admin/css/font-awesome.css') }}" rel="stylesheet">
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Prompt:200,300,400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
<style>
    input,button{
         font-family: 'Prompt'!important;
         border-radius: 0px!important;
    }
    input[type = "text"]:focus,input[type = "password"]:focus{
        border-color: #1C7203;
    }
    input[type = "submit"]{
        color:#fff;
    }
    input[type = "submit"]:hover{
        color:#7A7B78;
    }
    label{
        color:#7A7B78;
        font-weight: 400;

    }
    .bg-side{
        background-image: url('{{ URL::asset('/admin/images/LoginPic.png') }}');
        -webkit-background-size:  contain;
        background-size:  cover;
        height: 100vh;
        background-repeat: no-repeat;
    }
    .highlight{
            font-family: 'Prompt';
            font-weight: 200;
            font-size: 26px;
            line-height: 1.3;
            color: #fff;
    }

    @media screen and (min-width: 15em) {
        .contain-page{
            margin-top:20px;
        }
        .contain-head{
            margin: auto;
            width: 80%;
            padding: 20px;
            min-height: 50px;

        }
        .contain-block{
            position:absolute;
            bottom:50px;
            margin-left: 130px;
        }
        .head-login{
            color:#1C7203;
            font-size: 38px;
            font-weight: 300;
            margin-bottom: 20px;
        }
        .bg-side{
        height: auto;
        }
        .highlight{
                font-size: 26px;
                font-weight: 300;
        }
    }
    @media screen and (min-width: 48em){
        .contain-page{
            margin-top:20%;
        }
        .contain-head{
            margin: auto;
            width: 80%;
            padding: 10px;
            min-height: 150px;

        }
        .contain-block{
            position:absolute;
            bottom:50px;
            margin-left: 130px;
        }
        .head-login{
            color:#1C7203;
            font-size: 56px;
            font-weight: 300;
            margin-bottom: 20px;
        }
        .bg-side{
            height: 100vh;
            }
        .highlight{
                font-size: 30px;
                font-weight: 300;
        }


    }

</style>
</head>
<body>

                    @yield('content')

<!--scrolling js-->
        <script src="{{ URL::asset('admin/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ URL::asset('admin/js/scripts.js">') }}</script>
        <!--//scrolling js-->
<script src="{{ URL::asset('admin/js/bootstrap.js') }}"> </script>
<!-- mother grid end here-->
</body>
</html>
