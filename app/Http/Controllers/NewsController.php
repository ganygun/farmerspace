<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class NewsController extends Controller {
	/**
	 * Get Post by page id.
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getPost($id) {


		$client = new Client([
            // Base URI is used with relative requests
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);
        try {
	        //article.
	        $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
	            ['query' =>
	                ['Method' => 'ShowAllNews',
	                    'ProductID' => '',
	                    'Number' => '0',
	                    'Language' => 'THA',
	                ],
	            ]);

	        $bodyNewsAll = $response->getBody();
	        $jsonDecodeNewsAll = json_decode($bodyNewsAll, true);
	        if (Session::get('cerentPage') > count($jsonDecodeNewsAll['dataListNews'])) {
	        	exit();
			}
	        else if(!empty($jsonDecodeNewsAll['dataListNews'])) {
	        	// first, this page have 5 ea. and than we call more 10 ea.
				$id =Session::get('cerentPage');
				// count page to call in this times
				$countPage = $id + 10;
				// increase 1 ea. to call 6-15 = 10 ea.
				$id += 1;
	        	// for call by countPage & array position -1 Ex. index[6-10] array[5-9]
				for ($i = $id; $i <= $countPage ; $i++) {
					if (empty($jsonDecodeNewsAll['dataListNews'][$i-1])) {
						echo '<p class="text-center" style="margin: 40px 0;">ไม่พบรายการข่าว</p>';
						//echo '"'.Session('cerentPage').'"';
						break;
					}else{
						$Title = $jsonDecodeNewsAll['dataListNews'][$i-1]['Title'];
						$Picture = $jsonDecodeNewsAll['dataListNews'][$i-1]['Picture'];
						$Abstract = $jsonDecodeNewsAll['dataListNews'][$i-1]['Abstract'];
						$ID =$jsonDecodeNewsAll['dataListNews'][$i-1]['NewsID'];
						$Tag = $jsonDecodeNewsAll['dataListNews'][$i-1]['Tag'];
						echo '<article class="post style1 " id="post-18446" itemscope="" itemtype="http://schema.org/Article" role="article">
		                        <div class="row">
		                            <div class="small-12 medium-12 large-5 large-offset-1 columns">
		                                <figure class="post-gallery ">
		                                    <a href="'.url("/news/" . $ID).'" title="'.$Title.'">
		                                        <img alt="" class="attachment-thevoux-style1 size-thevoux-style1 wp-post-image" height="460" itemprop="image" sizes="(max-width: 600px) 100vw, 600px" src="'.$Picture.'" srcset="" width="600"/>
		                                    </a>
		                                </figure>
		                            </div>
		                            <div class="small-12 medium-12 large-6 columns">
		                                <header class="post-title entry-header">
		                                    <h3 itemprop="headline">
		                                        <a href="'.url("/news/" . $ID).'" title="'. $Title .'">
		                                            '. $Title .'
		                                        </a>
		                                    </h3>
		                                </header>
		                                <div class="post-content small">
		                                    <p>
		                                        '.$Abstract.'
		                                    </p>
		                                    <footer class="post-links">
		                                        <a class="post-link comment-link" href="'.url("/news/" . $ID).'" title="'. $Title .'">
		                                        </a>
		                                        <aside class="share-article-loop post-link">
		                                            <a class="boxed-icon social fill facebook" href="http://www.facebook.com/sharer.php?u='.url("/news/" . $ID).'">
		                                                <i class="fa fa-facebook">
		                                                </i>
		                                            </a>
		                                            <a class="boxed-icon social fill twitter" href="https://twitter.com/intent/tweet?text='. $Title .'&url='.url("/news/" . $ID).'">
		                                                <i class="fa fa-twitter">
		                                                </i>
		                                            </a>
		                                            <a class="boxed-icon social fill google-plus" href="http://plus.google.com/share?url='.url("/news/" . $ID).'">
		                                                <i class="fa fa-google-plus">
		                                                </i>
		                                            </a>
		                                        </aside>
		                                        <span>
		                                             <a id="fbCountShare'. $ID .'"></a>
	                                            <script>
	                                                var settings = {
	                                                  "async": true,
	                                                  "crossDomain": true,
	                                                  "url": "http://graph.facebook.com/?id=http://www.farmerspace.co/news/'. $ID .'",
	                                                  "method": "GET",
	                                                  "headers": {
	                                                    "cache-control": "no-cache",
	                                                    "postman-token": "3424a29d-c352-cb4b-ec15-aeef74649670"
	                                                  }
	                                                }

	                                                $.ajax(settings).done(function (response) {
	                                                    $("#fbCountShare'. $ID .'").html(response.share.share_count + " Share");
	                                                });
	                                            </script>
		                                        </span>
		                                    </footer>
		                                </div>
		                                <footer class="article-tags entry-footer">
		                                  <strong>
		                                        Tags:
		                                    </strong>';
		                                	foreach(explode(',', $Tag ) as $key => $Tags ){
		                                        if($key==0){
		                                            echo '<a href="/pre-production/search?tag='. $Tags .'" style="color:#2856FA;" title="">
		                                              '. $Tags .'</a>'.'';
		                                        }else{
		                                           echo ',
		                                           <a href="/pre-production/search?tag='. $Tags .'" style="color:#2856FA;" title="">
		                                                '. $Tags .'
		                                            </a>'.'';
		                                        }
		                                  	}
		            			echo 	'</footer>
		                            </div>
		                        </div>
		                    </article>';
					}
						//echo '"'.Session('cerentPage').'"';

					Session::put('cerentPage', $countPage);
		        }
	        }
        } catch (Exception $e) {
            return $e->getMessage();
        }

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$client = new Client([
            // Base URI is used with relative requests
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);
        
        try {
        	//article.
	        $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
	            ['query' =>
	                ['Method' => 'ShowAllNews',
	                    'ProductID' => '',
	                    'Number' => '10',
	                    'Language' => 'THA',
	                ],
	            ]);

	        $bodyNewsAll = $response->getBody();
	        $jsonDecodeNewsAll = json_decode($bodyNewsAll, true);
			
			Session::put('cerentPage', '5');
	        
	        if (!empty($jsonDecodeNewsAll['dataListNews'])) {
	            return view('homepage.news')
	                ->with('jsonDecodeNewsAll', json_decode($bodyNewsAll, true));
	        }
		} catch (Exception $e) {
			return $e->getMessage();
		}
       
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

		$client = new Client([
	        // Base URI is used with relative requests
	        // You can set any number of default request options.
	    	'timeout' => 10.0,
	    ]);
       try {
	        if (empty(\Request::get('preview')) && empty(\Request::get('type'))) {
		       	// get news content by id.
					$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
				       ['query' =>
				            ['Method' => 'ShowAllNews',
				                'ProductID' => '',
				                'Number' => '10',
				                'Language' => 'THA',
				            ],
				        ]);

				    $bodyNewsContent = $response->getBody();
				    $jsonDecodeNewsContent = json_decode($bodyNewsContent, true);

				foreach ($jsonDecodeNewsContent['dataListNews'] as $key => $value) {
					if ($jsonDecodeNewsContent['dataListNews'][$key]['NewsID'] == $id) {
						
						// get writer profile by create by.
						    $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
								['query' =>
									['Method' => 'ShowUserProfile',
										'UserID' => $jsonDecodeNewsContent['dataListNews'][$key]['CreatedBy'],
									],
								]);

							$bodyShowUserProfile = $response->getBody();
							$jsonDecodeShowUserProfile = json_decode($bodyShowUserProfile, true);

						// get product name by product id.
							$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
								['query' =>
									['Method' => 'ShowProduct',
										'ProductID' => $jsonDecodeNewsContent['dataListNews'][$key]['ProductID'],
									],
								]);

							$bodyShowProductName = $response->getBody();
							$jsonDecodeShowProductName = json_decode($bodyShowProductName, true);
							if (empty($jsonDecodeShowProductName['dataListProduct'][0]['ProductName'])) {
								$ProductName = '...';
							}
							else{
								$ProductName = $jsonDecodeShowProductName['dataListProduct'][0]['ProductName'];
							}
						
						// get company name by company id.
						    $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
								['query' =>
									['Method' => 'ShowUserProfile',
										'UserID' => $jsonDecodeShowUserProfile['dataListProfile'][0]['Company'],
									],
								]);

							$bodyGetCompanyName = $response->getBody();
							$jsonDecodeGetCompanyName = json_decode($bodyGetCompanyName, true);
							 if (isset($jsonDecodeGetCompanyName['dataListProfile'][0]['PenName'])) {
	                            $Company =  $jsonDecodeGetCompanyName['dataListProfile'][0]['PenName'];
	                        }
	                        else{
	                            $Company = 'Not Company';
	                        }

				        //------------- news Content---------------
							return view('homepage.news_content')
				            ->with('ID', $jsonDecodeNewsContent['dataListNews'][$key]['NewsID'])
				            ->with('Title', $jsonDecodeNewsContent['dataListNews'][$key]['Title'])
				            ->with('Abstract', $jsonDecodeNewsContent['dataListNews'][$key]['Abstract'])
				            ->with('Detail', $jsonDecodeNewsContent['dataListNews'][$key]['Detail'])
				            ->with('Picture', $jsonDecodeNewsContent['dataListNews'][$key]['Picture'])
				            ->with('Tag', $jsonDecodeNewsContent['dataListNews'][$key]['Tag'])
				        //------------- Profile---------------
				            ->with('PictureProfile', $jsonDecodeShowUserProfile['dataListProfile'][0]['PictureProfile'])
				            ->with('PenName', $jsonDecodeShowUserProfile['dataListProfile'][0]['PenName'])
				            ->with('Description', $jsonDecodeShowUserProfile['dataListProfile'][0]['Description'])
				            ->with('Company', $Company)
				        //------------- Product Detail---------------
				            ->with('ProductName', $ProductName);
					}
				}
	        }
			// preview article.
			elseif (\Request::get('preview') == 'true' && \Request::get('type') == 'article') {
				// get news content by id.
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
			       ['query' =>
			            ['Method' => 'ShowAllNewsUnApprove',
			                'ProductID' => '',
			                'Language' => '',
			            ],
			        ]);

			    $bodyNewsContent = $response->getBody();
			    $jsonDecodeNewsContent = json_decode($bodyNewsContent, true);

				foreach ($jsonDecodeNewsContent['dataListNewsUnApprove'] as $key => $value) {
					if ($jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['NewsID'] == $id) {

						// get product name by product id.
							$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
								['query' =>
									['Method' => 'ShowProduct',
										'ProductID' => $jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['ProductID'],
									],
								]);

							$bodyShowProductName = $response->getBody();
							$jsonDecodeShowProductName = json_decode($bodyShowProductName, true);
							if (empty($jsonDecodeShowProductName['dataListProduct'][0]['ProductName'])) {
								$ProductName = '...';
							}
							else{
								$ProductName = $jsonDecodeShowProductName['dataListProduct'][0]['ProductName'];
							}
					
				        //------------- news Content---------------
							return view('homepage.news_content')
				            ->with('ID', $jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['NewsID'])
				            ->with('Title', $jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['Title'])
				            ->with('Abstract', $jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['Abstract'])
				            ->with('Detail', $jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['Detail'])
				            ->with('Picture', $jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['Picture'])
				            ->with('Tag', $jsonDecodeNewsContent['dataListNewsUnApprove'][$key]['Tag'])
	                        ->with('Type', 'Article')
				        //------------- Profile---------------
				            ->with('PictureProfile', 'https://s3.amazonaws.com/whisperinvest-images/default.png')
				            ->with('PenName', 'PenName PenName')
				            ->with('Description', 'Description Description')
				            ->with('Company', 'Company Company')
				        //------------- Product Detail---------------
				            ->with('ProductName', $ProductName)
				            ->with('preview', 'true');
					}
				}
			}
			else{
				return redirect('/');
			}
		} catch (\Exception $e) {
		    return $e->getMessage();
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
