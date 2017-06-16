@extends('homepage.layouts.master') @section('content')
<script>
    $('title').html('มุมวีดีโอ');
</script>
<style>
	.btn-video{
		padding: 12px 25px;
		border-radius: 0px;
		color:#fff;
		background-color: #31383e;
		font-size: 1em;
		font-weight: 300;
        text-decoration: none;
	}
    a:hover,a:focus{
        text-decoration: none;
    }
	.post .post-content.small p {
	    overflow: hidden;
	    text-overflow: ellipsis;
	    display: -webkit-box;
	    line-height: 24px;
	    /* fallback */
	    max-height: 92px;
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
	}
</style>

<div class="cf" role="main">
    <!-- Start Archive title -->
    <section class="" style="background-color: #5093e1;">
                <div class="row archive-page-container">
                    <div class="small-12 medium-10 medium-offset-1 large-8 large-offset-2 columns">
                        <aside class="gap cf" style="height:40px;">
                        </aside>
                        <div class="row">
                        @if(!empty($jsonDecodeVdoAll['dataListVDO']))
                                <div class="small-12 medium-6 large-6 columns" style="padding-top: 20px;">
                                    <h3 style="color:#fff;"">{{ $jsonDecodeVdoAll['dataListVDO'][0]['Headline'] }}<h3>
                                    <a class=" btn-lg btn-video pull-right" href="{{ URL::to('video/' . $jsonDecodeVdoAll['dataListVDO'][0]['VdoID']) }}">ดูวีดีโอ ></a>
                                </div>
                                <div class="small-12 medium-6 large-6 columns">
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $jsonDecodeVdoAll['dataListVDO'][0]['VdoUrl'] }}"></iframe>
                                </div>
                                </div>
                        @endif
                        </div>
                    </div>
                </div>
    </section>
    <!-- End Archive title -->
     <aside class="gap cf" style="height:40px;"></aside>
    <div class="row archive-page-container">
        <div class="small-12 medium-10 medium-offset-1 large-8 large-offset-2 columns" style="padding: 0;">
            <div id="posts">
                <article class="post style1 " id="post-18446" itemscope="" itemtype="http://schema.org/Article" role="article">
                          @if(!empty($jsonDecodeVdoAll['dataListVDO']))
                    @foreach($jsonDecodeVdoAll['dataListVDO'] as $key => $dataListVDO)
                            <div class="row" style="margin:20px 0;">
                                <div class="small-12 medium-4 large-4 columns">
                                    @if($key<4 && $key != 0)
                                        <figure class="post-gallery ">
                                            <a href="{{ URL::to('video/' . $jsonDecodeVdoAll['dataListVDO'][$key]['VdoID']) }}" title="">
                                                <!-- 16:9 aspect ratio -->
                                                <div class="embed-responsive embed-responsive-16by9">
                                                     <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $jsonDecodeVdoAll['dataListVDO'][$key]['VdoUrl'] }}"></iframe>
                                                </div>
                                            </a>
                                        </figure>
                                        <header class="post-title entry-header">
                                            <h3 itemprop="headline">
                                                <a href="{{ URL::to('video/' . $jsonDecodeVdoAll['dataListVDO'][$key]['VdoID']) }}" title="">
                                                 {{ $jsonDecodeVdoAll['dataListVDO'][$key]['Headline'] }}
                                                </a>
                                            </h3>
                                        </header>
                                        <div class="post-content small">
                                            <p>
                                            {!! $jsonDecodeVdoAll['dataListVDO'][$key]['Highlight'] !!}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="margin:20px 0;">
                                @if($key<7 && $key != 0)
                                <div class="small-12 medium-4 large-4 columns">
                                        <figure class="post-gallery ">
                                            <a href="{{ URL::to('video/' . $jsonDecodeVdoAll['dataListVDO'][$key]['VdoID']) }}" title="">
                                               <!-- 16:9 aspect ratio -->
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $jsonDecodeVdoAll['dataListVDO'][$key]['VdoUrl'] }}"></iframe>
                                                </div>
                                            </a>
                                        </figure>
                                        <header class="post-title entry-header">
                                            <h3 itemprop="headline">
                                                <a href="{{ URL::to('video/' . $jsonDecodeVdoAll['dataListVDO'][$key]['VdoID']) }}" title="">
                                                 {{ $jsonDecodeVdoAll['dataListVDO'][$key]['Headline'] }}
                                                </a>
                                            </h3>
                                        </header>
                                        <div class="post-content small">
                                            <p>
                                            {{ $jsonDecodeVdoAll['dataListVDO'][$key]['Highlight'] }}
                                            </p>
                                            
                                        </div>
                                </div>
                                @endif
                            </div>
                              @endforeach
                @endif
                        </article>
                  
            </div>
        </div>
        <!-- Load page -->
        <div class="small-12 medium-8 medium-offset-2 columns">
            <p class="text-center" id="loading">
                <img alt="Loading…" src="{{ URL::asset('homepage/images/loading.gif') }}" style="width: 150px;"/>
            </p>
            <script>
                $(document).ready(function() {
                var win = $(window);
                var i={{ session('countPage') }};
                // Each time the user scrolls
                win.scroll(function() {
                    // End of the document reached?
                    if ($(document).height() - win.height() == win.scrollTop()) {
                        $('#loading').show();
                        $.ajax({
                            url: '/video/page/'+i,
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
