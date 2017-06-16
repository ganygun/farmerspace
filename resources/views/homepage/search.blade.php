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
        }

        @media screen and (min-width: 30em) {
            .head-line {
                font-size: 40px!important
            }
            .sub-head {
                font-size: 26px!important
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
            margin-top: -180px;
            }
        }
         @media screen and (min-width: 64em){
            .gap_img_product{
            margin-top: -120px;
            }
        }
          @media screen and (min-width: 65em){
            .gap_img_product{
            margin-top: -60px;
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
                <div class="row vc_row-fluid">
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
                            <form action="/search" class="searchform" method="get" role="search">
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
    <div class="row archive-page-container">

        <!-- Content #1  Mobile-->
        <div class="small-12 columns hidden-sm hidden-md hidden-lg text-center" style="word-break: break-word;">
            <p>{{ $key }}</p>
            <h1>{{ $key }}</h1>
            <div style="margin-top: 40px;"></div>
            <!-- Pictrue Product Mobile -->
            <div class="frame basic" id="basic">
                <ul id="image-gallery-1" class="cf clearfix">
                  <li><img src="{{ URL::asset('homepage/images/LogoMini.png') }}" data-high-res-src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" class="gallery-items"></li>
                  <li><img src="{{ URL::asset('homepage/images/LogoMini.png') }}" data-high-res-src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" class="gallery-items"></li>
                  <li><img src="{{ URL::asset('homepage/images/LogoMini.png') }}" data-high-res-src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" class="gallery-items"></li>
                  <li><img src="{{ URL::asset('homepage/images/LogoMini.png') }}" data-high-res-src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" class="gallery-items"></li>
                  <li><img src="{{ URL::asset('homepage/images/LogoMini.png') }}" data-high-res-src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" class="gallery-items"></li>
                  <li><img src="{{ URL::asset('homepage/images/LogoMini.png') }}" data-high-res-src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" class="gallery-items"></li>
                </ul>
            </div>

            <div style="margin-bottom: 40px;"></div>
            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
            <br>
            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
        </div>
        <!-- Content #1  Desktop-->
        <div class="small-12 medium-8 columns  hidden-xs" style="word-break: break-word;">
            <p>{{ $key }}</p>
            <h1>{{ $key }}</h1>
            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
            <br>
            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
        </div>

        <!-- Pictrue Product Desktop -->
        <div class=" medium-4 columns hidden-xs" style="margin-top: 20px;">

            <div id="image-gallery-1" class="cf clearfix">
                <img id="imagePreview" src="{{ URL::asset('homepage/images/LogoMini.png') }}" data-high-res-src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" class="gallery-items img img-responsive image center-block" style="margin-bottom: 20px;height: 250px" >
            </div>
            <div class="img_sub_hover">
                <img id="imageid" onmouseover="preview(this)" src="{{ URL::asset('homepage/images/LogoBergerBar.png') }}" alt="" width="80px" >
                <img id="imageid" onmouseover="preview(this)" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
                <img id="imageid" onmouseover="preview(this)" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
            </div>
        </div>
        <div class="small-12 medium-8 columns">
            <!-- Content #2 -->
            <div style="display: block;margin-top: 20px;">
                <h3 class="event">
                                    <a href="#" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">สายพันธุ์</a>
                                </h3>
            </div>
            <div style="display: block;margin-top: 20px;">
                <!-- Nav tabs -->
                <ul id="myTabs " class="nav nav-tabs" role="tablist" style="border:none;">
                        <li role="presentation" class="active" style="margin: 0 5px;">
                            <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                <h4><a class="label tag"  href="#home" aria-controls="home" role="tab" data-toggle="tab">test1</a></h4>
                            </div>
                        </li>
                        <li role="presentation" style="margin: 0 5px;">
                            <div class="text-center" style="display: inline-flex;flex-wrap: wrap;">
                                <h4><a class="label tag"  href="#profile" aria-controls="profile" role="tab" data-toggle="tab">test2</a></h4>
                            </div>
                        </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                 <div style="border-left: 15px solid #cccccc;padding:0 15px;">
                                            <h1>test1</h1>
                                            <div class="img_sub_hover" style="margin-bottom: 30px; width: 100%">
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoBergerBar.png') }}" alt="" width="80px" >
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
                                            </div>
                                        </div>
                                        <div style="padding-left:30px">
                                            <p>
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </p>
                                            <h3 class="event">
                                                <a href="#" title="" style="color: #222!important;white-space:nowrap;font-weight: 600">วิธีการปลูก</a>
                                            </h3>
                                            <p>
                                            sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                            </p>
                                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                                <div style="border-left: 15px solid #cccccc;padding:0 15px;">
                                            <h1>test2</h1>
                                            <div class="img_sub_hover" style="margin-bottom: 30px; width: 100%">
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoBergerBar.png') }}" alt="" width="80px" >
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
                                                <img id="imageid" class="gallery-items" src="{{ URL::asset('homepage/images/LogoMini.png') }}" alt="" width="80px" >
                                            </div>
                                </div>
                                <div style="padding-left:30px">
                                            <p>
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </p>
                                            <h3 class="event">
                                                <a href="#" title="" style="color: #222!important;white-space:nowrap;font-weight: 600">วิธีการปลูก</a>
                                            </h3>
                                            <p>
                                            sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                            </p>
                                </div>
                    </div>
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
            <!-- Content #3 -->
            <div style="display: block;margin-top: 20px;">
                <h3 class="event">
                        <a href="#" title="" class="text-left" style="color: #222!important;white-space:nowrap;font-weight: 600">ข่าวที่เกี่ยวข้อง</a>
                    </h3>
            </div>
            <div style="display: block;margin-top: 20px;">
                <div id="posts">
                    <article class="post style4" itemscope="" itemtype="http://schema.org/Article" role="article">
                        <figure class="post-gallery">
                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                <img class="resizeimg" height="125" sizes="(max-width: 125px) 100vw, 125px" src="https://i0.wp.com/thematter.co/wp-content/uploads/2017/01/language-cover.jpg?resize=125%2C125&ssl=1" width="125">
                                </img>
                            </a>
                        </figure>
                        <div class="style4-container">
                            <header class="post-title entry-header">
                                <h5 itemprop="headline">
                                                                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                                                                เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’
                                                                            </a>
                                                                        </h5>
                            </header>
                            <div class="post-content small">
                                <p>
                                    ธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจ
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="post style4" itemscope="" itemtype="http://schema.org/Article" role="article">
                        <figure class="post-gallery">
                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                <img class="resizeimg" height="125" sizes="(max-width: 125px) 100vw, 125px" src="https://i0.wp.com/thematter.co/wp-content/uploads/2017/01/language-cover.jpg?resize=125%2C125&ssl=1" width="125">
                                </img>
                            </a>
                        </figure>
                        <div class="style4-container">
                            <header class="post-title entry-header">
                                <h5 itemprop="headline">
                                                                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                                                                เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’
                                                                            </a>
                                                                        </h5>
                            </header>
                            <div class="post-content small">
                                <p>
                                    ธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจ
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="post style4" itemscope="" itemtype="http://schema.org/Article" role="article">
                        <figure class="post-gallery">
                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                <img class="resizeimg" height="125" sizes="(max-width: 125px) 100vw, 125px" src="https://i0.wp.com/thematter.co/wp-content/uploads/2017/01/language-cover.jpg?resize=125%2C125&ssl=1" width="125">
                                </img>
                            </a>
                        </figure>
                        <div class="style4-container">
                            <header class="post-title entry-header">
                                <h5 itemprop="headline">
                                                                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                                                                เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’
                                                                            </a>
                                                                        </h5>
                            </header>
                            <div class="post-content small">
                                <p>
                                    ธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจ
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="post style4" itemscope="" itemtype="http://schema.org/Article" role="article">
                        <figure class="post-gallery">
                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                <img class="resizeimg" height="125" sizes="(max-width: 125px) 100vw, 125px" src="https://i0.wp.com/thematter.co/wp-content/uploads/2017/01/language-cover.jpg?resize=125%2C125&ssl=1" width="125">
                                </img>
                            </a>
                        </figure>
                        <div class="style4-container">
                            <header class="post-title entry-header">
                                <h5 itemprop="headline">
                                                                            <a href="https://thematter.co/byte/tips-for-picking-up-a-new-lingo/17331" title="เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’">
                                                                                เรียนภาษาที่ 2 อย่างไร ไม่ให้เป็น ‘ภาระสมอง’
                                                                            </a>
                                                                        </h5>
                            </header>
                            <div class="post-content small">
                                <p>
                                    ธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจธรรมชาติของการเรียนรู้มักจะไม่ชอบฝืนตัวเอง สมองก็เช่นกัน ยิ่งคุณตั้งใจ
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- Load page -->
            <p class="text-center" id="loading">
                <img alt="Loading…" src="{{ URL::asset('homepage/images/loading.gif') }}" style="width: 150px;"/>
            </p>
            <script>
                $(document).ready(function() {
                var win = $(window);
                var i=1;
                // Each time the user scrolls
                win.scroll(function() {
                    // End of the document reached?
                    if ($(document).height() - win.height() == win.scrollTop()) {
                        $('#loading').show();
                        i++;
                        $.ajax({
                            url: '/search/page/{{ $key }}/'+i,
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
