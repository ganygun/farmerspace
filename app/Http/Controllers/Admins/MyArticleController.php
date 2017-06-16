<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class MyArticleController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}
		
		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 5.0,
		]);

		try {
			// Header --------------------------------------------------------------------------------
				// Get User's Name
					$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
						['query' =>
							['Method' => 'ShowUserInfo',
								'Phone' => Session::get('phone'),
								'PWD' => Session::get('pwd'),
							],
						]);
					$bodyInfo = $response->getBody();
					$jsonDecodeInfo = json_decode($bodyInfo, true);

				// Get Profile Picture
					$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
						['query' =>
							['Method' => 'ShowUserProfile',
								'UserID' => Session::get('key'),
							],
						]);
					$bodyGetPic = $response->getBody();
					$jsonDecodeGetPic = json_decode($bodyGetPic, true);
	 
				// Get company name by company id.
					$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
						['query' =>
							['Method' => 'ShowUserProfile',
								'UserID' => $jsonDecodeGetPic['dataListProfile'][0]['Company'],
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
			// End Header --------------------------------------------------------------------------------

			// Event --------------------------------------------------------------------------------

				// Select False Event
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowAllEventU',
							'EventID' => '',
							'UserID' => Session::get('key'),
							'IsVerify' => 'false',
						],
					]);
				$bodyUserEventFalse = $response->getBody();
				$jsonDecodeEventFalse = json_decode($bodyUserEventFalse, true);

				// Select True Event
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowAllEventU',
							'EventID' => '',
							'UserID' => Session::get('key'),
							'IsVerify' => 'true',
						],
					]);
				$bodyUserEventTrue = $response->getBody();
				$jsonDecodeEventTrue = json_decode($bodyUserEventTrue, true);
			// End Event --------------------------------------------------------------------------------


			// Video --------------------------------------------------------------------------------

				// Select False Video
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowAllVdoU',
							'VdoID' => '',
							'UserID' => Session::get('key'),
							'IsVerify' => 'false',
						],
					]);
				$bodyUserVideoFalse = $response->getBody();
				$jsonDecodeVideoFalse = json_decode($bodyUserVideoFalse, true);

				// Select True Video
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowAllVdoU',
							'VdoID' => '',
							'UserID' => Session::get('key'),
							'IsVerify' => 'true',
						],
					]);
				$bodyUserVideoTrue = $response->getBody();
				$jsonDecodeVideoTrue = json_decode($bodyUserVideoTrue, true);
			// End Video --------------------------------------------------------------------------------

				
			// Article --------------------------------------------------------------------------------
				// Select False Article
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowAllNewsUser',
							'ProductID' => '',
							'UserID' => Session::get('key'),
							'IsVerify' => 'false',
						],
					]);
				$bodyUserNewsFalse = $response->getBody();
				$jsonDecodeNewsFalse = json_decode($bodyUserNewsFalse, true);

				// Select True Article
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowAllNewsUser',
							'ProductID' => '',
							'UserID' => Session::get('key'),
							'IsVerify' => 'true',
						],
					]);
				$bodyUserNewsTrue = $response->getBody();
				$jsonDecodeNewsTrue = json_decode($bodyUserNewsTrue, true);
			// End Article --------------------------------------------------------------------------------
			
		

			# dont have some news
			if (empty($jsonDecodeNewsFalse['dataListNews']) && empty($jsonDecodeNewsTrue['dataListNews']) && empty($jsonDecodeEventFalse['dataListEvent']) && empty($jsonDecodeEventTrue['dataListEvent']) && empty($jsonDecodeVideoFalse['dataListVDO']) && empty($jsonDecodeVideoTrue['dataListVDO'])) {
				return view('admins.dashboard.myarticle')
					->with('Company',$Company)
					->with('result', 'donthave')
					->with('profile_picture', $jsonDecodeGetPic['dataListProfile'][0]['PictureProfile'])
					->with('star', $jsonDecodeGetPic['dataListProfile'][0]['Score'] / 2)
					->with('farmname', $jsonDecodeInfo['dataListUserInfo'][0]['FarmName'])
					->with('myname', $jsonDecodeInfo['dataListUserInfo'][0]['FirstName'] . ' ' . $jsonDecodeInfo['dataListUserInfo'][0]['LastName']);
			} else {
				# have news
				return view('admins.dashboard.myarticle')
					->with('Company',$Company)
					->with('jsonDecodeNewsFalse', json_decode($bodyUserNewsFalse, true))
					->with('jsonDecodeNewsTrue', json_decode($bodyUserNewsTrue, true))
					->with('jsonDecodeVideoFalse', json_decode($bodyUserVideoFalse, true))
					->with('jsonDecodeVideoTrue', json_decode($bodyUserVideoTrue, true))
					->with('jsonDecodeEventFalse', json_decode($bodyUserEventFalse, true))
					->with('jsonDecodeEventTrue', json_decode($bodyUserEventTrue, true))
					->with('result', 'have')
					->with('profile_picture', $jsonDecodeGetPic['dataListProfile'][0]['PictureProfile'])
					->with('star', $jsonDecodeGetPic['dataListProfile'][0]['Score'] / 2)
					->with('farmname', $jsonDecodeInfo['dataListUserInfo'][0]['FarmName'])
					->with('myname', $jsonDecodeInfo['dataListUserInfo'][0]['FirstName'] . ' ' . $jsonDecodeInfo['dataListUserInfo'][0]['LastName']);

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
		//
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
