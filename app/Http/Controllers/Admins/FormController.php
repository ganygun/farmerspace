<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class FormController extends Controller {
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
			'timeout' => 2.0,
		]);

		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Search_Product&ProductName=");
		$bodySearch = $response->getBody();
		$jsonDecode = json_decode($bodySearch, true);
		if (!empty($jsonDecode['dataListProduct'])) {
			return view('admins.dashboard.form')
				->with('jsonDecode', json_decode($bodySearch, true))
				->with('result', '');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$search = \Request::get('formtype'); //<-- we use global request to get the param of URI
		$pname = \Request::get('pname'); //<-- we use global request to get the param of URI

		return view('admins.dashboard.form.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 4.0,
		]);

		$pid = Session::get('productKey');

		/* check type and language */
		foreach (explode(" ", $request->input('formtype')) as $key => $value) {
			switch ($key) {
			case '0':
				$type = $value;
				break;
			case '3':
				if ($value == 'English') {
					$lang = 'ENG';
				} elseif ($value == 'Thai') {
					$lang = 'THA';
				}
				break;
			default:
				# code...
				break;
			}
		}
		// Generate Link ------------------------------
		$genLink = '/form/' . $pid . '/' . $type . '/' . $lang . '';
		// --------------------------------------------
		// Insert Form Link --------------------
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'EditLink',
					'ID' => '',
					'ProductID' => $pid,
					'Link' => $genLink,
					'Type' => $type,
					'Language' => $lang,
					'CreateDate' => date("Y-m-d H:i:s"),
				],
			]);
		$bodySearch = $response->getBody();
		$jsonDecode_bodySearch = json_decode($bodySearch, true);
		// --------------------------------------------

		flash('Successfully Updated', 'success');
		return back();
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
		echo "YOLO";
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

	public function SearchFormProduct() {
		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 2.0,
		]);
		$search = \Request::get('search'); //<-- we use global request to get the param of URI
		// Search Product -------------------------------
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'Search_Product',
					'ProductName' => $search,
				],
			]);
		$bodySearch = $response->getBody();
		$jsonDecode_bodySearch = json_decode($bodySearch, true);
		// --------------------------------------------
		if (!empty($jsonDecode_bodySearch['dataListProduct'][0]['ProductID'])) {
			Session::put('productKey', $jsonDecode_bodySearch['dataListProduct'][0]['ProductID']);

			// Show Link -------------------------------
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'ShowProductLink',
						'ProductID' => $jsonDecode_bodySearch['dataListProduct'][0]['ProductID'],
					],
				]);
			$bodyLink = $response->getBody();
			$jsonDecode_bodyLink = json_decode($bodyLink, true);
			// --------------------------------------------
			// Show Species Overview Detail----------------
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'ShowSpecies',
						'ProductID' => $jsonDecode_bodySearch['dataListProduct'][0]['ProductID'],
						'Species' => 'Overview',
					],
				]);
			$bodyOverview = $response->getBody();
			$jsonDecode_bodyOverview = json_decode($bodyOverview, true);
			// --------------------------------------------
			// Show Product -------------------------------
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'ShowProduct',
						'ProductID' => $jsonDecode_bodySearch['dataListProduct'][0]['ProductID'],
					],
				]);
			$bodyProduct = $response->getBody();
			$jsonDecode_bodyProduct = json_decode($bodyProduct, true);
			// --------------------------------------------
		}

		if ($search == "") {
			return redirect('/admins/form');
		} else if (!empty($jsonDecode_bodySearch['dataListProduct'])) {
			return view('admins.dashboard.form')
				->with('jsonDecode_bodySearch', json_decode($bodySearch, true))
				->with('jsonDecode_bodyLink', json_decode($bodyLink, true))
				->with('jsonDecode_bodyOverview', json_decode($bodyOverview, true))
				->with('jsonDecode_bodyProduct', json_decode($bodyProduct, true))
				->with('result', 'done');
		} else {
			return view('admins.dashboard.form')->with('result', 'error');
		}

		//$offices = Office::where('name','like','%'.$search.'%')
		//    ->orderBy('name')
		//     ->paginate(20);
	}
}