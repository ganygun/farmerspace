
@extends('homepage.layouts.master') @section('content')

            <style>
                @media screen and (min-width: 15em) { /* Change to whatever media query you require */
                    .photo-gallery{
                        height: auto;
                    }
                    .head-line{font-size: 34px!important}
                    .sub-head{font-size: 24px!important;margin-bottom: 10px!important;margin-top: -15px!important}
                    .gap-header{height: 25px}
                    .gap-content {
                            padding: 40px 0;
                    }
                    .hr-role-event{
                        margin-left: 6em;
                    }
                    .hr-role-news{
                        margin-left: 2em;
                    }
                    .second-news{
                        padding-right: 8px;
                    }
                    .third-news{
                        padding-left: 8px;
                    }
                    .resizeimg{
                        width: 75px!important;
                        height: 75px;
                    }
                }
                @media screen and (min-width: 30em){
                    .photo-gallery{
                        height: 108px;
                    }
                    .head-line{font-size: 40px!important}
                    .sub-head{font-size: 26px!important}
                    .hr-role-event{
                        margin-left: 5em;
                    }
                    .hr-role-news{
                        margin-left: -10px;
                    }
                    .resizeimg{
                        width: 100px!important;
                        height: 100px;
                    }

                }
                @media screen and (min-width: 48em){
                    .photo-gallery{
                        height: 119px;
                    }
                    .head-line{font-size: 60px!important;}
                    .sub-head{font-size: 30px!important;margin-bottom: 15px!important;margin-top: -5px!important}
                    .gap-header{height: 60px}
                    .gap-content {
                            padding: 20px 0;
                    }

                    .hr-role-event{
                        margin-left: 6.5em;
                    }
                    .hr-role-news{
                     margin-left: -10px;
                    }
                      .second-news{
                        padding-left: 0.9375em;
                        padding-right: 0.9375em;
                    }
                    .third-news{
                        padding-left: 0.9375em;
                        padding-right: 0.9375em;
                    }
                    .resizeimg{
                        width: 125px!important;
                        height: auto;
                    }
                    .page_content{
                        padding: 0 3em;
                    }
                }
                @media screen and (min-width: 64em){
                    .photo-gallery{
                        height: 166px;
                    }
                }
                @media screen and (min-width: 75em){
                    .photo-gallery{
                        height: 184px;
                    }
                    .page_content{
                        padding: 0 6em;
                    }
                }

                   .event {
                        position: relative;
                    }

                    h3 a {
                        background-color: white;
                        padding-right: 10px;
                    }
                    .event:after {
                        content:"";
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        height: 0.6em;
                        border-top: 4px solid #cccccc;
                        z-index: -1;
                    }
                    .post .post-content.small p{
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        line-height: 24px;     /* fallback */
                        max-height: 44px;      /* fallback */
                        -webkit-line-clamp: 2; /* number of lines to show */
                        -webkit-box-orient: vertical;
                    }
            </style>
            <!-- css custom inline -->
           
            <div role="main" class="cf">
                <section class="">
                    <article class="post post-1841 page type-page status-publish hentry" id="post-1841">
                        <div class="post-content gap-content">
                        <!-- Start First Content -->
                            <div class="row vc_row-fluid page_content">
                                <div class="medium-12 small-12 columns" >
                                    <aside class="gap cf" style="height:40px;"></aside>
                                    <div class="slick featured-style1  slick-initialized slick-slider text-center" data-columns="1" data-pagination="false" data-navigation="false">
                                        <h1 class="head-line">สะดวกกว่า</h1>
                                        <h3 class="sub-head">กับการค้นหาข่าวที่คุณสนใจ</h3>
                                    <!-- Start SearchForm -->
                                       <form method="get" class="searchform" role="search" action="{{ URL::to('/search') }}">
                                            <fieldset>
                                                <div class="input-group input-group-lg  col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                                                    <div class="icon-addon addon-lg">
                                                        <input type="text" class="form-control center-block" name="key" id="key" placeholder="ชื่อผลผลิต" aria-describedby="basic-addon2">
                                                    </div>
                                                    <span id="basic-addon2"  class="input-group-addon" style="background-color: #5d5d5d;border: 1px solid #5d5d5d;border-radius: 0px"><i class="fa fa-search" style="color: #fff;"></i></span>
                                                </div>
                                            </fieldset>
                                        </form>
                                    <!-- End SearchForm -->
                                    </div>
                                    <aside class="gap-header"></aside>
                                    <div class="row endcolumn catelement-style1">
                                    <!-- Big 1 News Content -->
                                        @if(!empty($jsonDecodeNewsAll['dataListNews']))
                                        <div class="small-12 medium-8 large-8 columns">
                                            <article itemscope="" itemtype="http://schema.org/Article" class="post style3 post-17785 type-post status-publish format-standard has-post-thumbnail hentry category-pulse tag-featured tag-hypocrite tag-thailand tag-trump" id="post-17785" role="article">
                                                <figure class="post-gallery ">
                                                    <img width="570" height="450" src="{{ $jsonDecodeNewsAll['dataListNews'][0]['Picture'] }}" sizes="(max-width: 570px) 100vw, 570px">
                                                </figure>
                                                <aside class="post-author cf">
                                                    <time class="time" datetime="{{ $jsonDecodeNewsAll['dataListNews'][0]['CreatedDate'] }}"  >{{ Carbon\Carbon::parse($jsonDecodeNewsAll['dataListNews'][0]['CreatedDate'])->format('d  M  Y') }}</time>
                                                </aside>
                                                <header class="post-title entry-header">
                                                    <h3 itemprop="headline">
                                                        <a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][0]['NewsID']) }}" title="ในความทรัมป์ มีความไทย">{{ $jsonDecodeNewsAll['dataListNews'][0]['Title'] }}</a>
                                                    </h3>
                                                </header>
                                                <div class="post-content small">
                                                    <p>{{ $jsonDecodeNewsAll['dataListNews'][0]['Abstract'] }}</p>
                                                </div>
                                            </article>
                                        </div>
                                    <!-- Small 2 News Content -->
                                        <div class="small-12 medium-4 large-4 columns">
                                            <div class="row" >
                                                <div class="small-6 medium-12 large-12 columns second-news">
                                                    <article itemscope="" itemtype="http://schema.org/Article" class="post style3-small post-17793 type-post status-publish format-standard has-post-thumbnail hentry category-pulse tag-broke-up tag-featured tag-love tag-relationship tag-workplace-romance" id="post-17793" role="article">
                                                        <figure class="post-gallery photo-gallery">
                                                            <img width="540" height="280" src="{{ $jsonDecodeNewsAll['dataListNews'][1]['Picture'] }}" class="attachment-thevoux-style3-small size-thevoux-style3-small wp-post-image" alt="" itemprop="image" sizes="(max-width: 540px) 100vw, 540px">
                                                        </figure>
                                                        <aside class="post-author small cf">
                                                             <time class="time" datetime="{{ $jsonDecodeNewsAll['dataListNews'][1]['CreatedDate'] }}"  >{{ Carbon\Carbon::parse($jsonDecodeNewsAll['dataListNews'][1]['CreatedDate'])->format('d  M  Y') }}</time>
                                                        </aside>
                                                        <header class="post-title entry-header">
                                                            <h5 itemprop="headline"><a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][1]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][1]['Title'] }}">{{ $jsonDecodeNewsAll['dataListNews'][1]['Title'] }}</a></h5>
                                                        </header>
                                                        <div class="post-content small">
                                                            <p>{{ $jsonDecodeNewsAll['dataListNews'][1]['Abstract'] }}</p>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div class="small-6 medium-12 large-12 columns third-news">
                                                    <article itemscope="" itemtype="http://schema.org/Article" class="post style3-small post-17793 type-post status-publish format-standard has-post-thumbnail hentry category-pulse tag-broke-up tag-featured tag-love tag-relationship tag-workplace-romance" id="post-17793" role="article">
                                                        <figure class="post-gallery photo-gallery">
                                                            <img width="540" height="280" src="{{ $jsonDecodeNewsAll['dataListNews'][2]['Picture'] }}" class="attachment-thevoux-style3-small size-thevoux-style3-small wp-post-image" alt="" itemprop="image" sizes="(max-width: 540px) 100vw, 540px">
                                                        </figure>
                                                        <aside class="post-author small cf">
                                                             <time class="time" datetime="{{ $jsonDecodeNewsAll['dataListNews'][2]['CreatedDate'] }}"  >{{ Carbon\Carbon::parse($jsonDecodeNewsAll['dataListNews'][2]['CreatedDate'])->format('d  M  Y') }}</time>
                                                        </aside>
                                                        <header class="post-title entry-header">
                                                            <h5 itemprop="headline"><a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][2]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][2]['Title'] }}">{{ $jsonDecodeNewsAll['dataListNews'][2]['Title'] }}</a></h5>
                                                        </header>
                                                        <div class="post-content small">
                                                            <p>{{ $jsonDecodeNewsAll['dataListNews'][2]['Abstract'] }}</p>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        <!-- End First Content -->
                        <!-- Start Second Content -->
                            <div class="row vc_row-fluid vc_row-o-equal-height vc_row-flex page_content">
                                <!-- Ads Mobile #1 -->
                                    <div class="small-12 columns hidden-sm hidden-md hidden-lg">
                                        <div id="text-9" class="widget cf style3 widget_text">
                                            <div class="textwidget text-center" >
                                                <img src="{{ URL::asset('homepage/images/ads/320x100.png') }}" alt="" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="medium-8 small-12 columns ">
                                        <div class="vc_row row vc_inner vc_row-fluid">
                                            <div class="wpb_column columns medium-12 small-12">
                                                <div class="vc_column-inner ">
                                                    <div class="row endcolumn catelement-style3">
                                                        <div class="small-12 columns" >
                                                            <div class="small-12 medium-12 columns" style="padding-left: 0">
                                                                 <div style="display: block;margin-top: 20px;">
                                                                    <h3 class="event">
                                                                        <a href="{{ url('/news') }}" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">ข่าว</a>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- Small 5 News Content -->
                                                        <div class="small-12 columns">
                                                            @foreach($jsonDecodeNewsAll['dataListNews'] as $key => $dataListNews)
                                                                @if($loop->last)
                                                                <div class="test">
                                                                    <article itemscope="" itemtype="http://schema.org/Article" class="post style4 cf" id="post-17331" role="article">
                                                                        <figure class="post-gallery">
                                                                            <a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}">
                                                                                <img class="resizeimg" width="125" height="125" src="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Picture'] }}" sizes="(max-width: 125px) 100vw, 125px">
                                                                            </a>
                                                                        </figure>
                                                                        <div class="style4-container">
                                                                            <aside class="post-author">
                                                                                <time class="time" datetime="{{ $jsonDecodeNewsAll['dataListNews'][$key]['CreatedDate'] }}"  >{{ Carbon\Carbon::parse($jsonDecodeNewsAll['dataListNews'][$key]['CreatedDate'])->format('d  M  Y') }}</time>
                                                                            </aside>
                                                                            <header class="post-title entry-header">
                                                                                <h5 itemprop="headline"><a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}">{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}</a></h5>
                                                                            </header>
                                                                            <div class="post-content small">
                                                                                <p>{{ $jsonDecodeNewsAll['dataListNews'][$key]['Abstract'] }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                </div>
                                                                @elseif($key>=3)
                                                                <article itemscope="" itemtype="http://schema.org/Article" class="post style4 cf" id="post-17331" role="article">
                                                                    <figure class="post-gallery">
                                                                        <a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}">
                                                                            <img class="resizeimg" width="125" height="125" src="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Picture'] }}" sizes="(max-width: 125px) 100vw, 125px">
                                                                        </a>
                                                                    </figure>
                                                                    <div class="style4-container">
                                                                        <aside class="post-author">
                                                                            <time class="time" datetime="{{ $jsonDecodeNewsAll['dataListNews'][$key]['CreatedDate'] }}"  >{{ Carbon\Carbon::parse($jsonDecodeNewsAll['dataListNews'][$key]['CreatedDate'])->format('d  M  Y') }}</time>
                                                                        </aside>
                                                                        <header class="post-title entry-header">
                                                                            <h5 itemprop="headline"><a href="{{ URL::to('/news/' .$jsonDecodeNewsAll['dataListNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}">{{ $jsonDecodeNewsAll['dataListNews'][$key]['Title'] }}</a></h5>
                                                                        </header>
                                                                        <div class="post-content small">
                                                                            <p>{{ $jsonDecodeNewsAll['dataListNews'][$key]['Abstract'] }}</p>
                                                                        </div>
                                                                    </div>
                                                                </article>
                                                                @endif
                                                            @endforeach
                                                            <div class="fixed-me">
                                                                <div class="wpb_widgetised_column wpb_content_element">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="text-9" class="widget cf style3 widget_text">
                                                                            <a href="{{ url('/news') }}" class="textwidget" style="display: block;width: 100%;height: 60px;text-align: center;font-size: 19px;background-color: #5d5d5d;word-break: break-all;text-align: center;vertical-align: middle;padding-top: 20px;margin-top: -50px;color:#fff;font-weight: 600">อ่านข่าวทั้งหมด<br><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <!-- Ads Desktop #1 -->
                                <div class="medium-4 small-12 columns hidden-xs">
                                    <div class="fixed-me">
                                        <div class="wpb_widgetised_column wpb_content_element">
                                            <div class="wpb_wrapper">
                                                <div id="text-9" class="widget cf style3 widget_text" >
                                                    <div class="textwidget text-center">
                                                        <img src="{{ URL::asset('homepage/images/ads/336x280.png') }}" alt="" style="width: 100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sticky-content-spacer"></div>
                                </div>
                            </div>
                        <!-- End Second Content -->
                        <!-- Ads  -->
                            <div class="row vc_row-fluid page_content">
                                <div class="medium-12 small-12  columns">
                                    <aside class="gap cf" style="height:30px;"></aside>
                                    <div class="row endcolumn catelement-style1">
                                    <!-- Ads Desktop #2 -->
                                        <div class="small-12 columns hidden-xs ">
                                            <div id="text-9" class="widget cf style3 widget_text">
                                                <div class="textwidget text-center">
                                                    <img src="{{ URL::asset('homepage/images/ads/728x90.png') }}" alt="" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Ads Mobile #2 -->
                                        <div class="small-12 columns hidden-sm hidden-md hidden-lg">
                                            <div id="text-9" class="widget cf style3 widget_text">
                                                <div class="textwidget text-center">
                                                    <img src="{{ URL::asset('homepage/images/ads/320x100.png') }}" alt="" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sticky-content-spacer"></div>
                                    </div>
                                </div>
                            </div>
                            
                        <!-- Start Third Content -->
                            <div class="row vc_row-fluid page_content">
                            <!-- Video Content -->
                                <div class="small-12 medium-8 large-8 columns">
                                    <div class="row endcolumn catelement-style1">
                                        <div class="small-12 columns" style="margin-bottom: 20px;" >
                                            <div style="display: block;margin-top: 60px;">
                                                <h3 class="event">
                                                    <a href="{{ url('/video') }}" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">มุมวีดีโอ</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row endcolumn catelement-style1">
                                    <!-- Big 1 Video Content -->
                                        <div class="small-12 medium-12 large-12 columns" style="margin-bottom: 20px;">
                                            <article itemscope="" itemtype="http://schema.org/Article" class="post style3 type-post " id="post-17785" role="article">
                                                <figure class="post-gallery ">
                                                    <!-- 16:9 aspect ratio -->
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe class="embed-responsive-item" src="{{ $jsonDecodeVdoAll['dataListVDO'][0]['VdoUrl'] }}"></iframe>
                                                    </div>
                                                </figure>
                                                <header class="post-title entry-header">
                                                    <h3 itemprop="headline"><a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][0]['VdoID']) }}" title="ในความทรัมป์ มีความไทย">{{ $jsonDecodeVdoAll['dataListVDO'][0]['Headline'] }}</a></h3>
                                                </header>
                                            </article>
                                        </div>
                                    <!-- Small 4 Video Content -->
                                        <div class="small-12 medium-12 large-12 columns">
                                            <div class="row" >
                                                @if(!empty($jsonDecodeVdoAll['dataListVDO'][1]))
                                                <div class="small-12 medium-6 large-6 columns second-news">
                                                    <article itemscope="" itemtype="http://schema.org/Article" class="post style3-small" id="post-17793" role="article">
                                                        <figure class="post-gallery ">
                                                            <a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][1]['VdoID']) }}">
                                                                <img width="540" height="280" src="https://i.ytimg.com/vi/{{ substr($jsonDecodeVdoAll['dataListVDO'][1]['VdoUrl'], strpos($jsonDecodeVdoAll['dataListVDO'][1]['VdoUrl'], 'embed/') + 6) }}/mqdefault.jpg" alt="" itemprop="image">
                                                            </a>
                                                        </figure>
                                                        <header class="post-title entry-header">
                                                            <h5 itemprop="headline"><a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][1]['VdoID']) }}" title="{{ $jsonDecodeVdoAll['dataListVDO'][1]['Headline'] }}">{{ $jsonDecodeVdoAll['dataListVDO'][1]['Headline'] }}</a></h5>
                                                        </header>
                                                    </article>
                                                </div>
                                                @endif
                                                @if(!empty($jsonDecodeVdoAll['dataListVDO'][2]))
                                                <div class="small-12 medium-6 large-6 columns second-news">
                                                    <article itemscope="" itemtype="http://schema.org/Article" class="post style3-small" id="post-17793" role="article">
                                                        <figure class="post-gallery ">
                                                            <a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][2] ['VdoID']) }}">
                                                                <img width="540" height="280" src="https://i.ytimg.com/vi/{{ substr($jsonDecodeVdoAll['dataListVDO'][2]['VdoUrl'], strpos($jsonDecodeVdoAll['dataListVDO'][2]['VdoUrl'], 'embed/') + 6) }}/mqdefault.jpg" alt="" itemprop="image">
                                                            </a>
                                                        </figure>

                                                        <header class="post-title entry-header">
                                                            <h5 itemprop="headline"><a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][2]['VdoID']) }}" title="{{ $jsonDecodeVdoAll['dataListVDO'][2]['Headline'] }}">{{ $jsonDecodeVdoAll['dataListVDO'][2]['Headline'] }}</a></h5>
                                                        </header>
                                                    </article>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="small-12 medium-12 large-12 columns">
                                            <div class="row" >
                                                @if(!empty($jsonDecodeVdoAll['dataListVDO'][3]))
                                                <div class="small-12 medium-6 large-6 columns second-news">
                                                    <article itemscope="" itemtype="http://schema.org/Article" class="post style3-small" id="post-17793" role="article">
                                                        <figure class="post-gallery ">
                                                            <a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][3] ['VdoID']) }}">
                                                                <img width="540" height="280" src="https://i.ytimg.com/vi/{{ substr($jsonDecodeVdoAll['dataListVDO'][3]['VdoUrl'], strpos($jsonDecodeVdoAll['dataListVDO'][3]['VdoUrl'], 'embed/') + 6) }}/mqdefault.jpg" alt="" itemprop="image">
                                                            </a>
                                                        </figure>
                                                        <header class="post-title entry-header">
                                                            <h5 itemprop="headline"><a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][3]['VdoID']) }}" title="{{ $jsonDecodeVdoAll['dataListVDO'][3]['Headline'] }}">{{ $jsonDecodeVdoAll['dataListVDO'][3]['Headline'] }}</a></h5>
                                                        </header>
                                                    </article>
                                                </div>
                                                @endif
                                                @if(!empty($jsonDecodeVdoAll['dataListVDO'][4]))
                                                <div class="small-12 medium-6 large-6 columns second-news">
                                                    <article itemscope="" itemtype="http://schema.org/Article" class="post style3-small" id="post-17793" role="article">
                                                        <figure class="post-gallery ">
                                                            <a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][4] ['VdoID']) }}">
                                                                <img width="540" height="280" src="https://i.ytimg.com/vi/{{ substr($jsonDecodeVdoAll['dataListVDO'][4]['VdoUrl'], strpos($jsonDecodeVdoAll['dataListVDO'][4]['VdoUrl'], 'embed/') + 6) }}/mqdefault.jpg" alt="" itemprop="image">
                                                            </a>
                                                        </figure>

                                                        <header class="post-title entry-header">
                                                            <h5 itemprop="headline"><a href="{{ URL::to('/video/' .$jsonDecodeVdoAll['dataListVDO'][4]['VdoID']) }}" title="{{ $jsonDecodeVdoAll['dataListVDO'][4]['Headline'] }}">{{ $jsonDecodeVdoAll['dataListVDO'][4]['Headline'] }}</a></h5>
                                                        </header>
                                                    </article>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- Event Content -->
                                <div class="small-12 medium-4 large-4 columns">
                                    <div class="row endcolumn catelement-style1">
                                        <div class="small-12 columns" style="margin-bottom: 20px;" >
                                            <div style="display: block;margin-top: 60px;">
                                                <h3 class="event">
                                                    <a href="{{ url('/video') }}" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">มุมกิจกรรม</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row endcolumn catelement-style1">
                                    <!-- Big 1 Video Content -->
                                        <div class="small-12 medium-12 large-12 columns" style="margin-bottom: 20px;">
                                            <article itemscope="" itemtype="http://schema.org/Article" class="post style3 post-17785 type-post status-publish format-standard has-post-thumbnail hentry category-pulse tag-featured tag-hypocrite tag-thailand tag-trump" id="post-17785" role="article">
                                                <figure class="post-gallery ">
                                                   <img width="540" height="280" src="https://thematter.co/wp-content/uploads/2017/06/tdri-web-540x280.png" class="attachment-thevoux-style3-small size-thevoux-style3-small wp-post-image" alt="" srcset="https://thematter.co/wp-content/uploads/2017/06/tdri-web-540x280.png 540w, https://thematter.co/wp-content/uploads/2017/06/tdri-web-300x157.png 300w" sizes="(max-width: 540px) 100vw, 540px">
                                                </figure>
                                                <header class="post-title entry-header">
                                                    <h3 itemprop="headline"><a href="https://thematter.co/pulse/thai-in-trump/17785" title="ในความทรัมป์ มีความไทย">ในความทรัมป์ มีความไทย</a></h3>
                                                </header>
                                                <div class="post-content small">
                                                    <p>ภายใต้ภาวะอากาศแห้งแล้งเช่นนี้ได้มีชาวบ้านที่ชุมชนสันป่าสักพัฒนา จ.เชียงราย รายหนึ่งหันมาปลูกพืชที่ทนแล้งและสร้างมูลค่าเพิ่มจากผลผลิตได้เป็นอย่างดี นอกจากนี้ยังตอนกิ่งและนำเมล็ดผักหวานป่าที่ได้ออกขายสร้างรายได้เสริมได้เป็นอย่างดีด้วย</p>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <!-- Ads Desktop #2 -->
                                    <div class="fixed-me hidden-xs">
                                        <div class="wpb_widgetised_column wpb_content_element">
                                            <div class="wpb_wrapper">
                                                <div id="text-9" class="widget cf style3 widget_text" >
                                                    <div class="textwidget text-center">
                                                        <img src="{{ URL::asset('homepage/images/ads/336x280.png') }}" alt="" style="width: 100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sticky-content-spacer"></div>
                                </div>
                                <div class="small-12 columns hidden-sm hidden-md hidden-lg">
                                        <div id="text-9" class="widget cf style3 widget_text">
                                            <div class="textwidget text-center" >
                                                <img src="{{ URL::asset('homepage/images/ads/320x100.png') }}" alt="" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                <aside class="gap cf" style="height:30px;"></aside>
                            </div>
                        <!-- End Third Content -->

                    </article>
                </section>
            </div>
            <!-- End role["main"] -->

@endsection


