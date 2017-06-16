<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class VerifyController extends Controller {
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
			'timeout' => 10.0,
		]);

		//event.
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
			['query' =>
				['Method' => 'ShowAllEventUnApprove',
					'EventID' => '',
					'Language' => '',
				],
			]);

		$bodyEventUnApprove = $response->getBody();
		$jsonDecodeEvent = json_decode($bodyEventUnApprove, true);

		//video.
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
			['query' =>
				['Method' => 'ShowAllVdoUnApprove',
					'VdoID' => '',
					'Language' => '',
				],
			]);

		$bodyVideoUnApprove = $response->getBody();
		$jsonDecodeVideo = json_decode($bodyVideoUnApprove, true);

		//article.
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
			['query' =>
				['Method' => 'ShowAllNewsUnApprove',
					'ProductID' => '',
					'Language' => '',
				],
			]);

		$bodyNewsUnApprove = $response->getBody();
		$jsonDecodeNews = json_decode($bodyNewsUnApprove, true);

		if (!empty($jsonDecodeEvent['dataListEventUnApprove']) || !empty($jsonDecodeVideo['dataListVDOUnapprove']) || !empty($jsonDecodeNews['dataListNewsUnApprove'])) {
			return view('admins.dashboard.verify')
				->with('jsonDecodeEvent', json_decode($bodyEventUnApprove, true))
				->with('jsonDecodeVideo', json_decode($bodyVideoUnApprove, true))
				->with('jsonDecodeNews', json_decode($bodyNewsUnApprove, true))
				->with('result', 'found');
		} else {
			return view('admins.dashboard.verify')
				->with('result', 'notfound');
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
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

	
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
