@extends('admins.layouts.master') @section('content')
<!--header start here-->
<style>
    div.pager {
        text-align: right;
        margin: 0 0 10px 0;
    }

    div.pager span {
        display: inline-block;
        width: 1.8em;
        height: 1.8em;
        line-height: 1.8;
        text-align: center;
        cursor: pointer;
        background: #fff;
        color: #9DA5BE;
        margin-right: 0.5em;
        font-weight: 500;
    }

    div.pager span.active {
        background: #6495ed;
        color: #fff;
    }
    h3 {
        font-weight: 300;
        /*color: #6495ed;*/
        color: #9DA5BE;
        margin-bottom: 10px;

    }

    .borderless td,
    .borderless th {
        vertical-align: middle!important;
        border-top: none!important;
    }

    table {
        margin-top: 20px;
        background-color: #fff;
    }

    td {
        padding: 15px!important;
    }

    .tag {
        color: #fff;
        padding: 8px;
        background-color: #66CC00;
        font-size: 12px;
        font-weight: 300;
    }

    .btn_news_func {
        margin: 0 3px;
        border: 2px solid #6495ed;
        border-radius: 50%;
        background-color: transparent;
        color: #fff;
        outline: none;
        width: 35px;
        height: 35px;
        padding: 3px;
    }

    .btn_news_func i {
        vertical-align: middle;
    }

    .title {
        word-break: break-word;
        overflow: hidden;
        display: -webkit-box;
        line-height: 25px!important;
        /* fallback */
        max-height: 65px;
        /* fallback */
        -webkit-line-clamp: 2;
        /* number of lines to show */
        -webkit-box-orient: vertical;
        padding-top: 18px!important;
        padding-right: 60px!important;
    }

    .title,
    .text_date {
        color: #9DA5BE;
    }
    table.fixeds { table-layout:fixed; }
    table.fixeds td { overflow: hidden; }
    table { width: 1017px!important; }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #6495ed;
    cursor: default;
    background-color: #F0F0F2;
    border: none;
    }
</style>
<!--Star Rating-->
<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    fieldset, label { margin: 0; padding: 0; }

    /****** Style Star Rating Widget *****/

    .rating {
      border: none;
      float: left;
    }

    .rating > input { display: none; }
    .rating > label:before {
      margin:5px 2px;
      font-size: 1.25em;
      font-family: FontAwesome;
      display: inline-block;
      content: "\f005";
    }

    .rating > .half:before {
      content: "\f089";
      position: absolute;
    }

    .rating > label {
      color: #ddd;
     float: right;
    }

    table {
        margin: 0 auto;
    }
    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input.checked ~ label { color: #FFD700;  } /* hover previous stars in list */
</style>
<!--//Star Rating-->

<div class="header-main" style="padding: 0em 2em 0em 1em!important;">
    <div class="header-left">
        <div class="logo-name text-center">
            @if(!empty($profile_picture))
            <img alt="Profile" src="{{ $profile_picture }}" class="img" style="width: 100px;height: 100px;" />
            @else
            <img alt="Profile" src="{{ URL::asset('/admin/images/icon_profile.png') }}" class="img" style="width: 100px;height: 100px;" />
            @endif
        </div>
        @if (session('key'))
        <p style="font-size: 28px;color: #6495ed;font-weight: 300;margin-top: 20px">
            {{ $myname }}
        </p>
        <p style="font-size: 20px;color: #C9C9C9;font-weight: 300;">
            {{ $Company }}
        </p>
        @endif
        <div class="clearfix">
        </div>
    </div>
    <div class="header-right">

        <!--//end-search-box-->
        <div class="profile_details_left">
            <!--notifications of menu start -->

            <div class="clearfix">
            </div>
        </div>
        <!--notification menu end -->
        <div class="profile_details">
            <div>
                <span class="label label-success pull-right" style="padding: 10px;font-size: 16px;font-weight: 300;background-color: #66CC00;margin-top: 20px">
                   {{ strtoupper(session('role')) }}
                </span>
            </div>
            <div>
                <fieldset class="rating">
                                        <!-- 0 star -->
                                        @if (number_format($star,1) >= 0.0 && number_format($star,1) < 0.5 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 0.5 star -->
                                        @elseif (number_format($star,1) >= 0.5 && number_format($star,1) < 1)
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input class="checked" type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 1 star -->
                                        @elseif (number_format($star,1) >= 1 && number_format($star,1) < 1.5 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input class="checked" type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 1.5 star -->
                                        @elseif (number_format($star,1) >= 1.5 && number_format($star,1) < 2 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input class="checked" type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 2 star -->
                                        @elseif (number_format($star,1) >= 2 && number_format($star,1) < 2.5 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input class="checked" type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 2.5 star -->
                                        @elseif (number_format($star,1) >= 2.5 && number_format($star,1) < 3 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input class="checked" type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                         <!-- 3 star -->
                                        @elseif (number_format($star,1) >= 3 && number_format($star,1) < 3.5 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input class="checked" type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                         <!-- 3.5 star -->
                                        @elseif (number_format($star,1) >= 3.5 && number_format($star,1) < 4 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input class="checked" type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 4 star -->
                                        @elseif (number_format($star,1) >= 4 && number_format($star,1) < 4.5 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input class="checked" type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 4.5 star -->
                                        @elseif (number_format($star,1) >= 4.5 && number_format($star,1) < 5 )
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input class="checked" type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        <!-- 5 star  -->
                                        @elseif (number_format($star,1) == 5)
                                            <input class="checked" type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars" ></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"  />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        @endif
                </fieldset>
            </div>
        </div>
        <div class="clearfix">
        </div>
    </div>
    <div class="clearfix">
    </div>
</div>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block" style="min-height:100vh">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="col-md-12 chit-chat-layer1-left ">
            <div class="row" style="padding:0 2em;">
                @if($result == 'have')
                <!-- Pending Review -->
                    <h3>Pending Review</h3>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#PendingArticle" >Article</a></li>
                        <li><a data-toggle="tab" href="#PendingVideo" >Video</a></li>
                        <li><a data-toggle="tab" href="#PendingEvent" >Event</a></li>
                    </ul>
                    <div class="tab-content">
                    <!-- Article Zone -->
                        <div id="PendingArticle" class="tab-pane fade in active">
                            <!-- False News -->
                                    @if(!empty($jsonDecodeNewsFalse['dataListNews']))
                                    <div id="table">
                                            <table class="tablep2 borderless fixeds paginated" >
                                                <tbody>
                                                <col width="25px" />
                                                <col width="75px" />
                                                <col width="70px" />
                                                <col width="40px" />
                                                <col width="50px" />
                                                    @foreach($jsonDecodeNewsFalse['dataListNews'] as $dataListNewsFalse)
                                                    <form action="/admins/writing/{{ $dataListNewsFalse['NewsID'] }}/edit" method="POST">
                                                        <input name="Title" type="hidden" value="{{ $dataListNewsFalse['Title'] }}">
                                                        <input name="Abstract" type="hidden" value="{{ $dataListNewsFalse['Abstract'] }}">
                                                        <input name="Detail" type="hidden" value="{{ $dataListNewsFalse['Detail'] }}">
                                                        <input name="Picture" type="hidden" value="{{ $dataListNewsFalse['Picture'] }}">
                                                        <input name="Tag" type="hidden" value="{{ $dataListNewsFalse['Tag'] }}">
                                                        <input name="CreatedDate" type="hidden" value="{{ $dataListNewsFalse['CreatedDate'] }}">
                                                        <input name="CreatedBy" type="hidden" value="{{ $dataListNewsFalse['CreatedBy'] }}">
                                                        <input name="ProductID" type="hidden" value="{{ $dataListNewsFalse['ProductID'] }}">
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                        <tr style="border-bottom: 10px #F0F0F2 solid;">
                                                            <td style="padding-left: 30px!important;">
                                                                <img class="center-block" src="{{ $dataListNewsFalse['Picture'] }}" alt="" width="60" height="60">
                                                            </td>
                                                            <td class="title">
                                                                {{ $dataListNewsFalse['Title'] }}
                                                            </td>
                                                            <td>
                                                                @foreach(explode(',', $dataListNewsFalse['Tag']) as $key => $info )
                                                                @if($key<3)
                                                                    <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                                                        <h4> <span class="label tag">{{$info}}</span></h4>
                                                                        <input name="tagsName[]" type="hidden" value="{{$info}}">
                                                                    </div>
                                                                @endif @endforeach
                                                            </td>
                                                            <td class="text_date">
                                                            <div class="text-center">
                                                                {{ Carbon\Carbon::parse($dataListNewsFalse['CreatedDate'])->format('d / m / Y') }}
                                                            </div>
                                                            </td>
                                                            <td width="" style="text-align: left;padding-right: 30px!important;">
                                                            <a class="btn btn-lg btn_news_func" href="{{ URL::to('/news/'.$dataListNewsFalse['NewsID'] .'?preview=true&type=article') }}">
                                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                                            </a>
                                                            <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteNews('{{ $dataListNewsFalse['Title'] }}','{{ $dataListNewsFalse['NewsID'] }}')">
                                                                <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                                            </a>
                                                            <button class="btn btn-lg btn_news_func" type="submit">
                                                                <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                                            </button>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                     @else
                                    <div class="col-md-12 text-center">
                                        <h3 style="color:#DDDDDD;">ไม่พบบทความ</h3>
                                    </div>
                                    @endif
                        </div>
                    <!-- Video Zone -->
                        <div id="PendingVideo" class="tab-pane fade">
                                @if(!empty($jsonDecodeVideoFalse['dataListVDO']))
                                <div id="table">
                                    <table class="tablep2 borderless fixeds paginated" >
                                        <tbody>
                                            <col width="25px" />
                                            <col width="75px" />
                                            <col width="70px" />
                                            <col width="40px" />
                                            <col width="50px" />
                                             @foreach($jsonDecodeVideoFalse['dataListVDO'] as $dataListVDOFalse)
                                            <form action="/admins/writing/{{ $dataListVDOFalse['VdoID'] }}/edit" method="POST">                                                          
                                                <input name="Title" type="hidden" value="{{ $dataListVDOFalse['Headline'] }}">
                                                <input name="Picture" type="hidden" value="{{ $dataListVDOFalse['VdoUrl'] }}">
                                                <input name="Abstract" type="hidden" value="{{ $dataListVDOFalse['Highlight'] }}">
                                                <input name="Tag" type="hidden" value="{{ $dataListVDOFalse['Tag'] }}">
                                                <input name="CreatedDate" type="hidden" value="{{ $dataListVDOFalse['CreatedDate'] }}">
                                                <input name="CreatedBy" type="hidden" value="{{ $dataListVDOFalse['CreatedBy'] }}">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                <tr style="border-bottom: 10px #F0F0F2 solid;">
                                                    <td style="padding-left: 30px!important;">
                                                        <img class="center-block" src="{{ URL::asset('/admin/images/icon_vdo.png') }}" alt="" width="60" height="60">
                                                    </td>
                                                    <td class="title">
                                                        {{ $dataListVDOFalse['Headline'] }}
                                                    </td>
                                                    <td>
                                                    @foreach(explode(',', $dataListVDOFalse['Tag']) as $key => $info )
                                                    @if($key<3)
                                                    <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                                        <h4> <span class="label tag">{{$info}}</span></h4>
                                                        <input name="tagsName[]" type="hidden" value="{{$info}}">
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                    </td>
                                                    <td class="text_date">
                                                    <div class="text-center">
                                                                {{ Carbon\Carbon::parse($dataListVDOFalse['CreatedDate'])->format('d / m / Y') }}
                                                    </div>
                                                    </td>
                                                    <td width="" style="text-align: left;padding-right: 30px!important;">
                                                    <a class="btn btn-lg btn_news_func" href="{{ URL::to('/video/'.$dataListVDOFalse['VdoID'] .'?preview=true&type=video') }}">
                                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                                    </a>
                                                    <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteVideo('{{ $dataListVDOFalse['Headline'] }}','{{ $dataListVDOFalse['VdoID'] }}')">
                                                        <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                                    </a>
                                                    <button class="btn btn-lg btn_news_func" type="submit">
                                                        <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                                    </button>
                                                </td>
                                                </tr>
                                            </form>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="col-md-12 text-center" style="margin:20px 0">
                                    <h3 style="color:#DDDDDD;">ไม่พบบทความ</h3>
                                </div>
                                @endif
                        </div>
                    <!-- Event Zone -->
                        <div id="PendingEvent" class="tab-pane fade">
                                @if(!empty($jsonDecodeEventFalse['dataListEvent']))
                                <div id="table">
                                        <table class="tablep2 borderless fixeds paginated">
                                            <tbody>
                                            <col width="25px" />
                                            <col width="75px" />
                                            <col width="70px" />
                                            <col width="40px" />
                                            <col width="50px" />
                                                @foreach($jsonDecodeEventFalse['dataListEvent'] as $dataListEventFalse)
                                                <form action="/admins/writing/{{ $dataListEventFalse['EventID'] }}/edit" method="POST">
                                                    <input name="Title" type="hidden" value="{{ $dataListEventFalse['Headline'] }}">
                                                    <input name="Abstract" type="hidden" value="{{ $dataListEventFalse['Highlight'] }}">
                                                    <input name="Detail" type="hidden" value="{{ $dataListEventFalse['Content'] }}">
                                                    <input name="Picture" type="hidden" value="{{ $dataListEventFalse['HeadlinePic'] }}">
                                                    <input name="Tag" type="hidden" value="{{ $dataListEventFalse['Tag'] }}">
                                                    <input name="CreatedDate" type="hidden" value="{{ $dataListEventFalse['CreatedDate'] }}">
                                                    <input name="CreatedBy" type="hidden" value="{{ $dataListEventFalse['CreatedBy'] }}">
                                                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                    <tr style="border-bottom: 10px #F0F0F2 solid;">
                                                        <td style="padding-left: 30px!important;">
                                                            <img class="center-block" src="{{ $dataListEventFalse['HeadlinePic'] }}" alt="" width="60" height="60">
                                                        </td>
                                                        <td class="title">
                                                            {{ $dataListEventFalse['Headline'] }}
                                                        </td>
                                                        <td>
                                                            @foreach(explode(',', $dataListEventFalse['Tag']) as $key => $info )
                                                            @if($key<3)
                                                                <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                                                    <h4> <span class="label tag">{{$info}}</span></h4>
                                                                    <input name="tagsName[]" type="hidden" value="{{$info}}">
                                                                </div>
                                                            @endif @endforeach
                                                        </td>
                                                        <td class="text_date">
                                                        <div class="text-center">
                                                            {{ Carbon\Carbon::parse($dataListEventFalse['CreatedDate'])->format('d / m / Y') }}
                                                        </div>
                                                        </td>
                                                        <td width="" style="text-align: left;padding-right: 30px!important;">
                                                        <a class="btn btn-lg btn_news_func" href="{{ URL::to('/event/'.$dataListEventFalse['EventID'] .'?preview=true&type=event') }}">
                                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                                        </a>
                                                        <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteEvent('{{ $dataListEventFalse['Headline'] }}','{{ $dataListEventFalse['EventID'] }}')">
                                                            <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                                        </a>
                                                        <button class="btn btn-lg btn_news_func" type="submit">
                                                            <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                                        </button>
                                                        </td>
                                                    </tr>
                                                </form>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                @else
                                <div class="col-md-12 text-center" style="margin:20px 0">
                                    <h3 style="color:#DDDDDD;">ไม่พบบทความ</h3>
                                </div>
                                @endif
                        </div>
                    </div>
               
                <!-- Publiced -->
                    <h3>Publiced</h3>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#PublicedArticle" >Article</a></li>
                        <li><a data-toggle="tab" href="#PublicedVideo" >Video</a></li>
                        <li><a data-toggle="tab" href="#PublicedEvent" >Event</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Article Zone -->
                            <div id="PublicedArticle" class="tab-pane fade in active">
                                <!-- True News  -->
                                    @if(!empty($jsonDecodeNewsTrue['dataListNews']))
                                    <div id="table">
                                            <table class="tablep5 borderless fixeds paginated">
                                                <tbody>
                                                <col width="25px" />
                                                <col width="75px" />
                                                <col width="70px" />
                                                <col width="40px" />
                                                <col width="50px" />
                                                    @foreach($jsonDecodeNewsTrue['dataListNews'] as $dataListNewsTrue)
                                                    <form action="/admins/writing/{{ $dataListNewsTrue['NewsID'] }}/edit" method="POST">
                                                        <input name="Title" type="hidden" value="{{ $dataListNewsTrue['Title'] }}">
                                                        <input name="Abstract" type="hidden" value="{{ $dataListNewsTrue['Abstract'] }}">
                                                        <input name="Detail" type="hidden" value="{{ $dataListNewsTrue['Detail'] }}">
                                                        <input name="Picture" type="hidden" value="{{ $dataListNewsTrue['Picture'] }}">
                                                        <input name="Tag" type="hidden" value="{{ $dataListNewsTrue['Tag'] }}">
                                                        <input name="CreatedDate" type="hidden" value="{{ $dataListNewsTrue['CreatedDate'] }}">
                                                        <input name="CreatedBy" type="hidden" value="{{ $dataListNewsTrue['CreatedBy'] }}">
                                                        <input name="ProductID" type="hidden" value="{{ $dataListNewsTrue['ProductID'] }}">
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                        <tr style="border-bottom: 10px #F0F0F2 solid;">
                                                            <td style="padding-left: 30px!important;">
                                                                <img class="center-block" src="{{ $dataListNewsTrue['Picture'] }}" alt="" width="60" height="60">
                                                            </td>
                                                            <td class="title">
                                                                {{ $dataListNewsTrue['Title'] }}
                                                            </td>
                                                            <td>
                                                                @foreach(explode(',', $dataListNewsTrue['Tag']) as $key => $info )
                                                                @if($key<3)
                                                                    <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                                                        <h4> <span class="label tag">{{$info}}</span></h4>
                                                                        <input name="tagsName[]" type="hidden" value="{{$info}}">
                                                                    </div>
                                                                @endif @endforeach
                                                            </td>
                                                            <td class="text_date">
                                                            <div class="text-center">
                                                                {{ Carbon\Carbon::parse($dataListNewsTrue['CreatedDate'])->format('d / m / Y') }}
                                                            </div>
                                                            </td>
                                                            <td width="" style="text-align: left;padding-right: 30px!important;">
                                                             <a class="btn btn-lg btn_news_func" href="{{ URL::to('/news/'.$dataListNewsTrue['NewsID']) }}">
                                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                                            </a>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                    @else
                                    <div class="col-md-12 text-center" style="margin:20px 0">
                                        <h3 style="color:#DDDDDD;">ไม่พบบทความ</h3>
                                    </div>
                                    @endif
                            </div>
                        <!-- Video Zone -->
                            <div id="PublicedVideo" class="tab-pane fade">
                                    @if(!empty($jsonDecodeVideoTrue['dataListVDO']))
                                    <div id="table">
                                        <table class="tablep5 borderless fixeds paginated" >
                                            <tbody>
                                                <col width="25px" />
                                                <col width="75px" />
                                                <col width="70px" />
                                                <col width="40px" />
                                                <col width="50px" />
                                                 @foreach($jsonDecodeVideoTrue['dataListVDO'] as $dataListVDOTrue)
                                                <form action="/admins/writing/{{ $dataListVDOTrue['VdoID'] }}/edit" method="POST">                                                          
                                                    <input name="Title" type="hidden" value="{{ $dataListVDOTrue['Headline'] }}">
                                                    <input name="VdoUrl" type="hidden" value="{{ $dataListVDOTrue['VdoUrl'] }}">
                                                    <input name="Abstract" type="hidden" value="{{ $dataListVDOTrue['Highlight'] }}">
                                                    <input name="Tag" type="hidden" value="{{ $dataListVDOTrue['Tag'] }}">
                                                    <input name="CreatedDate" type="hidden" value="{{ $dataListVDOTrue['CreatedDate'] }}">
                                                    <input name="CreatedBy" type="hidden" value="{{ $dataListVDOTrue['CreatedBy'] }}">
                                                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                    <tr style="border-bottom: 10px #F0F0F2 solid;">
                                                        <td style="padding-left: 30px!important;">
                                                        <img class="center-block" src="{{ URL::asset('/admin/images/icon_vdo.png') }}" alt="" width="60" height="60">
                                                        </td>
                                                        <td class="title">
                                                            {{ $dataListVDOTrue['Headline'] }}
                                                        </td>
                                                        <td>
                                                        @foreach(explode(',', $dataListVDOTrue['Tag']) as $key => $info )
                                                        @if($key<3)
                                                        <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                                            <h4> <span class="label tag">{{$info}}</span></h4>
                                                            <input name="tagsName[]" type="hidden" value="{{$info}}">
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                        </td>
                                                        <td class="text_date">
                                                        <div class="text-center">
                                                                    {{ Carbon\Carbon::parse($dataListVDOTrue['CreatedDate'])->format('d / m / Y') }}
                                                        </div>
                                                        </td>
                                                        <td width="" style="text-align: left;padding-right: 30px!important;">
                                                       <a class="btn btn-lg btn_news_func" href="{{ URL::to('/video/'.$dataListVDOTrue['VdoID']) }}">
                                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                                        </a>
                                                    </td>
                                                    </tr>
                                                </form>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="col-md-12 text-center" style="margin:20px 0">
                                        <h3 style="color:#DDDDDD;">ไม่พบบทความ</h3>
                                    </div>
                                    @endif
                            </div>
                        <!-- Event Zone -->
                            <div id="PublicedEvent" class="tab-pane fade">
                                    @if(!empty($jsonDecodeEventTrue['dataListEvent']))
                                    <div id="table">
                                            <table class="tablep5 borderless fixeds paginated">
                                                <tbody>
                                                <col width="25px" />
                                                <col width="75px" />
                                                <col width="70px" />
                                                <col width="40px" />
                                                <col width="50px" />
                                                    @foreach($jsonDecodeEventTrue['dataListEvent'] as $dataListEventTrue)
                                                    <form action="/admins/writing/{{ $dataListEventTrue['EventID'] }}/edit" method="POST">
                                                        <input name="Title" type="hidden" value="{{ $dataListEventTrue['Headline'] }}">
                                                        <input name="Abstract" type="hidden" value="{{ $dataListEventTrue['Highlight'] }}">
                                                        <input name="Detail" type="hidden" value="{{ $dataListEventTrue['Content'] }}">
                                                        <input name="Picture" type="hidden" value="{{ $dataListEventTrue['HeadlinePic'] }}">
                                                        <input name="Tag" type="hidden" value="{{ $dataListEventTrue['Tag'] }}">
                                                        <input name="CreatedDate" type="hidden" value="{{ $dataListEventTrue['CreatedDate'] }}">
                                                        <input name="CreatedBy" type="hidden" value="{{ $dataListEventTrue['CreatedBy'] }}">
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                        <tr style="border-bottom: 10px #F0F0F2 solid;">
                                                            <td style="padding-left: 30px!important;">
                                                                <img class="center-block" src="{{ $dataListEventTrue['HeadlinePic'] }}" alt="" width="60" height="60">
                                                            </td>
                                                            <td class="title">
                                                                {{ $dataListEventTrue['Headline'] }}
                                                            </td>
                                                            <td>
                                                                @foreach(explode(',', $dataListEventTrue['Tag']) as $key => $info )
                                                                @if($key<3)
                                                                    <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                                                        <h4> <span class="label tag">{{$info}}</span></h4>
                                                                        <input name="tagsName[]" type="hidden" value="{{$info}}">
                                                                    </div>
                                                                @endif @endforeach
                                                            </td>
                                                            <td class="text_date">
                                                            <div class="text-center">
                                                                {{ Carbon\Carbon::parse($dataListEventTrue['CreatedDate'])->format('d / m / Y') }}
                                                            </div>
                                                            </td>
                                                            <td width="" style="text-align: left;padding-right: 30px!important;">
                                                            <a class="btn btn-lg btn_news_func" href="{{ URL::to('/event/'.$dataListEventTrue['EventID']) }}">
                                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                                            </a>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                    @else
                                    <div class="col-md-12 text-center" style="margin:20px 0">
                                        <h3 style="color:#DDDDDD;">ไม่พบบทความ</h3>
                                    </div>
                                    @endif
                            </div>
                    </div>
              
                @elseif($result == 'donthave')
                <div class="col-md-12 text-center" style="height: 100vh">
                    <h3 style="font-size:2.5em;color:rgb(80, 147, 225);margin-top: 80px">บทความของคุณยังไม่ถูกเขียน</h3>
                    <div style="margin: 40px;font-size: 18px;color: #9DA5BE">FarmerSpace นอกจากจะเป็นแหล่งเรียนรู้ของเหล่าเกษตรกรแล้ว
                        <br> ยังเป็นพื้นที่แสดงฝีมือของคุณผ่านงานเขียน อันจะเป็นประโยชน์โดยตรงกับเกษตรกร
                        <br> เรารู้ว่าคุณทำได้ มาร่วมเป็นหนึ่งกำลังในการพัฒนาศักยภาพเกษตรกร
                        <br> สร้างคุณค่า และเพื่อคุณภาพสังคมที่ยั่งยืน </div>
                    <a class="btn btn-lg" href="{{ url('/admins/writing') }}" style="border-radius: 0px;background-color: #6495ed;color:#fff">
                        <span>
                            <h3 style="font-size:1.5em;padding: 4px 50px;color:#fff;margin-top: 10px;">  เริ่มเขียนบทความ
                                <i aria-hidden="true" class="fa fa-pencil" style="margin-bottom: 0px;padding-left:10px">
                                </i>
                            </h3>
                        </span>
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="clearfix">
        </div>
        </div>
<!--main page chit chating end here-->
<!--market updates updates-->
<div class="market-updates">
</div>
<!--market updates end here-->
<script type="text/javascript">
    function DeleteEvent(Headline,id) {
        if (confirm('Do you want to delete Event : ' + Headline)) {
            var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteEvent", "EventID": id});
            fetch(url,{
                    mode: 'no-cors',
                    method: 'get',
                });
                location.reload();
        } else {
            // Do nothing!
        }
    }
    function DeleteVideo(Headline,id) {
        if (confirm('Do you want to delete Video : ' + Headline)) {
                var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeletelVdo", "VdoID": id});
                fetch(url,{
                    mode: 'no-cors',
                    method: 'get',
                });
                location.reload();
        } else {
            // Do nothing!
        }
    }
    function DeleteNews(title,id) {
        if (confirm('Do you want to delete Article : ' + title)) {
            var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({
                "Method": "DeleteNews",
                "NewsID": id
            });
            fetch(url, {
                mode: 'no-cors',
                method: 'get',
            });
            location.reload();
        } else {
            // Do nothing!
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#my-article-text a').css('color', '#5093E1');
        $('#my-article-text').css('border-left', '4px solid #5093E1');
    });
</script>
<script>
    $('.tablep2.paginated').each(function() {
        var currentPage = 0;
        var numPerPage = 2;
        var $table = $(this);
        $table.bind('repaginate', function() {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function(event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertBefore($table).find('span.page-number:first').addClass('active');
        });
</script>
<script>
    $('.tablep5.paginated').each(function() {
        var currentPage = 0;
        var numPerPage = 5;
        var $table = $(this);
        $table.bind('repaginate', function() {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function(event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertBefore($table).find('span.page-number:first').addClass('active');
        });
</script>
</div>
<!--inner block end here-->
@endsection
