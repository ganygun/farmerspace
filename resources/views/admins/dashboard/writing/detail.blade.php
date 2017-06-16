@extends('admins.layouts.master') @section('content')
<!--header start here-->
<div class="header-main" style="padding: 1.8em 2em;">
    <div class="header-center">
        <h2 style="margin-top: 0.3em;color: #6495ed">
            3 / 3
            <small style="font-size: 24px;font-weight: 300;">
                Choose article's detail
            </small>
        </h2>
        <div class="clearfix">
        </div>
    </div>
    <div class="clearfix">
    </div>
</div>
<!--heder end here-->

<!--inner block start here-->

<div class="inner-block">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="col-md-6 col-md-offset-3 chit-chat-layer1-left text-center" style="height: 100vh">
            <p class="text-center">@include('flash::message')</p>
            <a href="/admins/myarticle" class="btn btn-lg" style="border-radius: 0px;background-color: #6495ed;color:#fff">Submit</a>
        </div>
        <div class="clearfix">
        </div>
    </div>
    <!--main page chit chating end here-->
    <!--market updates updates-->
    <div class="market-updates">
    </div>
    <!--market updates end here-->
    <script>
        $( document ).ready(function() {
        $('#create-text a').css('color', '#5093E1');
        $('#create-text').css('border-left', '4px solid #5093E1');
    });
    </script>
</div>
<!--inner block end here-->
@endsection
