@extends('admins.layouts.master') @section('content')
<!--header start here-->
<div class="header-main" style="padding: 1.8em 2em;">
    <div class="header-center">
    <!-- {{ $jsonDecode['dataListUserInfo'][0]['UserID'] }} -->
        <span style="font-weight: 300;font-size: 28px;color: #5d5d5d">
<i aria-hidden="true" class="fa fa-cog fa-2x" style="color: #6495ed;vertical-align: middle;padding-right: 10px;">
                            </i>  Manage Your Account
                        </span>
        <div class="clearfix"> </div>
    </div>

    <div class="clearfix"> </div>
</div>
<!--heder end here-->


<style media="screen" type="text/css">
        input[type="text"] {
            padding: 10px;
            border: none;
            border: solid 1px #c4c4c4;
            transition: border 0.3s;
            background-color: transparent;
        }
        input[type="text"]:focus,
        input[type="text"].focus {
          border: solid 1px #9da5be;
          outline:none;
        }
        textarea {
            padding: 10px;
            border: none;
            border: solid 1px #c4c4c4;
            transition: border 0.3s;
            background-color: transparent;
        }
        textarea:focus,
        textarea.focus {
          border: solid 1px #9da5be;
          outline:none;
        }

        label{
            padding: 10px;
            text-align: center;
            font-weight: 300;
            color: #9DA5BE;
        }
        @media screen and (min-width: 64em){
            div .col-md-3{
                text-align: left;
            }
            div .col-md-6{
                text-align: left;
            }
        }
        h3{
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 10px;
            color: #9DA5BE;
            }
            .row{
                margin: 20px 0;
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

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input.checked ~ label { color: #FFD700;  } /* hover previous stars in list */
</style>
<!--//Star Rating-->

<!--inner block start here-->
<div class="inner-block">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
       <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left text-center">
            <div class="row">
                <p class="text-center">@include('flash::message')</p>
                @foreach($jsonDecode['dataListUserInfo'] as $dataListUserInfo)
                <form action="{{ url('admins/profile/') }}/{{ $dataListUserInfo['UserID'] }}" method="POST" accept-charset="utf-8">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <input type="hidden" name="UserID" id="UserID" value="{{ $dataListUserInfo['UserID'] }}" />
                    <div class="col-md-12 text-left" style="margin:0 20px;">
                        <h3 class="text-left" style="margin-bottom: 40px;margin-left: 40px;">Personal Information</h3>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="PathFile">
                                   Profile Picture
                                </label>
                            </div>
                            <div class="col-md-6">
                                @if(!empty($jsonDecodeShowUserProfile['dataListProfile'][0]['PictureProfile']))
                                <img id="blah" src="{{ $jsonDecodeShowUserProfile['dataListProfile'][0]['PictureProfile'] }}" alt="your image" class="thumb-image img img-responsive" style="width: 100px" />
                                <br>
                                <div class="progress" style="height: 20px;display: none;width: 240px;">
                                    <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                    </div>
                                </div>
                                <input type='file' id="fileUpload" name="fileUpload" style="margin: auto;display: none;width: 245px;border-radius: 0px;" class="btn btn-default" />
                                <input type="hidden" id="PathFile" name="PathFile" value="{{ $jsonDecodeShowUserProfile['dataListProfile'][0]['PictureProfile'] }}" />
                                @else
                                <img id="blah" src="{{ URL::asset('/admin/images/icon_profile.png') }}" alt="your image" class="thumb-image img img-responsive" style="width: 100px" />
                                <br>
                                <div class="progress" style="height: 20px;display: none">
                                    <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                    </div>
                                </div>
                                <input type='file' id="fileUpload" name="fileUpload" style="margin: auto;display: none;width: 245px;border-radius: 0px;" class="btn btn-default" />
                                <input type="hidden" id="PathFile" name="PathFile" />
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="FirstName">
                                    Name
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input name="FirstName" type="text" value="{{ $dataListUserInfo['FirstName'] }}" disabled="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="LastName">
                                    Last Name
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input name="LastName" type="text" value="{{ $dataListUserInfo['LastName'] }}" disabled="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="Phone">
                                    Phone Number
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input name="Phone" type="text" value="{{ $dataListUserInfo['Phone'] }}" disabled="" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="QRCode">
                                    QR Code
                                </label>
                            </div>
                            <div class="col-md-6">
                                @if($dataListUserInfo['QRCode'] != '')
                                <img src="{{ $dataListUserInfo['QRCode'] }}" alt="">
                                <input type="hidden" name="QRCode" value="{{ $dataListUserInfo['QRCode'] }}">
                                @else
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=75x75&data={{ $dataListUserInfo['UserID'] }}" alt="{{ $dataListUserInfo['UserID'] }}">
                                <input type="hidden" name="QRCode" value="https://api.qrserver.com/v1/create-qr-code/?size=75x75&data={{ $dataListUserInfo['UserID'] }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-left" style="margin:20px;">
                        <h3 class="text-left" style="margin-bottom: 40px;margin-left: 40px;">User Status</h3>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="FarmName">
                                    Status
                                </label>
                            </div>
                            <div class="col-md-6">
                               <span class="label label-success" style="padding: 4px;font-size: 16px;font-weight: 300;background-color: #66CC00;">
                                    {{ strtoupper(session('role')) }}
                                </span>
                                <input type="hidden" name="RegistType" id="RegistType" value="{{ session('role') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="Score">
                                    Score
                                </label>
                            </div>
                            <div class="col-md-6">
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
                            <input type="hidden" name="Score" value="{{ $jsonDecodeShowUserProfile['dataListProfile'][0]['Score'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="FarmName">
                                    Institution
                                </label>
                            </div>
                            <div class="col-md-6">
                              <?php
                                $client = new GuzzleHttp\Client;
                                // Get company name by company id.
                                $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                	['query' =>
                                		['Method' => 'ShowUserProfile',
                                			'UserID' => $dataListUserInfo['FarmName'],
                                		],
                                	]);
                                $bodyGetCompanyName = $response->getBody();
                                $jsonDecodeGetCompanyName = json_decode($bodyGetCompanyName, true);
                                if (isset($jsonDecodeGetCompanyName['dataListProfile'][0]['PenName'])) {
                                	$Company = $jsonDecodeGetCompanyName['dataListProfile'][0]['PenName'];
                                } else {
                                	$Company = 'Not Company';
                                }
                                
                                ?>
                             <input name="FarmName" type="text" value="<?php echo $Company;?>" readonly disabled="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="Penname">
                                    Penname
                                </label>
                            </div>
                            <div class="col-md-6">
                             <input name="Penname" type="text" value="{{ $jsonDecodeShowUserProfile['dataListProfile'][0]['PenName'] }}" disabled="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="Description">
                                    Description
                                </label>
                            </div>
                            <div class="col-md-6">
                            <textarea name="Description" rows="6" disabled="">{{ $jsonDecodeShowUserProfile['dataListProfile'][0]['Description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-left" style="margin:20px;">
                        <h3 class="text-left" style="margin-bottom: 40px;margin-left: 40px;">Address Information</h3>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="Address">
                                    Address
                                </label>
                            </div>
                            <div class="col-md-6">
                            <textarea name="Address" rows="6" disabled="">{{ $dataListUserInfo['Address'] }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="SubDistrict">
                                    Sub District
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input name="SubDistrict" type="text" value="{{ $dataListUserInfo['SubDistrict'] }}" disabled="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="District">
                                    District
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input name="District" type="text" value="{{ $dataListUserInfo['District'] }}" disabled="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="Province">
                                    Province
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input name="Province" type="text" value="{{ $dataListUserInfo['Province'] }}" disabled="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <label for="Zipcode">
                                    Zipcode
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input name="Zipcode" type="text" value="{{ $dataListUserInfo['Zipcode'] }}" disabled="">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 " style="margin:20px;">
                        <button class="btn btn-lg " style="border-radius: 0px;background-color: #6495ed;color:#fff;font-weight: 300" type="button" id="editmode">
                            <span>
                                Edit
                                <i aria-hidden="true" class="fa fa-pencil" style="margin-bottom: 0px;padding-left:10px">
                                </i>
                            </span>
                        </button>
                         <button class="btn btn-lg " style="border-radius: 0px;background-color: #6495ed;color:#fff;font-weight: 300;display: none" type="button" id="cancelmode">
                                Cancel
                        </button>
                        <button class="btn btn-lg " style="border-radius: 0px;background-color: #6495ed;color:#fff;font-weight: 300;display: none" type="submit">
                            <span>
                                Update
                                <i aria-hidden="true" class="fa fa-save" style="margin-bottom: 0px;padding-left:10px">
                                </i>
                            </span>
                        </button>
                    </div>

                </form>
                @endforeach
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
</div>
  <script>
    $( document ).ready(function() {
        $('#my-account-text a').css('color', '#5093E1');
        $('#my-account-text').css('border-left', '4px solid #5093E1');
    });
    </script>
    <script>
    $("#editmode").click(function () {
        $("input[type=text]").prop('disabled', false);
        $("textarea").prop('disabled', false);
        $("button[type=submit]").css('display','-webkit-inline-box');
        $('#cancelmode').css('display','-webkit-inline-box');
        $(this).css('display','none');
        $('#fileUpload').css('display','-webkit-inline-box');
    });

     $("#cancelmode").click(function () {
        $("input[type=text]").prop('disabled', true);
        $("textarea").prop('disabled', true);
        $("button[type=submit]").css('display','none');
        $('#editmode').css('display','-webkit-inline-box');
        $(this).css('display','none');
        $('#fileUpload').css('display','none');

    });
    </script>
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileUpload").change(function() {
        readURL(this);
    });
</script>
 <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
                <script>
                // Initialize Firebase
                var config = {
                    apiKey: "AIzaSyAoq09FApuwQfdw6VnFIuVKO1UoaAvL6SA",
                    authDomain: "farmerspace-31fea.firebaseapp.com",
                    databaseURL: "https://farmerspace-31fea.firebaseio.com",
                    storageBucket: "farmerspace-31fea.appspot.com",
                    messagingSenderId: "104709186666"
                };
                firebase.initializeApp(config);
                </script>
<script src="{{ URL::asset('/admin/js/uploadImages_profile.js') }}"></script>
<!--inner block end here-->
@endsection
