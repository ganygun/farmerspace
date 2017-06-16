<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller {
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
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
				['query' =>
					['Method' => 'ShowUserInfo',
						'Phone' => Session::get('phone'),
						'PWD' => Session::get('pwd'),
					],
				]);

			$bodyShowUserInfo = $response->getBody();
			$jsonDecode = json_decode($bodyShowUserInfo, true);
			if (!empty($jsonDecode['dataListUserInfo'])) {

				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowUserProfile',
							'UserID' => $jsonDecode['dataListUserInfo'][0]['UserID'],
						],
					]);

				$bodyShowUserProfile = $response->getBody();
				$jsonDecodeShowUserProfile = json_decode($bodyShowUserProfile, true);
				return view('admins.dashboard.profile')
					->with('jsonDecode', json_decode($bodyShowUserInfo, true))
					->with('jsonDecodeShowUserProfile', json_decode($bodyShowUserProfile, true))
					->with('star', ($jsonDecodeShowUserProfile['dataListProfile'][0]['Score'] / 2));
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
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}

		try {
			$Phone = str_replace(' ', '', $request->input('Phone'));
			/*
					echo $request->input('UserID') . '<br>';
					echo $request->input('FirstName') . '<br>';
					echo $request->input('LastName') . '<br>';
					echo $Phone . '<br>';
					echo $request->input('FarmName') . '<br>';
					echo $request->input('Address') . '<br>';
					echo $request->input('Province') . '<br>';
					echo $request->input('District') . '<br>';
					echo $request->input('SubDistrict') . '<br>';
					echo $request->input('Zipcode') . '<br>';
					echo $request->input('QRCode') . '<br>';
					echo $request->input('PathFile') . '<br>';
					echo $request->input('Score') . '<br>';
					echo $request->input('Penname') . '<br>';
					echo $request->input('Description') . '<br>';
			*/

			$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=EditUserInfo';

			$postData = '&UserID=' . $request->input('UserID') . '&FirstName=' . $request->input('FirstName') . '&LastName=' . $request->input('LastName') . '&Phone=' . $Phone . '&FarmName=' . $request->input('FarmName') . '&Address=' . $request->input('Address') . '&Province=' . $request->input('Province') . '&District=' . $request->input('District') . '&SubDistrict=' . $request->input('SubDistrict') . '&Zipcode=' . $request->input('Zipcode') . '&UpdateDate=' . date("Y-m-d H:i:s") . '&PictureProfile=' . $request->input('PathFile') . '&PenName=' . $request->input('Penname') . '&Description=' . $request->input('Description');

			$data = $postData;

			// use key 'http' even if you send the request to https://...
			$options = array(
				'http' => array(
					'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
					'method' => 'POST',
					'content' => $data,
				),
			);

			$context = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			if ($result === FALSE) { /* Handle error */}

			if ($result == 'Valid') {
				Session::put('profile_picture', $request->input('PathFile'));
				flash($result . ' To Profile Successful', 'success');
				return Redirect('admins/profile');
			} else {
				flash($result . ', Please Check it', 'danger');
				return Redirect('admins/profile');
			}
		} catch (Exception $e) {
            return $e->getMessage();
		}
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
