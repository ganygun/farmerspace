@extends('homepage.layouts.master') @section('content')
<script>
    $('title').html('มุมข่าว');
</script>
 <style>
        .post .post-content.small p{
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        line-height: 24px;     /* fallback */
                        max-height: 92px;      /* fallback */
                        -webkit-line-clamp: 4; /* number of lines to show */
                        -webkit-box-orient: vertical;
                    }
                       @media screen and (min-width: 15em) { /* Change to whatever media query you require */
                    .head-line{font-size: 34px!important}
                    .sub-head{font-size: 24px!important;margin-bottom: 10px!important;margin-top: -15px!important}
                    .gap-header{height: 20px}
                    .gap-content {
                            padding-top: 40px;
                    }
                }
                @media screen and (min-width: 30em){
                    .head-line{font-size: 40px!important}
                    .sub-head{font-size: 26px!important}
                }
                @media screen and (min-width: 48em){
                    .head-line{font-size: 60px!important;}
                    .sub-head{font-size: 30px!important;margin-bottom: 15px!important;margin-top: -5px!important}
                    .gap-header{height: 60px}
                    .gap-content {
                            padding-top: 20px;
                            padding-bottom: 5px;
                    }
                    .page_content{
                        padding: 0 3em;
                    }
                }
                @media screen and (min-width: 75em){
                    .page_content{
                        padding: 0 6em;
                    }
                }
    </style>
<div class="cf" role="main">
    <!-- Start Archive title -->
    <section class="">
        <article class="post">
            <div class="post-content gap-content">
                <div class="row vc_row-fluid page_content">
                    <div class="medium-12 small-12 columns ">
                        <aside class="gap cf" style="height:40px;">
                        </aside>
                        <div class="slick featured-style1 slick-initialized slick-slider text-center" data-columns="1" data-navigation="false" data-pagination="false">
                            <h1 class="head-line">
                                สะดวกกว่า
                            </h1>
                            <h3 class="sub-head">
                                กับการค้นหาข่าวที่คุณสนใจ
                            </h3>
                            <!-- Start SearchForm -->
                           <form method="get" class="searchform" role="search" action="{{ URL::to('/search') }} "> 
                                <fieldset>
                                    <div class="input-group input-group-lg col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                                        <div class="icon-addon addon-lg">
                                            <input aria-describedby="basic-addon2" class="form-control center-block" id="key" name="key" placeholder="ชื่อผลผลิต" type="text">
                                            </input>
                                        </div>
                                        <span class="input-group-addon" id="basic-addon2" style="background-color: #5d5d5d;border: 1px solid #5d5d5d;border-radius: 0px">
                                            <i class="fa fa-search" style="color: #fff;">
                                            </i>
                                        </span>
                                    </div>
                                </fieldset>
                            </form>
                            <!-- End SearchForm -->
                        </div>
                        <aside class="gap-header">
                        </aside>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <!-- End Archive title -->
    <div class="row archive-page-container ">
        <div class="small-12 medium-8 columns">
            <div id="posts">
                @if(!empty($jsonDecodeNewsAll['dataListNews']))
                @foreach($jsonDecodeNewsAll['dataListNews'] as $key => $dataListNews)
                    @if($key<5)
                    <article class="post style1 " id="post-18446" itemscope="" itemtype="http://schema.org/Article" role="article">
                        <div class="row">
                            <div class="small-12 medium-12 large-5 large-offset-1 columns">
                                <figure class="post-gallery ">
                                    <a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}">
                                        <img alt="" class="attachment-thevoux-style1 size-thevoux-style1 wp-post-image" height="460" itemprop="image" sizes="(max-width: 600px) 100vw, 600px" src="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Picture'] }}" srcset="" width="600"/>
                                    </a>
                                </figure>
                            </div>
                            <div class="small-12 medium-12 large-6 columns">
                                <header class="post-title entry-header">
                                    <h3 itemprop="headline">
                                        <a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}">
                                            {{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}
                                        </a>
                                    </h3>
                                </header>
                                <div class="post-content small">
                                    <p>
                                        {{ $jsonDecodeNewsAll['dataListNews'][$key]['Abstract'] }}
                                    </p>
                                    <footer class="post-links">
                                        <a class="post-link comment-link" href="{{ URL::to('/news/' . $jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}">
                                        </a>
                                        <aside class="share-article-loop post-link">
                                            <a class="boxed-icon social fill facebook" href="http://www.facebook.com/sharer.php?u={{ URL::to('/news/' . $jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}">
                                                <i class="fa fa-facebook">
                                                </i>
                                            </a>
                                            <a class="boxed-icon social fill twitter" href="https://twitter.com/intent/tweet?text={{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}&url={{ URL::to('/news/' . $jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}">
                                                <i class="fa fa-twitter">
                                                </i>
                                            </a>
                                            <a class="boxed-icon social fill google-plus" href="http://plus.google.com/share?url={{ URL::to('/news/' . $jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}">
                                                <i class="fa fa-google-plus">
                                                </i>
                                            </a>
                                        </aside>
                                        <span>
                                             <a id="fbCountShare{{ $jsonDecodeNewsAll['dataListNews'][$key]['NewsID'] }}"></a>
                                            <script>
                                                var settings = {
                                                  "async": true,
                                                  "crossDomain": true,
                                                  "url": "http://graph.facebook.com/?id={{ URL::to('/news/' . $jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}",
                                                  "method": "GET",
                                                  "headers": {
                                                    "cache-control": "no-cache",
                                                    "postman-token": "3424a29d-c352-cb4b-ec15-aeef74649670"
                                                  }
                                                }

                                                $.ajax(settings).done(function (response) {
                                                    $('#fbCountShare{{ $jsonDecodeNewsAll['dataListNews'][$key]['NewsID'] }}').html(response.share.share_count + ' Shares');
                                                });
                                            </script>
                                        </span>
                                    </footer>
                                </div>
                                <footer class="article-tags entry-footer">
                                  <strong>
                                        Tags:
                                    </strong>
                                    @foreach(explode(',', $jsonDecodeNewsAll['dataListNews'][$key]['Tag'] ) as $key => $Tag )
                                        @if($key==0)
                                            <a href="{{ URL::to('/search/tag/' . $Tag) }}" style="color:#2856FA;" title="">
                                                {{ $Tag }}
                                            </a>
                                        @else
                                            ,
                                           <a href="{{ URL::to('/search/tag/' . $Tag) }}" style="color:#2856FA;" title="">
                                                {{ $Tag }}
                                            </a>
                                        @endif
                                    @endforeach
                                </footer>
                            </div>
                        </div>
                    </article>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
        <!-- ads tablet desktop -->
        <aside class="sidebar medium-4 columns hidden-xs">
            <div class="fixed-me">
                <div class="wpb_widgetised_column wpb_content_element">
                    <div class="wpb_wrapper">
                        <div class="widget cf style3 widget_text" id="text-9">
                            <div class="textwidget text-center">
                                <img alt="" src="{{ URL::asset('homepage/images/ads/336x280.png') }}" style="width: 100%">
                                </img>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Ads Mobile -->
        <div class="small-12 columns hidden-sm hidden-md hidden-lg" style="margin-top: 20px;">
            <div class="widget cf style3 widget_text" id="text-9">
                <div class="textwidget text-center">
                    <img alt="" src="{{ URL::asset('homepage/images/ads/320x100.png') }}" style="width: 100%">
                    </img>
                </div>
            </div>
        </div>
        <!-- Load page -->
        <div class="small-12 medium-8 columns">
            <p class="text-center" id="loading">
                <img alt="Loading…" src="{{ URL::asset('homepage/images/loading.gif') }}" style="width: 150px;"/>
            </p>
            <script>
                $(document).ready(function() {
                var win = $(window);
                var i={{ session('cerentPage') }};
                // Each time the user scrolls
                win.scroll(function() {
                    // End of the document reached?
                    if ($(document).height() - win.height() == win.scrollTop()) {
                        $('#loading').show();
                        $.ajax({
                            url: '/news/page/'+i,
                            dataType: 'html',
                            success: function(html) {
                                $('#posts').append(html);
                                $('#loading').hide();
                            }
                        });
                    }
                });
            });
            </script>
        </div>
    </div>
</div>
<!-- End role["main"] -->
@endsection
