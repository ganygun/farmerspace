@extends('admins.layouts.master') @section('content')
<!--header start here-->
<div class="header-main" style="padding: 1.8em 2em;">
    <div class="header-center">
        <h2 style="margin-top: 0.3em;color: #6495ed">
            1 / 3
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
<style>
    .input_hidden {
    position: absolute;
    left: -9999px;
    }

    #language input[type="radio"]:checked + label>img {
      opacity: 1.0;
        filter: alpha(opacity=100); /* For IE8 and earlier */
    }
    #language input[type="radio"]:hover + label>img {
      opacity: 1.0;
        filter: alpha(opacity=100); /* For IE8 and earlier */
    }
    /* Stuff after this is only to make things more pretty */
    #language input[type="radio"] + label>img {
      opacity: 0.3;
        filter: alpha(opacity=30); /* For IE8 and earlier */
        cursor: pointer;
    }
    #language label {
        display: inline-block;
        cursor: pointer;
    }

    #type input[type="radio"]:checked + label>img {
      opacity: 1.0;
        filter: alpha(opacity=100); /* For IE8 and earlier */
    }
    #type input[type="radio"]:hover + label>img {
      opacity: 1.0;
        filter: alpha(opacity=100); /* For IE8 and earlier */
    }
    /* Stuff after this is only to make things more pretty */
    #type input[type="radio"] + label>img {
      opacity: 0.3;
        filter: alpha(opacity=30); /* For IE8 and earlier */
        cursor: pointer;
    }
    #type label {
        display: inline-block;
        cursor: pointer;
    }
     #type img{
        width:  auto;
        cursor: pointer;
    }

    #tag img{
        opacity: 0.3;
        filter: alpha(opacity=30); /* For IE8 and earlier */
        width:  auto;
        height: 90px;
        cursor: pointer;
    }
    #tag img:hover{
        opacity: 1;
        filter: alpha(opacity=100); /* For IE8 and earlier */
    }
    .checked
    {
        opacity: 1.0!important;
        filter: alpha(opacity=100)!important; /* For IE8 and earlier */
    }
    .unchecked{
        opacity: 0.3!important;
        filter: alpha(opacity=30)!important; /* For IE8 and earlier */
    }
    .video img:hover{
        opacity: 0.3;
    }

</style>
<div class="inner-block" style="overflow-x: scroll;padding-top: 2em">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="col-md-12 chit-chat-layer1-left text-center">
        <p class="text-center">@include('flash::message')</p>

            <form id="form" action="/admins/writing/create" method="GET">
                <input id="csrf-token" name="_token" type="hidden" value="{{ Session::token() }}"/>
                <div class="col-md-5 col-md-offset-1">
                    <h3 style="font-weight: 300;">
                        Choose language
                    </h3>
                    <div id="language">
                        <div class="col-md-12" style="margin:3.5em 0">
                            <input class="input_hidden" id="tha" name="lang" type="radio" value="THA"  {{ old('lang') === 'THA' ? 'checked' : '' }}/>
                            <label for="tha">
                                <img alt="ภาษาไทย" src="{{ URL::asset('admin/images/icon/Thai.png') }}" style="margin:0 30px;"/>
                            </label>
                            <input class="input_hidden" id="eng" name="lang" type="radio" value="ENG"  {{ old('lang') === 'ENG' ? 'checked' : '' }}/>
                            <label for="eng">
                                <img alt="English" src="{{ URL::asset('admin/images/icon/English.png') }}" style="margin:0 30px;"/>
                            </label>
                        </div>
                    </div>
                    <h3 style="font-weight: 300;">
                        Choose type
                    </h3>
                    <div id="type">
                        <div class="col-md-12" style="margin:3.5em 0">
                            <input class="input_hidden" id="article" name="type" type="radio" value="Article"  {{ old('type') === 'Article' ? 'checked' : '' }}/>
                            <label for="article">
                                <img id="article-img" alt="Article" src="{{ URL::asset('admin/images/icon/Article.png') }}" style="margin:0 30px;"/>
                            </label>
                            <input class="input_hidden" id="video" name="type" type="radio" value="วีดีโอ"  {{ old('type') === 'วีดีโอ' ? 'checked' : '' }}/>
                            <label for="video">
                                <img id="video-img" alt="Video" src="{{ URL::asset('admin/images/icon/Video.png') }}" style="margin:0 30px;"/>
                            </label>

                            <input class="input_hidden" id="event" name="type" type="radio" value="อีเวนท์"  {{ old('type') === 'อีเวนท์' ? 'checked' : '' }}/>
                            <label for="event">
                                <img id="event-img" alt="Event" src="{{ URL::asset('admin/images/icon/Event.png') }}" style="margin:0 30px;"/>
                            </label>
                        </div>
                    </div>
                    <script>
                        $('input:radio[name=type]').click(function() {
                            if ($(this).val() == 'อีเวนท์') {
                                $("input[type='checkbox'][name='tag[]").attr("disabled",true);
                                $(".img-check").css('cssText', 'opacity: 0.3 !important;cursor: not-allowed');
                                $(".img-check").click(function() {
                                    $(".img-check").css('cssText', 'opacity: 0.3 !important;cursor: not-allowed');
                                });
                            }
                            else
                            {
                                $("input[type='checkbox'][name='tag[]").attr("disabled",false);
                                $(".img-check").css('cssText', 'cursor: not-pointer');
                                $(".img-check").click(function() {
                                    $(".img-check").css('cssText', 'cursor: not-pointer');
                                });
                            }

                        });
                    </script>
                </div>
                <div class="col-md-4">
                    <div id="tag">
                        <h3 style="font-weight: 300;">
                            Choose tag type
                        </h3>
                        <p style="color: #9DA5BE;margin-top: 8px;font-size: 14px;font-weight: 300">You can choose more than one type</p>
                        <div class="hidden-sm hidden-xs" style="margin:1.75em 0;"></div>
                        <div class="row">
                            <div class="col-md-4" style="margin:1.75em 0;">
                                <label for="crop">
                                    <img alt="..." id="crop-img" class="img-check" src="{{ URL::asset('admin/images/icon/Crop.png') }}">
                                        <input autocomplete="off" class="hidden" id="crop" name="tag[]" type="checkbox" value="พืช">
                                        </input>
                                    </img>
                                </label>
                            </div>
                            <div class="col-md-4" style="margin:1.75em 0;">
                                <label for="livestock">
                                    <img alt="..." id="livestock-img" class="img-check" src="{{ URL::asset('admin/images/icon/livestock.png') }}">
                                        <input autocomplete="off" class="hidden" id="livestock" name="tag[]" type="checkbox" value="ปศุสัตว์">
                                        </input>
                                    </img>
                                </label>
                            </div>
                            <div class="col-md-4" style="margin:1.75em 0;">
                                <label for="aquaculture">
                                    <img alt="..." id="aquaculture-img" class="img-check" src="{{ URL::asset('admin/images/icon/Aquaculture.png') }}">
                                        <input autocomplete="off" class="hidden" id="aquaculture" name="tag[]" type="checkbox" value="ประมง">
                                        </input>
                                    </img>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="margin:20px 0;">
                                <label for="villagers">
                                    <img alt="..." id="villagers-img" class="img-check" src="{{ URL::asset('admin/images/icon/Villagers.png') }}">
                                        <input autocomplete="off" class="hidden" id="villagers" name="tag[]" type="checkbox" value="ชุมชน">
                                        </input>
                                    </img>
                                </label>
                            </div>
                            <div class="col-md-4" style="margin:20px 0;">
                                <label for="processed">
                                    <img alt="..." id="processed-img" class="img-check" src="{{ URL::asset('admin/images/icon/Processed.png') }}">
                                        <input autocomplete="off" class="hidden" id="processed" name="tag[]" type="checkbox" value="แปรรูป">
                                        </input>
                                    </img>
                                </label>
                            </div>
                            <div class="col-md-4" style="margin:20px 0;">
                                <label for="technology">
                                    <img alt="..." id="technology-img" class="img-check" src="{{ URL::asset('admin/images/icon/Technology.png') }}">
                                        <input autocomplete="off" class="hidden" id="technology" name="tag[]" type="checkbox" value="เทคโนโลยี">
                                        </input>
                                    </img>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="margin:20px 0;">
                                <label for="flower">
                                    <img alt="..." id="flower-img" class="img-check" src="{{ URL::asset('admin/images/icon/Flower.png') }}">
                                        <input autocomplete="off" class="hidden" id="flower" name="tag[]" type="checkbox" value="ดอกไม้">
                                        </input>
                                    </img>
                                </label>
                            </div>
                            <div class="col-md-4" style="margin:20px 0;">
                                <label for="fertilizer">
                                    <img alt="..." id="fertilizer-img" class="img-check" src="{{ URL::asset('admin/images/icon/Fertilizer.png') }}">
                                        <input autocomplete="off" class="hidden" id="fertilizer" name="tag[]" type="checkbox" value="ปุ๋ย">
                                        </input>
                                    </img>
                                </label>
                            </div>
                            <div class="col-md-4" style="margin:20px 0;">
                                <label for="insect">
                                    <img alt="..." id="insect-img" class="img-check" src="{{ URL::asset('admin/images/icon/Insect.png') }}">
                                        <input autocomplete="off" class="hidden" id="insect" name="tag[]" type="checkbox" value="แมลง">
                                        </input>
                                    </img>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(".img-check").click(function(){
                                    $(this).toggleClass("checked");
                                });
                </script>
                <div class="col-md-12" style="margin-top: 3.5em;">
                    <button class="btn btn-lg" disabled="true" style="border-radius: 0px;background-color: #6495ed;color:#fff;opacity: 0.2">
                        <span>
                            <i aria-hidden="true" class="fa fa-caret-left" style="margin-bottom: 0px;padding-right:10px">
                            </i>
                            Back
                        </span>
                    </button>
                    <button class="btn btn-lg" href="/admins/writing/create" style="border-radius: 0px;background-color: #6495ed;color:#fff" type="submit">
                        <span>
                            Next
                            <i aria-hidden="true" class="fa fa-caret-right" style="margin-bottom: 0px;padding-left:10px">
                            </i>
                        </span>
                    </button>
                </div>
            </form>
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
