@extends('homepage.layouts.master') @section('content')
<script>
    $('title').html('{{ $Title }}');
</script>
<!-- Custom -->
 <link rel="stylesheet" href="{{ URL::asset('/homepage/css/profile_box.css') }}">
<style>
    p a{
        font-size: 16px
    }
    .post .post-content ul, .post .post-content ol{
    font-family: 'THSarabunNew';
    font-size: 22px;
    }
    .post .post-content p {
        margin-bottom: 5px;
        line-height: 1;
    }
    img{
        display: block;
        margin: 0 auto;
    }
    .highlight {
        background-color: #d8d8d8;
        padding: 30px;
        border-top: 4px #00FF00 solid;
    }
    .event {
        position: relative;
    }

    h3 a {
        background-color: white;
        padding-right: 10px;
    }
    footer{
        margin-top: 5px;
    }
    .event:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 0.5em;
        border-top: 4px solid #cccccc;
        z-index: -1;
    }
    .post .post-content.small p{
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        line-height: 25px;     /* fallback */
                        max-height: 72px;      /* fallback */
                        -webkit-line-clamp: 3; /* number of lines to show */
                        -webkit-box-orient: vertical;
                    }

    @media screen and (min-width: 15em) {
        /* Change to whatever media query you require */
        .page {
            margin-top: 60px;
            font-size: 0.8em;
            padding: 0 15px;
        }
        .resizeimg{
                        width: 75px!important;
                        height: 75px;
                    }
        .gap-relate-news{
            height: 30px;
        }
        .header-content{font-size: 26px!important;line-height: 38px!important}
        .head-line{font-size: 34px!important}
        .sub-head{font-size: 24px!important;margin-bottom: 10px!important;margin-top: -15px!important}
        .panel{text-align: center}
        .text-adjust-mobile{padding: 0px 20px 0px 20px;}
    }

    @media screen and (min-width: 30em) {
        .page {
            margin-top: 60px;
            font-size: 1em;
        }
       .resizeimg{
                        width: 100px!important;
                        height: 100px;
                    }
        .header-content{font-size: 34px!important;line-height: 46px!important}
          .head-line{font-size: 40px!important}
                    .sub-head{font-size: 26px!important}

    }

    @media screen and (min-width: 48em) {
        .page {
            margin-top: 0px;
        }
        .resizeimg{
                        width: 125px!important;
                        height: auto;
                    }
        .gap-relate-news{
            height: 60px;
        }
        .header-content{font-size: 48px!important;line-height: 54px!important}
        .head-line{font-size: 60px!important;}
        .sub-head{font-size: 30px!important;margin-bottom: 15px!important;margin-top: -5px!important}
        .panel{text-align: left}
        .text-adjust-mobile{padding: 0px;}




    }

    @media screen and (min-width: 64em) {
        .page {
            margin-top: 10px;
        }
         .resizeimg{
                        width: 150px!important;
                        height: auto;
                    }
    }

    @media screen and (min-width: 65em) {
        .page {
            margin-top: 0px;
        }
    }
</style>

<div data-infinite="off" id="infinite-article">
    <div class="post-detail-row style2">
        <div style="background-color: #d8d8d8">
            <div class="row post-detail-style2">
                <div class="small-12 medium-12 large-8 large-offset-2 columns">
                    <h5>
                        <a href="{{ URL::to('/') }}" style="font-weight: 600;">
                            หน้าหลัก
                        </a>
                        >
                        <a href="{{ URL::to('/video/') }}" style="font-weight: 600;">
                            มุมวีดีโอ
                        </a>
                        >
                        <a href="{{ URL::to('/video/' .  $ID ) }}" style="font-weight: 600;">
                            {{ $Title }}
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="row post-detail-style2" style="margin-top: 40px;">
            <div class="small-12 medium-12 large-8 large-offset-2 columns">
                <article class="post post-detail" itemscope="" itemtype="http://schema.org/Article" role="article" style="position: relative;">
                    <header class="post-title entry-header">
                        <h1 class="entry-title header-content" itemprop="headline" style="font-weight: 600;">
                            {{ $Title }}
                        </h1>
                    </header>
                    <aside class="share-article hide-on-print fixed-me hide-for-small">
                        <a class="boxed-icon facebook social" href="http://www.facebook.com/sharer.php?u={{ URL::to('/video/' . $ID) }}">
                            <i class="fa fa-facebook">
                            </i>
                            <span>
                                <div id="fbCountShare"></div>
                                <script>
                                    var settings = {
                                      "async": true,
                                      "crossDomain": true,
                                      "url": "http://graph.facebook.com/?id={{ URL::to('/video/' . $ID) }}",
                                      "method": "GET",
                                      "headers": {
                                        "cache-control": "no-cache",
                                        "postman-token": "3424a29d-c352-cb4b-ec15-aeef74649670"
                                      }
                                    }

                                    $.ajax(settings).done(function (response) {
                                        $('#fbCountShare').html(response.share.share_count);
                                    });
                                </script>
                            </span>
                        </a>
                        <a class="boxed-icon twitter social " href="https://twitter.com/intent/tweet?text={{ $Title }}&url={{ URL::to('/video/' . $ID) }}">
                            <i class="fa fa-twitter">
                            </i>
                            <span>
                                0
                            </span>
                        </a>
                        <a class="boxed-icon google-plus social" href="http://plus.google.com/share?url={{ URL::to('/video/' . $ID) }}">
                            <i class="fa fa-google-plus">
                            </i>
                            <span>
                                0
                            </span>
                        </a>
                        <a class="boxed-icon comment" href="{{ URL::to('/video/' . $ID) }}">
                            <span>
                                0
                            </span>
                        </a>
                    </aside>
                    <div class="sticky-content-spacer">
                    </div>
                    <div class="post-content-container">
                        <div class="post-content entry-content cf" itemprop="articleBody">
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $VdoUrl }}"></iframe>
                            </div>
                            <aside class="gap cf" style="height:40px;"></aside>
                            <div class="content">
                             {!! $Abstract !!}
                            </div>
                            <aside class="gap cf" style="height:40px;"></aside>
                            <footer class="article-tags entry-footer" style="color:#dd4b39">
                                <strong>
                                    Tags:
                                </strong>
                                @foreach(explode(',', $Tag) as $key => $Tag )
                                    @if($key==0)
                                        <a href="" style="color:#dd4b39;font-size: 1.2em" title="">
                                        {{ $Tag }}
                                        </a>
                                    @else
                                        ,
                                        <a href="" style="color:#dd4b39;font-size: 1.2em" title="">
                                        {{ $Tag }}
                                        </a>
                                    @endif
                                @endforeach
                            </footer>
                            <p>&nbsp;</p>
                            <div class="panel" style="border: 1px dashed #cccccc;border-radius: 0px;">
                                <div class="" style="border: 1px dashed #cccccc;border-radius: 0px;margin:3px;">
                                    <div class="" style="border: 1px dashed #cccccc;border-radius: 0px;margin:3px;">
                                        <div class="row" style="padding:15px;">
                                            <div class="small-12 medium-3 center-block" style="margin-right: 30px!important">
                                                <img class="img img-responsive img-circle" src="{{ $PictureProfile }}" style="object-fit: contain;object-position: center;height: 180px;margin:auto;">
                                                </img>
                                            </div>
                                            <div class="small-12 medium-7 " style="display: block;margin-right: auto;margin-top: 20px;">
                                                <div class="small-12 medium-12">
                                                    <h5 class="head-editor" style="margin-bottom: 10px;">
                                                        {{ $PenName }}
                                                        <small style="font-weight: 600">
                                                            <br>
                                                                {{ $Company }}
                                                            </br>
                                                        </small>
                                                    </h5>
                                                </div>
                                                <div class="small-12 medium-12">
                                                    <p class="text-adjust-mobile" style="font-size: 18px;">
                                                        {{ $Description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cf">
                        </div>
                    </div>
                    <aside class="share-article hide-on-print show-for-small">
                        <a class="boxed-icon facebook social" href="http://www.facebook.com/sharer.php?u={{ URL::to('video/' . $ID) }}">
                            <i class="fa fa-facebook">
                            </i>
                            <span>
                                10
                            </span>
                        </a>
                        <a class="boxed-icon twitter social " href="https://twitter.com/intent/tweet?text={{ $Title }}&url={{ URL::to('/video/' . $ID) }}$via=farmerspace">
                            <i class="fa fa-twitter">
                            </i>
                            <span>
                                0
                            </span>
                        </a>
                        <a class="boxed-icon google-plus social" href="http://plus.google.com/share?url={{ URL::to('/video/' . $ID) }}">
                            <i class="fa fa-google-plus">
                            </i>
                            <span>
                                0
                            </span>
                        </a>
                        <a class="boxed-icon comment" href="{{ URL::to('/video/' . $ID) }}">
                            <span>
                                0
                            </span>
                        </a>
                    </aside>
                </article>
            </div>         
            <div class="small-12 medium-12 large-8 large-offset-2 columns">
                <div class="row vc_row-fluid">
                    <div class="medium-12 small-12 columns">
                        <aside class="gap cf" style="height:30px;">
                        </aside>
                        <div class="row endcolumn catelement-style1">
                            <div class="small-12 columns hidden-xs ">
                                <div class="widget cf style3 widget_text" id="text-9">
                                    <div class="textwidget text-center">
                                        <img alt="" src="{{ URL::asset('homepage/images/ads/728x90.png') }}" style="width: 100%">
                                        </img>
                                    </div>
                                </div>
                            </div>
                            <div class="small-12 columns hidden-sm hidden-md hidden-lg">
                                <div class="widget cf style3 widget_text" id="text-9">
                                    <div class="textwidget text-center">
                                        <img alt="" src="{{ URL::asset('homepage/images/ads/320x100.png') }}" style="width: 100%">
                                        </img>
                                    </div>
                                </div>
                            </div>
                            <div class="sticky-content-spacer">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mnm_sharing" style="margin: 1.5em 0;">
                    <div class="facebook">
                        <div class="fb-like fb_iframe_widget" data-action="like" data-href="" data-layout="button_count" data-share="true" data-show-faces="false" data-width="100px" fb-xfbml-state="rendered">
                            <span style="vertical-align: bottom; width: 120px; height: 20px;">
                                <iframe src="https://www.facebook.com/plugins/like.php?href={{ URL::to('video/' . $ID) }}&width=124&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId=1136778553087066" width="124" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                            </span>
                        </div>
                    </div>
                    <div class="twitter">
                        <iframe allowtransparency="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" frameborder="0" id="twitter-widget-0" scrolling="no" src="https://platform.twitter.com/widgets/tweet_button.a0ec3119d8db2bc5422f2144c89ad7a9.en.html#dnt=false&id=twitter-widget-0&lang=en&original_referer={{ URL::to('/video/' . $ID) }}&related={{ URL::to('/')}}&size=m&text={{ $Title }}&time=1488444726544&type=share&url={{ URL::to('/video/' . $ID) }}via=farmerspace" style="position: static; visibility: visible; width: 60px; height: 20px;" title="Twitter Tweet Button">
                        </iframe>
                    </div>
                </div>
                <div id="fb-root">
                </div>
                <script>
                    (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1136778553087066";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                </script>
                <span style="height: 173px;">
                    <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid" data-colorscheme="light" data-href="{{ URL::to('/video/' . $ID) }}" data-numposts="5" data-width="100%" fb-xfbml-state="rendered">
                    </div>
                </span>
            </div>
            <!-- Rerate News -->
        </div>
        <aside class="ad_container_bottom">
            <div class="post-ads" style="text-align: center">
                <div>
                </div>
            </div>
        </aside>
    </div>
</div>
<!-- End role["main"] -->
@endsection
