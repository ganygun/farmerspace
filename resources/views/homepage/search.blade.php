@extends('homepage.layouts.master') @section('content')

<!-- Style Iamge Scroll -->
<style>
    /* Frame */

    .frame {
      overflow: hidden;
    }

    .frame ul {
      list-style: none;
      margin: 0;
      padding: 0;
      height: 100%;
      font-size: 50px;
    }

    .frame ul li {
      float: left;
      width: 120px;
      height: 100%;
      margin: 0 5px 0 0;
      padding: 0;
      text-align: center;
      cursor: pointer;
    }

    .frame ul li.active {
      color: #fff;
      background: transparent;
    }
</style>
<style>
        .panel{
            border:none;
        }
        .post .post-content.small p {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            line-height: 24px;
            /* fallback */
            max-height: 44px;
            /* fallback */
            -webkit-line-clamp: 2;
            /* number of lines to show */
            -webkit-box-orient: vertical;
        }

        @media screen and (min-width: 15em) {
            /* Change to whatever media query you require */
            .head-line {
                font-size: 34px!important
            }
            .sub-head {
                font-size: 24px!important;
                margin-bottom: 10px!important;
                margin-top: -15px!important
            }
            .gap-header {
                height: 20px
            }
            .gap-content {
                padding-top: 40px;
            }
            .resizeimg{
                width: 75px!important;
                height: 75px;
            }
        }

        @media screen and (min-width: 30em) {
            .head-line {
                font-size: 40px!important
            }
            .sub-head {
                font-size: 26px!important
            }
            .resizeimg{
                width: 100px!important;
                height: 100px;
            }

        }

        @media screen and (min-width: 48em) {
            .head-line {
                font-size: 60px!important;
            }
            .sub-head {
                font-size: 30px!important;
                margin-bottom: 15px!important;
                margin-top: -5px!important
            }
            .gap-header {
                height: 60px
            }
            .gap-content {
                padding-top: 20px;
                padding-bottom: 5px;
            }
            .gap_img_product{
            margin-top: 40px;
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
            .gap_img_product{
            margin-top: 40px;
            }
        }
          @media screen and (min-width: 65em){
            .gap_img_product{
            margin-top: 40px;
            }
            .page_content{
                padding: 0 6em;
            }
        }

        .tag {
            color: #fff;
            padding: 8px;
            background-color: #66CC00;
            font-size: 14px;
            font-weight: 300;
        }

        .event {
            position: relative;
        }

        h3 a {
            background-color: white;
            padding-right: 10px;
            font-size: 18px;
            font-weight: 600;
        }

        .event:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0.6em;
            border-top: 4px solid #cccccc;
            z-index: -1;
        }
</style>
<style>
        .img_hover {
        position: relative;
        margin:auto;
        }
        .img_sub_hover{
            position: relative;
            margin:auto;
        }

        .image {
          opacity: 1;
          display: block;
          width: 350px;
          height:200px;
          height: auto;
          transition: .5s ease;
          backface-visibility: hidden;
        }

        .zoom {
          transition: .5s ease;
          opacity: 0;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%)
        }

        .img_hover:hover .image {
          opacity: 0.3;
        }

        .img_hover:hover .zoom {
          opacity: 1;
        }
        img:hover{
            cursor: zoom-in;
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
                            <form action="{{ URL::to('/search') }}" class="searchform" method="get" role="search">
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
    <div class="row archive-page-container page_content">
        @if(!empty($jsonDecodeProductDetails['dataListProductDetails']))
        <!-- Product ID -->
        <input type="hidden" name="ProductID" value="{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ProductID'] }}">

        <!-- Content #1  Mobile-->
            <div class="small-12 columns hidden-sm hidden-md hidden-lg text-center" style="word-break: break-word;">
                <!-- English Name -->
                <p>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['NameENG'] }}</p> 
                <!-- Thai Name -->
                <h1>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['NameTHA'] }}</h1>
                <div style="margin-top: 40px;"></div>
                <!-- Pictrue Product Mobile -->
                <div class="frame basic" id="basic">
                    <!-- Main ProductPicture -->
                    <ul id="image-gallery-1" class="cf clearfix">
                        <li>
                            <img src="{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ProductPicture'] }}" data-high-res-src="{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ProductPicture'] }}" alt="" class="gallery-items">
                        </li>
                        <!-- Sub OerviewPicture -->
                        @foreach($jsonDecodeProductOverview['dataListProductOverview'] as $dataListProductOverview)
                        @if($dataListProductOverview['Species'] == 'Overview' || $dataListProductOverview['Species'] == 'overview')
                        <li>
                            <img src="{{ $dataListProductOverview['Image'] }}" data-high-res-src="{{ $dataListProductOverview['Image'] }}" alt="" class="gallery-items">
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>

                <div style="margin-bottom: 40px;"></div>
                <!-- ItemDescription -->
                <p>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ItemDescription'] }}</p>
                <br>
                <!-- GrowingGuide -->
                <p>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['GrowingGuide'] }}</p>
            </div>
        <!-- Content #1  Desktop-->
            <div class="small-12 medium-8 columns hidden-xs" style="word-break: break-word;">
                <!-- English Name -->
                <p>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['NameENG'] }}</p> 
                <!-- Thai Name -->
                <h1>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['NameTHA'] }}</h1>
                 <!-- ItemDescription -->
                <p>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ItemDescription'] }}</p>
                <br>
                <!-- GrowingGuide -->
                @if(isset($jsonDecodeProductDetails['dataListProductDetails'][0]['GrowingGuide']))
                <p>{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['GrowingGuide'] }}</p>
                @endif
            </div>

            <!-- Pictrue Product Desktop -->
            <div class=" medium-4 columns hidden-xs text-center" style="margin-top: 20px;">
                <!-- Main ProductPicture -->
                <div id="image-gallery-1" class="cf clearfix" style="height: 200px;">
                    <img id="imagePreview" class="center-block" src="{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ProductPicture'] }}" data-high-res-src="{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ProductPicture'] }}" alt="" class="gallery-items img img-responsive image center-block" style="margin-bottom: 20px;height: auto;width: 200px;">
                </div>
                <!-- Sub OerviewPicture -->
                <div class="img_sub_hover">
                    <img id="imageid" onmouseover="preview(this)" src="{{ $jsonDecodeProductDetails['dataListProductDetails'][0]['ProductPicture'] }}" alt="" width="80px">
                    @foreach($jsonDecodeProductOverview['dataListProductOverview'] as $dataListProductOverview)
                        @if($dataListProductOverview['Species'] == 'Overview' || $dataListProductOverview['Species'] == 'overview')
                        <img id="imageid" onmouseover="preview(this)" src="{{ $dataListProductOverview['Image'] }}" alt="" width="80px" >
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
  
        @foreach($jsonDecodeProductOverview['dataListProductOverview'] as $dataListProductOverview)
            @if($dataListProductOverview['Species'] != 'Overview')
                @php $checkSpecies = 2; @endphp
                @break
            @else
                @php $checkSpecies = 1; @endphp
            @endif
        @endforeach
        <div class="small-12 medium-8 columns">
            @if(!empty($jsonDecodeProductOverview['dataListProductOverview']) && $checkSpecies == 2)
            <!-- Content #2 -->
            <div style="display: block;margin-top: 20px;">
                <h3 class="event">
                    <a href="#" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">สายพันธุ์</a>
                </h3>
            </div>
            <div style="display: block;margin-top: 20px;">
                <!-- Nav tabs -->
                <ul id="myTabs " class="nav nav-tabs" role="tablist" style="border:none;">
                @php
                    $temp = '';
                @endphp
                @foreach($jsonDecodeProductOverview['dataListProductOverview'] as $dataListProductOverview)
                    @if($dataListProductOverview['Species'] != 'Overview' && $dataListProductOverview['Species'] != 'overview')
                        @if($dataListProductOverview['Species'] != $temp)
                        <li role="presentation" class="active" style="margin: 0 5px;">
                            <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                <h4><a class="label tag"  href="#{{ $dataListProductOverview['Species'] }}" aria-controls="{{ $dataListProductOverview['Species'] }}" role="tab" data-toggle="tab">{{ $dataListProductOverview['Species'] }}</a></h4>
                            </div>
                        </li>
                        <?php $temp = $dataListProductOverview['Species']; ?>
                        @endif
                    @endif
                @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                @php
                    $temp = '';
                    $count = 1;
                @endphp
                @foreach($jsonDecodeProductOverview['dataListProductOverview'] as $key => $dataListProductOverview)
                    @if($dataListProductOverview['Species'] != 'Overview' && $dataListProductOverview['Species'] != 'overview')
                        @if($dataListProductOverview['Species'] != $temp) 
                            @if($count == 1) 
                            <div role="tabpanel" class="tab-pane fade in active" id="{{ $dataListProductOverview['Species'] }}">
                            <?php $count++; ?>
                            @else
                            <div role="tabpanel" class="tab-pane fade in" id="{{ $dataListProductOverview['Species'] }}">
                            @endif
                            <div style="border-left: 15px solid #cccccc;padding:0 15px;">
                                <h1>{{ $dataListProductOverview['Species'] }}</h1>
                                <div class="img_sub_hover" style="margin-bottom: 30px; width: 100%">
                                    @foreach($jsonDecodeProductOverview['dataListProductOverview'] as $dataListSpeciesPic)
                                        @if($dataListSpeciesPic['Species'] == $dataListProductOverview['Species'] && $dataListSpeciesPic['Image'] != '')
                                        <img id="imageid" class="gallery-items" src="{{ $dataListSpeciesPic['Image'] }}" alt="" width="80px" >
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div style="padding-left:30px">
                                @php
                                    $client = new GuzzleHttp\Client;
                                    // Get company name by company id.
                                    $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                        ['query' =>
                                            ['Method' => 'ShowSpecies',
                                                'ProductID' => $jsonDecodeProductDetails['dataListProductDetails'][0]['ProductID'],
                                                'Species' => $dataListProductOverview['Species'],
                                            ],
                                        ]);
                                    $bodyGetInfoSpecies = $response->getBody();
                                    $jsonDecodeGetInfoSpecies = json_decode($bodyGetInfoSpecies, true);
                                @endphp
                                @if (isset($jsonDecodeGetInfoSpecies['dataListSpecies'])) 
                                <!-- ItemDescription -->
                                    <p>{{ $jsonDecodeGetInfoSpecies['dataListSpecies'][0]['ItemDescription'] }}</p>
                                <!-- GrowingGuide -->
                                    @if (!empty($jsonDecodeGetInfoSpecies['dataListSpecies'][0]['GrowingGuide'])) 
                                        <h3 class="event">
                                            <a href="#" title="" style="color: #222!important;white-space:nowrap;font-weight: 600">วิธีการปลูก</a>
                                        </h3>
                                        <p>{{ $jsonDecodeGetInfoSpecies['dataListSpecies'][0]['GrowingGuide'] }}</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <?php $temp = $dataListProductOverview['Species']; ?>
                        @endif
                    @endif
                @endforeach
                </div>
            </div>
            <!-- Ads Mobile -->
            <div class="hidden-sm hidden-md hidden-lg" style="margin-top: 20px;">
                <div class="widget cf style3 widget_text" id="text-9">
                    <div class="textwidget text-center">
                        <img alt="" src="{{ URL::asset('homepage/images/ads/320x100.png') }}" style="width: 100%">
                        </img>
                    </div>
                </div>
            </div>
            @else
                <div style="display: block;margin-top: 20px;">
                    <h3 class="event">
                        <a href="#" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">สายพันธุ์</a>
                    </h3>
                </div>
                <div style="display: block;margin-top: 20px;padding-bottom: 40px;">
                <h3 class="text-center">ไม่พบข้อมูลสายพันธุ์ของ "{{ $key_search }}"</h3>
                </div>
            @endif
       
            @if(!empty($jsonDecodeProductNews['dataListProductNews']))
            <!-- Content #3 -->
                <div style="display: block;margin-top: 20px;">
                    <h3 class="event">
                            <a href="#" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">ข่าวที่เกี่ยวข้อง</a>
                    </h3>
                </div>
                <div style="display: block;margin-top: 20px;padding-bottom: 40px;">
                    <style>
                        .load_content{
                            overflow: hidden;
                            display: -webkit-box;
                            max-height: 460px;
                            -webkit-box-orient: vertical;
                        }
                    </style>
                    <div id="posts" class="load_content">
                        @foreach($jsonDecodeProductNews['dataListProductNews'] as $key => $dataListProductNews)
                        <article class="post style4" itemscope="" itemtype="http://schema.org/Article" role="article">
                            <figure>
                                <a href="{{ URL::to('/news/' .$jsonDecodeProductNews['dataListProductNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeProductNews['dataListProductNews'][$key]['Title'] }}">
                                    <img style="cursor: pointer;" height="125" sizes="(max-width: 125px) 100vw, 125px" src="{{ $jsonDecodeProductNews['dataListProductNews'][$key]['Picture'] }}" width="125">
                                    </img>
                                </a>
                            </figure>
                            <div class="style4-container">
                                <header class="post-title entry-header">
                                    <h5 itemprop="headline">
                                        <a href="{{ URL::to('/news/' .$jsonDecodeProductNews['dataListProductNews'][$key]['NewsID']) }}" title="{{ $jsonDecodeProductNews['dataListProductNews'][$key]['Title'] }}">
                                            {{ $jsonDecodeProductNews['dataListProductNews'][$key]['Title'] }}
                                        </a>
                                    </h5>
                                </header>
                                <div class="post-content small">
                                    <p>
                                        {{ $jsonDecodeProductNews['dataListProductNews'][$key]['Abstract'] }}
                                    </p>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    <!-- Load page -->
                   <div class="fixed-me">
                        <div class="wpb_widgetised_column wpb_content_element">
                            <div class="wpb_wrapper">
                                <div id="text-9" class="widget cf style3 widget_text">
                                    <button class="btn textwidget" id="loadmore" style="display: block;width: 100%;height: 60px;text-align: center;font-size: 19px;background-color: #5d5d5d;word-break: break-all;text-align: center;vertical-align: middle;padding-top: 20px;margin-top: -50px;color:#fff;font-weight: 600">Load more<br><i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $('#loadmore').click(function() {
                            $(this).hide();
                            $('html, body').animate({ scrollTop: $(document).height() }, 'slow');
                            $('.load_content').css({ 'max-height': 'none' }); // for increase use += ..px 
                        });
                    </script>
                </div>
            @else
                <div style="display: block;margin-top: 20px;">
                    <h3 class="event">
                            <a href="#" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">ข่าวที่เกี่ยวข้อง</a>
                    </h3>
                </div>
                <div style="display: block;margin-top: 20px;padding-bottom: 40px;">
                <h3 class="text-center">ไม่พบข้อมูลข่าวที่เกี่ยวข้อง "{{ $key_search}}"</h3>
                </div>
            @endif
        </div>
        <!-- Ads Desktop -->
        <aside class="sidebar medium-4 columns hidden-xs gap_img_product">
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
    </div>

</div>
<!-- End role["main"] -->

<script type="text/javascript">
    function preview(p) {
        $('#imagePreview').attr('src', $(p).attr('src'));
        $('#imagePreview').attr('name', $(p).attr('name'));
        //$('#deleteImage').attr('name', $(p).attr('name'));
    }
</script>
<!-- Script Image Scroll -->
<script>
    jQuery(function($) {
  'use strict';

  // -------------------------------------------------------------
  //   Basic Navigation
  // -------------------------------------------------------------
 (function() {
    var $frame = $('#basic');
    var $slidee = $frame.children('ul').eq(0);
    var $wrap = $frame.parent();

    // Call Sly on frame
    $frame.sly({
      horizontal: 1,
      itemNav: 'basic',
      smart: 1,
      activateOn: 'click',
      mouseDragging: 1,
      touchDragging: 1,
      releaseSwing: 1,
      startAt: 3,
      scrollBar: $wrap.find('.scrollbar'),
      scrollBy: 1,
      pagesBar: $wrap.find('.pages'),
      activatePageOn: 'click',
      speed: 300,
      elasticBounds: 1,
      easing: 'easeOutExpo',
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,

      // Buttons
      forward: $wrap.find('.forward'),
      backward: $wrap.find('.backward'),
      prev: $wrap.find('.prev'),
      next: $wrap.find('.next'),
      prevPage: $wrap.find('.prevPage'),
      nextPage: $wrap.find('.nextPage')
    });


  }());
});
</script>
<script>
    jQuery(function($) {
  'use strict';

  // -------------------------------------------------------------
  //   Basic Navigation
  // -------------------------------------------------------------
 (function() {
    var $frame = $('.basic');
    var $slidee = $frame.children('ul').eq(0);
    var $wrap = $frame.parent();

    // Call Sly on frame
    $frame.sly({
      horizontal: 1,
      itemNav: 'basic',
      smart: 1,
      activateOn: 'click',
      mouseDragging: 1,
      touchDragging: 1,
      releaseSwing: 1,
      startAt: 3,
      scrollBar: $wrap.find('.scrollbar'),
      scrollBy: 1,
      pagesBar: $wrap.find('.pages'),
      activatePageOn: 'click',
      speed: 300,
      elasticBounds: 1,
      easing: 'easeOutExpo',
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,

      // Buttons
      forward: $wrap.find('.forward'),
      backward: $wrap.find('.backward'),
      prev: $wrap.find('.prev'),
      next: $wrap.find('.next'),
      prevPage: $wrap.find('.prevPage'),
      nextPage: $wrap.find('.nextPage')
    });


  }());
});
</script>
<script>
            $(function () {
                var viewer = ImageViewer();
                $('.gallery-items').click(function () {
                    var imgSrc = this.src,
                        highResolutionImage = $(this).data('high-res-img');

                    viewer.show(imgSrc, highResolutionImage);
                });
            });
</script>
<script>
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
</script>

@endsection
