@extends('admins.layouts.master') @section('content')
<!--header start here-->
<div class="header-main">
    <div class="header-left">
        <h4 style="margin-top: 0.5em;">
                            Create Form / {{ app('request')->input('pname') }}
                        </h4>
        <div class="clearfix"> </div>
    </div>
    <div class="header-right">
        <form role="search" method="GET" action="{{ url('/admins/form/search') }}">
            {{ csrf_field() }}
            <!--search-box-->
            <div class="search-box">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <input type="submit" value="">
            </div>
        </form>
        <!--//end-search-box-->
        <div class="profile_details_left">
            <!--notifications of menu start -->
            <div class="clearfix"> </div>
        </div>
        <!--notification menu end -->
        <div class="profile_details">
            <ul>
                <li class="dropdown profile_details_drop">
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
<script>
    $(document).ready(function() {
        var navoffeset = $(".header-main").offset().top;
        $(window).scroll(function() {
            var scrollpos = $(window).scrollTop();
            if (scrollpos >= navoffeset) {
                $(".header-main").addClass("fixed");
            } else {
                $(".header-main").removeClass("fixed");
            }
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#submit').click(function() {
          checked = $("input[type=checkbox]:checked").length;

          if(!checked) {
            alert("You must check at least one checkbox.");
            return false;
          }

        });
    });
</script>

<!--inner block start here-->
<div class="inner-block">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left" style="margin-bottom: 40px;">
               <div class=" text-center">@include('flash::message')</div>
                <h1 class="text-center">{{ app('request')->input('formtype') }}</h1>
        </div>
        <form action="{{ url('admins/form') }}" method="POST">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <input type="checkbox" name="formselect[]" value="1">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> Product Detail</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                      <div class="panel-body"> <iframe src="https://form.jotform.me/70082447560454" frameborder="0" height="700px" width="100%" ></iframe></div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <input type="checkbox" name="formselect[]" value="2">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> Personal Information</a>
                      </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <iframe src="https://form.jotform.me/70082447560454" frameborder="0" height="700px" width="100%" ></iframe>
                        </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <input type="checkbox" name="formselect[]" value="3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"> Havest Information</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <div class="panel-body">
                        <iframe src="https://form.jotform.me/70082447560454" frameborder="0" height="700px" width="100%" ></iframe>
                      </div>
                    </div>
                  </div>
                </div>
            </div>


            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="hidden" name="formtype" value="{{ app('request')->input('formtype') }}">
            <div class="col-md-8 col-md-offset-2 ">
                <input type="submit" id="submit" class="btn btn-danger pull-right" style="margin: 10px;" value="Get Link">
                <a href="{{ url('admins/form/search?search=') }}{{ app('request')->input('pname') }}" class="btn btn-default pull-right" style="margin: 10px;">Cancel</a>
            </div>
        </form>
        <div class="clearfix"> </div>
    </div>
    <!--main page chit chating end here-->
    <!--market updates updates-->
    <div class="market-updates">
    </div>
    <!--market updates end here-->
</div>
<!--inner block end here-->

<script type="text/javascript">
    $('.collapse').collapse()
</script>

@endsection
