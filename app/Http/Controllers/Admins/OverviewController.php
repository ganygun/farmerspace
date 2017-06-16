<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class OverviewController extends Controller {

	public function SearchSpecies() {
		$search = input::get('search'); //<-- we use global request to get the param of URI
		if ($search == "") {
			flash('Search is not found', 'danger');
			return redirect('/admins/product/overview/' . Session::get('productKey') . '/edit');

		}

		$client = new Client([
			// Base URI is used with relative requests
			'base_uri' => 'http://farmerspace.azurewebsites.net',
			// You can set any number of default request options.
			'timeout' => 20,
		]);
		// -------------- Get Species Images
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'ShowSpeciesPicture',
					'ProductID' => Session::get('productKey'),
					'Species' => $search,
				],
			]);
		$bodyImage = $response->getBody();
		$jsonDecode_bodyImage = json_decode($bodyImage, true);
		// --------------------------------------------

		// -------------- Get Species Detail
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'ShowSpecies',
					'ProductID' => Session::get('productKey'),
					'Species' => $search,
				],
			]);
		$bodySearch = $response->getBody();
		$jsonDecode_bodySearch = json_decode($bodySearch, true);
		// --------------------------------------------

		if (!empty($jsonDecode_bodySearch['dataListSpecies'])) {
			return view('admins.dashboard.product.overview')
				->with('jsonDecode_bodySearch', json_decode($bodySearch, true))
				->with('jsonDecode_bodyImage', json_decode($bodyImage, true));
			//->with('result', $search);
			# code...
		} else {
			flash('Search is not found', 'danger');
			return back();
		}
		//$offices = Office::where('name','like','%'.$search.'%')
		//    ->orderBy('name')
		//     ->paginate(20);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
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
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		} 

		Session::put('productKey', $id);

		$client = new Client([
			// Base URI is used with relative requests
			'base_uri' => 'http://farmerspace.azurewebsites.net',
			// You can set any number of default request options.
			'timeout' => 2.0,
		]);

		// -------------- Get Species Images
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'ShowSpeciesPicture',
					'ProductID' => Session::get('productKey'),
					'Species' => 'Overview',
				],
			]);
		$bodyImage = $response->getBody();
		$jsonDecode_bodyImage = json_decode($bodyImage, true);
		// --------------------------------------------

		// -------------- Get Species Detail
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'ShowSpecies',
					'ProductID' => Session::get('productKey'),
					'Species' => 'Overview',
				],
			]);
		$bodySearch = $response->getBody();
		$jsonDecode_bodySearch = json_decode($bodySearch, true);
		// --------------------------------------------

		if (!empty($jsonDecode_bodySearch['dataListSpecies'])) {
			return view('admins.dashboard.product.overview')
				->with('jsonDecode_bodySearch', json_decode($bodySearch, true))
				->with('jsonDecode_bodyImage', json_decode($bodyImage, true));
		} else {
			return view('admins.dashboard.product.overview')
				->with('jsonDecode_bodySearch', json_decode($bodySearch, true));

		}
		//flash('Message', 'info');
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
		
		$client = new Client([
			// You can set any number of default request options.
			'timeout' => 2.0,
		]);

		// -------------- Update Species Detail
		if (preg_match('/^[a-zA-Z0-9]+$/', $request->input('seacrh'))) {
			$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Update_SpeciesItem_ENG';

			$postData = '&UserID=' . Session::get('key') . '&ProductID=' . $id . '&Species=' . $request->input('seacrh') . '&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=' . $request->input('productItem') . '&GrowingGuide=' . $request->input('productGrowing') . '';

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
			$bodySpecies = $result;

		} else {
			$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Update_SpeciesItem_THA';

			$postData = '&UserID=' . Session::get('key') . '&ProductID=' . $id . '&Species=' . $request->input('seacrh') . '&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=' . $request->input('productItem') . '&GrowingGuide=' . $request->input('productGrowing') . '';

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
			$bodySpecies = $result;

		}
		// --------------------------------------------
		// -------------- Add Species Images
		if (!empty($request->input('PathFile'))) {
			foreach ($request->input('PathFile') as $value) {
				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
					['query' =>
						['Method' => 'Insert_SpeciesItem_Picture',
							'ProductID' => $id,
							'UserID' => Session::get('key'),
							'Species' => $request->input('seacrh'),
							'Image' => $value,
							'CreateDate' => date("Y-m-d H:i:s"),
						],
					]);
				$bodyImage = $response->getBody();
			}
		} else { $bodyImage = "Completed";}
		// --------------------------------------------

		// -------------- Success
		if ($bodySpecies == "Updated" && $bodyImage == "Completed") {
			flash('product was successfully updated', 'success');
			return back(); //redirect('admins/product/overview/' . $id . '/edit');
		} else {
			flash('Something worng please check it out <br>' . (string) $bodySpecies . '', 'danger');
			return back(); //redirect('admins/product/overview/' . $id . '/edit');

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
