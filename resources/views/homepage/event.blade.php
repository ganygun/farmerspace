@extends('homepage.layouts.master') @section('content')
<script>
    $('title').html('มุมกิจกรรม');
</script>
<style>
	.card{
		-webkit-box-shadow: 0px 0px 15px 1px rgba(87,87,87,1);
		-moz-box-shadow: 0px 0px 15px 1px rgba(87,87,87,1);
		box-shadow: 0px 0px 15px 1px rgba(87,87,87,1);
	}
	.post .post-content.small {
	    overflow: hidden;
	    text-overflow: ellipsis;
	    display: -webkit-box;
	    line-height: 24px;
	    /* fallback */
	    max-height: 80px;
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
    <section>
            <div class="row archive-page-container">
            	<div class="small-12 medium-10 medium-offset-1 large-6 large-offset-3 columns">
                	<aside class="gap cf" style="height:40px;">
                    </aside>
                    <div class="row">
	                    <div class="small-12 medium-12 large-12 columns" >
			                    <div id="posts">
				                    @if(!empty($jsonDecodeEventAll['dataListEvent']))
		                   			@foreach($jsonDecodeEventAll['dataListEvent'] as $key => $dataListEvent)
	                               		@if($key<3)
						            	<article class="post style1 " id="post-18446" itemscope="" itemtype="http://schema.org/Article" role="article">
						                    <div class="row" style="margin:20px 0;">
						                            <div class="small-12 medium-12 large-12 columns card" style="padding: 0px;">
						                                <figure class="post-gallery ">
						                                    <a href="{{ URL::to('/event/' . $jsonDecodeEventAll['dataListEvent'][$key]['EventID']) }}" title="">
						                                        <img alt="" class="attachment-thevoux-style1 size-thevoux-style1 wp-post-image" height="460" itemprop="image" sizes="(max-width: 600px) 100vw, 600px" src="{{ $jsonDecodeEventAll['dataListEvent'][$key]['HeadlinePic'] }}" srcset="" width="600"/>
						                                    </a>
						                                </figure>
						                                <header class="post-title entry-header" style="padding:0 20px;">
						                                    <h3 itemprop="headline">
						                                        <a href="{{ URL::to('/event/' . $jsonDecodeEventAll['dataListEvent'][$key]['EventID']) }}" title="">
						                                       {{ $jsonDecodeEventAll['dataListEvent'][$key]['Headline'] }}
						                                        </a>
						                                    </h3>
						                                </header>
						                                <div class="post-content small" style="padding:0 30px;">
						                                    <p>
						                                       {!! $jsonDecodeEventAll['dataListEvent'][$key]['Content'] !!}
						                                    </p>
						                                </div>
						                                <aside class="gap cf" style="height:40px;"></aside>
						                            </div>
						                    </div>
						                </article>
						            	@endif
						            @endforeach
						            @endif
					            </div>
	                   	<div>
	                   
	                    <aside class="gap cf" style="height:40px;"></aside>
	                    	<!-- Ads  -->
					    <div class="small-12  medium-12 large-12" style="margin-top: 20px;">
					            <div class="widget cf style3 widget_text" id="text-9">
					                <div class="textwidget text-center" >
					                    <img alt="" src="{{ URL::asset('homepage/images/ads/320x100.png') }}" style="width: 100%">
					                    </img>
					                </div>
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
				                        $('#loading').hide();
				                        $.ajax({
				                            url: '/event/page/'+i,
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
            </div>
    </section>
    <!-- End Archive title -->
</div>
<!-- End role["main"] -->
@endsection
